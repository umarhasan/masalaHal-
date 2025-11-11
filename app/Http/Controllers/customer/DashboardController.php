<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\LeadGenrate;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Hash as FacadesHash;
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
        $this->middleware(['auth']);
    }
    
    public function index()
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

        return view( 'customer.dashboard', compact('user', 'userInformation', 'completionPercentage'));
    }
    public function customer_leads_genrate(){
        $user = Auth::id();
        $leads = LeadGenrate::get();
        $companyUsers = User::whereHas('roles', function($q){
            $q->where('name', 'company');
        })->get();
        return view('customer.lead_genrate',compact('leads','companyUsers'));
    }

    public function assign_company(Request $request){

        // $assign = User::where('id',$request->lead_assign_company_id)->first();
        // $assign->lead_assign_company_id = $request->lead_assign_company_id;
        // $assign->assign_status = 1;
        // $assign->save();

        $leads= LeadGenrate::where('id',$request->lead_id)->first();
        $leads->assign_company_id = $request->lead_assign_company_id;
        $leads->status = 1;
        $leads->save();


        return redirect()->back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function profile()
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

        return view('customer.profile', compact('user', 'userInformation', 'completionPercentage'));

    }
      
    
    public function usersProfileUpdate(Request $request, $section)
    {
        $user = auth()->user();
        $userInformation = $user->userInformation;
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

        // Now, calculate the profile completion percentage
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
    public function user_edit_profile(Request $request){

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        session::flash('success','profile Updated Successfully');
        return redirect()->back();

    }


    public function users_change_password()
    {
        return view('customer.change-password');
    }
    public function users_store_change_password(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $userPassword = $user->password;

        $validator =Validator::make($request->all(),[
          'oldpassword' => 'required',
          'newpassword' => 'required|same:password_confirmation|min:6',
          'password_confirmation' => 'required',
        ]);

        if(!Hash::check($request->oldpassword, $userPassword))
        {
            return back()->with(['error'=>'old password not match']);
        }

        $user->password = Hash::make($request->newpassword);
        $user->save();

        return redirect()->back()->with("success","Password changed successfully!");
    }

}
