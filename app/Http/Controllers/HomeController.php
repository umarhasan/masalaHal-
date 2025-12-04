<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\VeriantSize;
use App\Models\LeadGenrate;
use App\Models\PageCategory;
use App\Models\Category;
use App\Models\PageSections;
use App\Models\VeriantColor;
use App\Models\Service;
use App\Models\LeadService;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\Testimonial;
use App\Models\Team;
use App\Models\WhyChoose;
use App\Models\Process;
use App\Models\Blog;
use App\Models\PopupBanner;
use Illuminate\Support\Facades\Hash;
use App\Models\Slider;
use App\Events\LeadGenerated;
use App\Mail\LeadGeneratedMail;
use App\Models\About;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {
        $sliders = Slider::orderBy('id', 'desc')->get();
        $service_types = LeadService::with('services')->get();
        $about = About::latest()->first();
        $products = Product::latest()->paginate(12); // pagination
        $categories = Category::with('products')->get();
        $popular_products = Product::orderBy('id', 'desc')->take(5)->get();
        $testimonials = Testimonial::latest()->take(5)->get();
        $blogs = Blog::latest()->take(3)->get();
        $teams = Team::all();
        $whychooses = WhyChoose::all();
        $processes = Process::all();
        $popupBanners = PopupBanner::where('status', 1)->latest()->get();
        return view('home', compact(
            'sliders',
            'about',
            'service_types',
            'products',
            'categories',
            'popular_products',
            'testimonials',
            'blogs',
            'teams',
            'whychooses',
            'processes',
            'popupBanners',

        ));
    }

    public function service()
    {
        $sliders =Slider::get();
        $service_types =LeadService::get();
        return view('service',compact('sliders','service_types'));
    }

    public function search(Request $request)
    {
        $query = $request->input('service');

        $services = LeadService::with('services')
            ->where('name', 'LIKE', '%' . $query . '%')
            ->get();

        $services->transform(function ($service) {
            $service->image_url = $service->image ? asset('storage/' . $service->image) : asset('images/default.jpg');
            return $service;
        });

        return response()->json($services);
    }

    // Lead Genrate
   public function lead_genrate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'need' => 'required|string|max:255',
            'business' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'live_website' => 'nullable|string|max:255',
            'hire' => 'nullable|string|max:255',
            'budget' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:2000',
        ]);

        // IP-based location
        $ip = $request->ip();
        $location = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));

        $country = $location->country ?? 'N/A';
        $city = $location->city ?? 'N/A';
        $state = $location->regionName ?? 'N/A';
        $zip = $location->zip ?? 'N/A';
        $address = $location->query ?? 'N/A';

        // Check or create user
        $user = null;
        $password = '12345678';
        if ($request->email) {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email ?? null,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            UserInformation::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'email' => $request->email ?? null,
                'phone' => $request->phone,
                'country' => $country,
                'city' => $city,
                'state' => $state,
                'zip' => $zip,
                'address' => $address,
            ]);

            $user->assignRole('customer');
        }

        // Lead generation
        $leadData = [
            'need' => $request->need,
            'business' => $request->business ?? null,
            'industry' => $request->industry ?? null,
            'live_website' => $request->live_website ?? null,
            'hire' => $request->hire ?? null,
            'budget' => $request->budget ?? null,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email ?? null,
            'zip' => $zip,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'created_by' => $user->id,
        ];

        $lead = LeadGenrate::create($leadData);

        event(new LeadGenerated($lead));

        if ($user->email) {
            Mail::to($user->email)->send(new LeadGeneratedMail($user, $password, $leadData));
        } else {
            \Log::error("User email is null", ['user_id' => $user->id]);
        }

        return redirect()->back()->with('success', 'Lead generated successfully!');
    }

    // onclick Service Type
    public function getServiceFormData($serviceType)
    {
        $service = LeadService::where('name', $serviceType)->first();

        if ($service && $service->services->count() > 0) {
            $html = '<h4>Select a service:</h4>';
            foreach ($service->services as $item) {
                $html .= '<div class="field-div">
                    <input type="radio" id="service-'.$item->id.'" name="service_selected" value="'.$item->name.'" required>
                    <label for="service-'.$item->id.'">'.$item->name.' - Price: '.$item->price.' - Credit: '.$item->credit.'</label>
                    <input type="hidden" name="service_id" value="'.$item->id.'">
                </div>';
            }
            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => '<p>No services found for "'.$serviceType.'"</p>']);
    }

    public function login(){
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

    public function shop(Request $request) {
        $categories = Category::with('products')->get();

        $popular_products = Product::orderBy('id', 'desc')->take(5)->get();

        $products = Product::query();

        if ($request->s) {
            $products = $products->where('name', 'like', '%'.$request->s.'%');
        }

        $products = $products->paginate(12);

        return view('shop', compact('categories', 'popular_products', 'products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('shop_details', compact('product'));
    }
}
