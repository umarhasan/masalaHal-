<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VeriantSize;
use App\Models\LeadGenrate;
use App\Models\PageCategory;
use App\Models\PageSections;
use App\Models\VeriantColor;
use App\Models\Service;
use App\Models\LeadService;
use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Events\LeadGenerated;
use App\Mail\LeadGeneratedMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('home',compact('sliders','service_types'));
    }
    // About us
    public function about_us()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('about_us',compact('sliders','service_types'));
    }
        // Contact us    
    public function contact_us()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('contact_us',compact('sliders','service_types'));
    }
    //Faqs
    public function faqs()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('faqs',compact('sliders','service_types'));
    }
    //service
    public function service()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('service',compact('sliders','service_types'));
    }
    
    
    public function search(Request $request)
    {
        $query = $request->input('service');
    
        // Fetch services matching the query with their relationships
        $services = LeadService::with('services')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->get();
    
        // Add the image URL dynamically
        $services->transform(function ($service) {
            $service->image_url = $service->image ? asset('storage/' . $service->image) : asset('images/default.jpg');
            return $service;
        });
    
        return response()->json($services);
    }
    
    // Lead Genrate
    public function lead_genrate(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'email' => 'nullable|email',
        ]);

        // Check if the user already exists
        $user = User::where('email', $request->email)->first();
        $password = '12345678';  // Default password, consider making this dynamic or generated

        if (!$user) {
            // If the user does not exist, create a new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password), // Hash the password
                'email_verified_at' => now(),
            ]);

            // Save additional information in the UserInformation table
            UserInformation::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'state' => $request->state,
            ]);

            // Assign the 'customer' role to the new user
            $user->assignRole('customer');
        }

        // Prepare lead data and assign the user's ID to 'created_by'
        $leadData = $request->all();
        $leadData['created_by'] = $user->id;

        // Create the lead
        $lead = LeadGenrate::create($leadData);

        // Fire the LeadGenerated event (if needed)
        event(new LeadGenerated($lead));

        // Send the email to the user with lead data
        if ($user->email) {
            Mail::to($user->email)->send(new LeadGeneratedMail($user, $password, $leadData));
        } else {
            \Log::error("User email is null", ['user_id' => $user->id]);
        }

        // Return success message to the user
        return redirect()->back()->with('success', 'Lead generated successfully and email sent!');
    }
    
    // onclick Service Type
    public function getServiceFormData($serviceType)
    {
        // Retrieve the service type from the database based on the service name
        $service = LeadService::where('name', $serviceType)->first();
        
        if ($service) {
            // Generate the dynamic content (HTML) based on the data
            $dynamicContent = '';
            $url = asset('storage/' . $service->image);
            // Assuming service has a relationship with 'services' which contains related data
            if ($service->services && $service->services->count() > 0) {
                $dynamicContent .= '<div class="row">
                <div class="col-12 text-center">
                    <div class="image-container">
                        <img src="' . $url . '"  class="img-fluid" style="width: 100%; height:200px; border-radius: 10px;">
                    </div>
                    <h2 class="fs-title">What are your ' . $serviceType . ' needs?</h2>
                </div>
                </div>';

                // Loop through services and generate radio inputs
                foreach ($service->services as $item) {
                    $dynamicContent .= '<div class="field-div">
                        <input type="radio" id="service-' . $item->id . '" name="need" value="' . $item->name . '" required>
                        <label for="service-' . $item->id . '">' . $item->name . '</label>
                        <input type="hidden" name="service_id" value="' . $item->id . '">
                    </div>';
                }
            } else {
                $dynamicContent = '<div class="field-div"><p>No services found for "' . $serviceType . '".</p></div>';
            }

            // Return the HTML content in the response
            return response()->json(['html' => $dynamicContent]);
        }

        // Return an error message if the service is not found
        return response()->json(['html' => 'No form data available.'], 404);
    }
    
    public function login(){
        // $this->middleware('auth')->except('logout');
        return view('auth.login');
    }

    public function product_detail($id)
    {
        $data['product'] = Product::find($id);
        $data['size'] = VeriantSize::where('product_id',$id)->first();
        // return json_decode($size->name);
        $data['color'] = VeriantColor::where('product_id',$id)->first();
        return view('admin.product_detail',$data);
    }


}
