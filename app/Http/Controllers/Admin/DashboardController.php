<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\GameDeposit;
use App\Models\GameWithdraw;
use App\Models\LeadGenrate;
use App\Models\Transaction;
use App\Models\Redeem;
use Session;
use Stripe;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        // Retrieve data
        $usersCount = User::count();
        $leadsCount = LeadGenrate::count();

        // Calculate yearly revenue, transactions, and profit
        $currentYear = now()->year;
        // $currentYear = 2024;
        $revenue = Transaction::selectRaw('YEAR(created_at) as year, SUM(amount) as total_revenue')
                        ->groupBy('year')
                        ->get()
                        ->keyBy('year');

        $transactions = Transaction::whereYear('created_at', $currentYear)->sum('amount');
        $profit = $transactions; // Assuming profit is equivalent to the transactions for now

        // Calculate the previous year's revenue for growth calculation
        $previousYearRevenue = $revenue->get($currentYear - 1)->total_revenue ?? 0;
        $growthPercentage = 0;

        if ($previousYearRevenue > 0) {
            $growthPercentage = (($revenue[$currentYear]->total_revenue - $previousYearRevenue) / $previousYearRevenue) * 100;
        }

        // Prepare data for the chart
        $yearlyData = $revenue->map(function ($item) {
            return [
                'year' => $item->year,
                'revenue' => $item->total_revenue,
            ];
        });

        $data = [
            'user' => $user,
            'users_count' => $usersCount,
            'leads_count' => $leadsCount,
            'transactions' => $transactions,
            'profit' => $profit,
            'yearly_data' => $yearlyData,
            'growth_percentage' => $growthPercentage, // Pass growth percentage to the view
        ];

        return view('admin.dashboard', $data);
    }
    
    public function admin_profile()
    {
        $user = auth()->user();
        $userInformation = $user->userInformation;

        // Get all attributes from both the user and userInformation models
        $fields = [
            'name', 'email', 'phone', 'address', 'country', 'state',
            'city', 'zip_code', 'website', 'logo', 'hobbies',
            'work_experience_years', 'work_experience_details',
            'industry_type', 'number_of_employees',
            'description', 'founded_year', 'registration_number',
            'social_links', 'images'
        ];

        // Count total fields (all attributes from both models)
        $totalFields = count($fields);
        $completedFields = 0;

        // Check which fields are filled (not empty)
        foreach ($fields as $field) {
            if (!empty($user->$field) || !empty($userInformation->$field)) {
                $completedFields++;
            }
        }

        // Calculate the completion percentage
        $completionPercentage = ($completedFields / $totalFields) * 100;

        return view('admin.profile', compact('user', 'userInformation', 'completionPercentage'));

    }
    public function Update(Request $request,$section)
    {
    
        $user = auth()->user();
        $userInformation = $user->userInformation;
        // Now, calculate the profile completion percentage
        
        if (!$userInformation) {
            // Try creating a new userInformation record
            if (!$userInformation) {
                $userInformation = $user->userInformation()->create([
                    'user_id' => $user->id,
                    'name' => $user->name, // User name
                    'email' => $user->email, // User email
                    'phone' => $user->phone, // User phone
                ]);
    
                // If creation fails, return an error
                if (!$userInformation) {
                    return redirect()->back()->withErrors('User information could not be created. Please try again.');
                }
            }
        }
        switch ($section) {
        case 'basic':
        
            $user->update($request->only('name', 'email', 'phone'));
            $userInformation->update([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]);
            break;

        case 'contact':
            $userInformation->update($request->only('address', 'country', 'state', 'city', 'zip_code'));
            break;

        case 'professional':
            $userInformation->update($request->only('industry_type', 'number_of_employees', 'work_experience_years', 'work_experience_details'));
            break;

        case 'social':
            $userInformation->update($request->only('website', 'social_links'));

            if ($request->hasFile('logos')) {
                $userInformation->logo = $request->file('logos')->store('uploads/user-logo', 'public');
            }

            if ($request->hasFile('images')) {
                $workExperienceImages = array_map(
                    fn($file) => $file->store('uploads/work-experience-images', 'public'),
                    $request->file('images')
                );
                $userInformation->images = json_encode($workExperienceImages);
            }

            $userInformation->save();
            break;

        case 'details':
            $userInformation->update($request->only('description', 'founded_year', 'registration_number'));
            break;

        case 'hobbies':
            $userInformation->update($request->only('hobbies'));
            break;

        default:
            return redirect()->back()->withErrors('Invalid section.');
    }

        $fields = [
            'name', 'email', 'phone', 'address', 'country', 'state',
            'city', 'zip_code', 'website', 'logo', 'hobbies',
            'work_experience_years', 'work_experience_details',
            'industry_type', 'number_of_employees',
            'description', 'founded_year', 'registration_number',
            'social_links', 'images'
        ];
    
        $totalFields = count($fields);
        $filledFields = 0;
    
        foreach ($fields as $field) {
            if (!empty($user->$field) || !empty($userInformation->$field)) {
                $filledFields++;
            }
        }
    
        // Calculate completion percentage
        $completionPercentage = ($totalFields > 0) ? ($filledFields / $totalFields) * 100 : 0;
        
        // If profile completion reaches or exceeds 80%, and credits/assign_status are null, update them
        if ($completionPercentage >= 80) {
            
            if ($user->credit === null && $user->assign_status === null) {
                $user->update([
                    'credit' => 20,           // Set credits to 10
                    'assign_status' => 1,      // Set assign_status to 1
                ]);
            }
        }
        return redirect()->back()->with('success', ucfirst($section) . ' updated successfully!');
    }

    public function change_password()
    {
        return view('auth.change-password');
    }
    public function store_change_password(Request $request)
    {
        $user = Auth::user();
        $userPassword = $user->password;

        $validator =Validator::make($request->all(),[
          'oldpassword' => 'required',
          'newpassword' => 'required|same:password_confirmation|min:6',
          'password_confirmation' => 'required',
        ]);

        if(Hash::check($request->oldpassword, $userPassword)) 
        {
            return back()->with(['error'=>'Old password not match']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }


    //      Wallet Customer User List:-
    public function walletUserList(){
        $users =User::with('wallet')->where('role',3)->get();
        return view('admin.wallet.wallet_user_list',["users"=>$users]);
     }
 
     public function walletdeposit($id){
         $users = User::findOrFail($id);
         return view('admin.wallet.deposit',["users"=>$users]);
     }
 
     public function createdeposite(Request $request){
         
        // dd($request->all());
         $id =$request->user_id;
            $deposit_amount=$request->dep_amount;
            $users =User::where('id',$id)->first();
            $users->deposit($deposit_amount);


            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                    "amount" => $request->dep_amount,
                    "currency" => "USD",
                    "source" => $request->stripeToken,
                    "description" => "This payment is testing purpose of techsolutionstuff",
            ]);


            // dd($users);
         return redirect()->back()->with('success','Wallet Amount Deposit Has been submitted successfully');
     }
 
     public function walletwithdraw($id){
         $users = User::findOrFail($id);
         return view('admin.wallet.withdraw',["users"=>$users]);
     }
     public function createdewithdraw(Request $req){
         $id =$req->user_id;
         $withdraw_amount=$req->drw_amount;
         $users =User::where('id',$id)->first();
         $users->forceWithdraw($withdraw_amount);
         return redirect()->back()->with('success',' Withdraw Amount wallet Has been detected Successfully');
     }
}
