<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInformation;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $data = User::with('userInformation')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // Customer
    public function customer(Request $request)
    {
        $customers = User::with('userInformation')->whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return view('admin.customer.index', compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // Customer Create
    public function customer_create(Request $request)
    {
        $roles = Role::select(['id', 'name'])->where('name', 'user')->get();
        return view('admin.customer.create', compact('roles'));
    }

    // Customer Store
    public function customer_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $customer = User::create($input);
        $customer->assignRole($request->input('roles'));

        return redirect()->route('customer.index')
            ->with('success', 'Customer created successfully');
    }

    // Customer Edit
    public function customer_edit($id)
    {
        $user = User::find($id);
        $roles = Role::select(['id', 'name'])->where('name', 'user')->get();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.customer.edit', compact('user', 'roles', 'userRole'));
    }

    // Customer Update
    public function customer_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully');
    }

    // Customer Destroy
    public function customer_destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }

    // User Create
    public function create()
    {
        $roles = Role::select(['id', 'name'])->get();
        return view('admin.users.create', compact('roles'));
    }

    // User Store
    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the input data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'work_experience_years' => 'nullable|integer',
            'work_experience_details' => 'nullable|string',
            'hobbies' => 'nullable|array',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'images' => 'nullable|array', // Handle multiple images as an array
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Logo validation
            'industry_type' => 'nullable|string',
            'number_of_employees' => 'nullable|integer',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer',
            'registration_number' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        // Create the user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Assign roles to the user
        $user->assignRole($request->input('roles'));

        // Create and save user profile information
        $userInformation = new UserInformation();
        $this->handleImages($userInformation, $request);
        $this->handleLogo($userInformation, $request);

        $userInformation->fill([
            'name' => $user->name,
            'email' => $user->email,
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'work_experience_years' => $request->input('work_experience_years'),
            'work_experience_details' => $request->input('work_experience_details'),
            'hobbies' => json_encode($request->input('hobbies')),  // Convert hobbies array to JSON
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'industry_type' => $request->input('industry_type'),  // New field
            'number_of_employees' => $request->input('number_of_employees'),  // New field
            'description' => $request->input('description'),  // New field
            'founded_year' => $request->input('founded_year'),  // New field
            'registration_number' => $request->input('registration_number'),  // New field
            'social_links' => json_encode($request->input('social_links')),  // New field
        ]);

        // Attach the updated information to the user
        $userInformation->user_id = $user->id;
        $userInformation->save();

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
    // User Show
    public function show($id)
    {
        $user = User::with('userInformation')->find($id);
        return view('admin.users.show', compact('user'));
    }

    // User Edit
    public function edit($id)
    {
        $user = User::with('userInformation')->find($id);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $hobbies = json_decode($user->userInformation->hobbies ?? '[]', true);
        $social_links = json_decode($user->userInformation->social_links ?? '[]', true);

        return view('admin.users.edit', compact('user', 'roles', 'userRole','hobbies','social_links'));
    }

    // Update the user's details
    public function update(Request $request, $id)
    {
        // Validate the input data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password|nullable',  // Password is nullable
            'roles' => 'required',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'work_experience_years' => 'nullable|integer',
            'work_experience_details' => 'nullable|string',
            'hobbies' => 'nullable|array',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'images' => 'nullable|array', // Handle multiple images as an array
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Logo validation
            'industry_type' => 'nullable|string',
            'number_of_employees' => 'nullable|integer',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer',
            'registration_number' => 'nullable|string',
            'social_links' => 'nullable|array',
        ]);

        // Find the user by ID
        $user = User::find($id);

        // Update user data directly
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $this->updatePassword($user, $request);  // Update password if provided
        $user->save();  // Save the updated user

        // Handle user roles update
        $this->updateRoles($user, $request);

        // Update user profile information in the user_information table
        $this->updateUserInformation($user, $request);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

     // Function to handle multiple images
     private function handleImages(UserInformation $userInformation, Request $request)
     {
         if ($request->hasFile('images')) {
             $imagePaths = [];
             foreach ($request->file('images') as $image) {
                 $imagePaths[] = $image->store('user_images', 'public');
             }
             $userInformation->images = json_encode($imagePaths);  // Save image paths as JSON
         }
     }
     // Function to update the password if provided
    private function updatePassword(User $user, Request $request)
    {
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
    }
      // Function to update roles
    private function updateRoles(User $user, Request $request)
    {
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));
    }
     // Function to update user information (address, phone, etc.)
    private function updateUserInformation(User $user, Request $request)
    {
        $userInformation = $user->userInformation ?? new UserInformation();  // Create a new record if not exists

        // Handle multiple images if provided
        $this->handleImages($userInformation, $request);

        // Handle the logo if provided
        $this->handleLogo($userInformation, $request);

        // Update user information fields
        $userInformation->fill([
            'website' => $request->input('website'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'work_experience_years' => $request->input('work_experience_years'),
            'work_experience_details' => $request->input('work_experience_details'),
            'hobbies' => json_encode($request->input('hobbies')),  // Convert hobbies array to JSON
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'zip_code' => $request->input('zip_code'),
            'industry_type' => $request->input('industry_type'),  // New field
            'number_of_employees' => $request->input('number_of_employees'),  // New field
            'description' => $request->input('description'),  // New field
            'founded_year' => $request->input('founded_year'),  // New field
            'registration_number' => $request->input('registration_number'),  // New field
            'social_links' => json_encode($request->input('social_links')),  // New field
        ]);
        // Attach the updated information to the user
        $userInformation->user_id = $user->id;
        $userInformation->save();
    }

     // Function to handle the logo
     private function handleLogo(UserInformation $userInformation, Request $request)
     {
         if ($request->hasFile('logo')) {
             $logoPath = $request->file('logo')->store('logos', 'public');
             $userInformation->logo = $logoPath;  // Save the logo path
         }
     }

    // User Destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
