<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadGenrate;
use App\Models\Service;
use App\Models\LeadService;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;
use App\Models\User;
use App\Models\Package;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Session;
use Stripe;
use App\Events\LeadGenerated;
use Illuminate\Support\Facades\Log;
class DashboardController extends Controller
{
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

        return view('company.dashboard', compact('user', 'userInformation', 'completionPercentage'));
    }

    public function company_leads_genrate(Request $request) {
        $user_id = Auth::user()->id;
        // Get the perPage value from the request, default to 10 if not set
        $perPage = $request->input('per_page', 10);
        // Get the user's city
        $userCity = Auth::user()->userInformation->city;
        $query = LeadGenrate::with('service', 'service.leadService')
                            ->whereNull('assign_company_id')
                            ->orderBy('created_at', 'desc');
        // Add a condition to filter leads by user's city
        if ($userCity) {
            $query->where('city', $userCity);
        }
    
        // If 'All' is selected, show all records without pagination
        if ($perPage == 0) {
            $leads = $query->get();
            $filteredLeadsCount = $leads->count();
        } else {
            $leads = $query->paginate($perPage);
            $filteredLeadsCount = $query->count();
        }
    
        // Service & Lead Service
        $service = Service::all();
        $lead_service = LeadService::all();
        $lead = LeadGenrate::where('city',$userCity)->latest()->first();
        // Check if a lead was found
        if ($lead) {
            // Fire the event if a lead exists
            event(new LeadGenerated($lead));
        } else {
            // Handle the case where no lead is found (optional)
            // Log an error or notify the user
            Log::warning('No lead found to generate event.');
            // Or, return an error response
            // return response()->json(['error' => 'No lead found.'], 404);
        }
        return view('company.lead_genrate', compact('leads', 'filteredLeadsCount', 'service', 'lead_service'));
    }

    public function leadPick($id){

        $leads = LeadGenrate::with('service', 'service.leadService')->where('id',$id)->first();
        $leads->assign_company_id = Auth::user()->id;
        $leads->status = 1;
        $leads->save();
        $leadCredit = $leads->service->credit ?? 0;

        $user = Auth::user();
        if ($user->credit >= $leadCredit) {
        $user->credit -= $leadCredit;
        $user->save();

        // Return success message after successful operation
        return redirect()->back()->with('success', 'Lead picked successfully and credit deducted.');
        } else {
            // If the user doesn't have enough credit, return an error
            return redirect()->back()->with('error', 'Not enough credit to pick this lead.');
        }

    }
    public function leadNotPick($id)
    {
        $leads = LeadGenrate::with('service', 'service.leadService')->where('id', $id)->first();
        if (!$leads) {
            return redirect()->back()->with('error', 'Lead not found or already assigned.');
        }
        $leads->assign_company_id = null;  // Mark as not assigned
        $leads->status = 0;
        $leads->save();
        return redirect()->back()->with('success', 'Lead marked as Not Interested successfully.');
    }
    public function purchaseleads(){
            $user_id = Auth::user()->id;
            $leads = LeadGenrate::with('users')->where('assign_company_id',$user_id)->get();

            return view('company.purchased_lead',compact('leads'));
    }
    public function company_show($id){
        $lead = LeadGenrate::with('users')->where('id',$id)->first();
        return view('company.leads_show',compact('lead'));
    }
    public function pick(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
        ]);

        $lead = Lead::findOrFail($request->lead_id);
        // Implement your pick logic here, e.g., assign to user, change status, etc.
        $lead->status = 'picked';
        $lead->picked_by = auth()->user()->id; // Assuming you have authentication
        $lead->save();

        return redirect()->route('company.leads.index')->with('success', 'Lead picked successfully.');
    }
    
    public function companyProfile()
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
        return view('company.profile', compact('user', 'userInformation', 'completionPercentage'));

    }
    public function companyProfileUpdate(Request $request,$section)
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
        
        // If profile completion reaches or exceeds 80%, and credit/assign_status are null, update them
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
    public function companyEditProfile(Request $request){

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->paypal_email = $request->paypal_email;
        $user->venmo_number = $request->venmo_number;
        $user->connect_to_facebook = $request->connect_to_facebook;
        $user->save();

        session::flash('success','profile deatail Updated Successfully');
        return redirect()->back();
    }
    public function companyBankDetail(Request $request){

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->account_number = $request->account_number;
        $user->rout_number = $request->route_number;
        $user->save();

        session::flash('success','Bank Detail Updated Successfully');
        return redirect()->back();
    }
    public function company_change_password()
    {
        return view('company.change-password');
    }
    public function company_store_change_password(Request $request)
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
    public function purchasePackageCreate($id){

        if(Auth::user()->credit >= 50){
            $user = Auth::user();
            $user = User::where('id',$user->id)->first();
            $user->assign_status = 1;
            $user->credit = $user->credit - 50;
            $user->save();

            $lead = LeadGenrate::where('id',$id)->first();
            $lead->assign_company_id = $user->id;
            $lead->status = 1;
            $lead->save();
         return redirect()->back()->with('success','Successfully Purchased');
      }else{
        $leads =LeadGenrate::where('id',$id)->first();
        $package = Package::get();
        return view('company.packages',compact('package','leads'));

       }
    }
    public function stripePost(Request $request)
    {
        try {
           
            // Set your Stripe API key
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a charge using Stripe API
           $charge = Stripe\Charge::create([
                "amount" => $request->amount, // Amount in cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from https://quicksoloutions.com"
            ]);

            $user = Auth::user();
            $user = User::where('id',$user->id)->first();

            $user->assign_status = 1;
            $user->credit = $user->credit + $request->credit;
            $user->save();

            $lead = LeadGenrate::where('id',$request->lead_id)->first();
            $lead->assign_company_id = $user->id;
            $lead->status = 1;
            $lead->save();
    
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->package_id = $request->package_id;
            $transaction->transaction_id = $charge->id; // Stripe transaction ID
            $transaction->amount = $request->amount; // Convert from cents to dollars
            $transaction->status = 1; // Status of the charge
            $transaction->save();

            // Payment successful, flash success message
            Session::flash('success', 'Payment successful!');
            // return redirect()->route('user_joke');
            return redirect('/company/leads-genrate');

        } catch (\Stripe\Exception\CardException $e) {
            // Card error occurred, handle it
            Session::flash('error', $e->getError()->message);
        }

        // Redirect back to the previous page
        return back();
    }
}
