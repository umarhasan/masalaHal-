<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class CompanyController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $companies = User::whereHas('roles', function ($query) {
            $query->where('name', 'Company');
        })
        ->orderBy('id', 'DESC')
        ->paginate(5);
        return view('admin.companies.index', compact('companies'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    // Create
    public function create()
    {
        $roles = Role::select(['id', 'name'])->where('name', 'Company')->get();
        return view('admin.companies.create',compact('roles'));
    }

    // Store
    public function store(Request $request)
    {   
      
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $customers = User::create($input);
        $customers->assignRole($request->input('roles'));

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully');
    }

    // Show
    public function show($id)
    {
        $company = User::find($id);
        return view('admin.companies.show', compact('company'));
    }

    // Edit
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id','name')->where('name','company')->get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.companies.edit', compact('user','roles','userRole'));
    }

    // Update
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('companies.index')
                        ->with('success','company updated successfully');
    }

    // Destroy
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }
}
