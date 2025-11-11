<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
        $employees = Employee::get();
        return view('admin.employees.index',compact('employees'));
    }
    
    public function create()
    {
        return view('employees.register');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|email|unique:employees,email',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'cnic' => 'required|string',
            'full_address' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'cv' => 'nullable|mimes:pdf,doc,docx',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/employees/images', 'public');
            $data['image'] = $imagePath;
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('uploads/employees/cvs', 'public');
            $data['cv'] = $cvPath;
        }

        // Create employee record
        $employee = Employee::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'cnic' => $data['cnic'],
            'full_address' => $data['full_address'],
            'image' => $data['image'] ?? null,
            'cv' => $data['cv'] ?? null,
        ]);

        return redirect()->route('employees.create')->with('success', 'Employee registered successfully!');
    }
}
