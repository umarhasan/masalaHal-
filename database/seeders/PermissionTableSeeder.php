<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        // ============================
        //  ALL PERMISSIONS
        // ============================
        $permissions = [

            // SYSTEM
            'dashboard',
            'change-password',

            // USERS & ROLES
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'user-list', 'user-create', 'user-edit', 'user-delete',
            'permission-list', 'permission-create', 'permission-edit', 'permission-delete',

            // GENERAL SETTINGS
            'general_setting',

            // LOCATIONS
            'locations-list', 'locations-create', 'locations-edit', 'locations-delete',

            // SLIDERS
            'sliders-list', 'sliders-create', 'sliders-edit', 'sliders-delete',

            // SERVICE TYPE
            'service-type-list', 'service-type-create', 'service-type-edit', 'service-type-delete',

            // SERVICE
            'service-list', 'service-create', 'service-edit', 'service-delete',

            // PACKAGES
            'package-list', 'package-create', 'package-edit', 'package-delete',

            // COMPANY
            'company-list', 'company-create', 'company-edit', 'company-delete',

            // LEADS
            'leads-list', 'leads-create', 'leads-edit', 'leads-delete',

            // EMPLOYEES
            'employees-list', 'employees-create', 'employees-edit', 'employees-delete',

            // ACCOUNT
            'account-setting',

            // CMS CONTENT
            'about-list', 'about-create', 'about-edit', 'about-delete',
            'whychoose-list', 'whychoose-create', 'whychoose-edit', 'whychoose-delete',
            'teams-list', 'teams-create', 'teams-edit', 'teams-delete',
            'testimonials-list', 'testimonials-create', 'testimonials-edit', 'testimonials-delete',
            'blogs-list', 'blogs-create', 'blogs-edit', 'blogs-delete',
            'processes-list', 'processes-create', 'processes-edit', 'processes-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        // ============================
        // ROLES
        // ============================
        $roles = [
            'admin',
            'customer',
            'company',
            'vendor',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }


        // ============================
        // ASSIGN PERMISSIONS TO ROLES
        // ============================

        // 1️⃣ ADMIN → Has ALL Permissions
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions(Permission::all());


        // 2️⃣ CUSTOMER ROLE — LIMITED PERMISSIONS
        $customerPermissions = [
            'dashboard',
            'leads-list',
            'leads-create',
            'account-setting',
        ];

        Role::where('name', 'customer')
            ->first()
            ->syncPermissions($customerPermissions);


        // 3️⃣ COMPANY ROLE — MANAGE LEADS + EMPLOYEES
        $companyPermissions = [
            'dashboard',
            'employees-list', 'employees-create', 'employees-edit',
            'leads-list', 'leads-edit',
            'account-setting',
        ];

        Role::where('name', 'company')
            ->first()
            ->syncPermissions($companyPermissions);


        // 4️⃣ VENDOR ROLE — ONLY SERVICES RELATED
        $vendorPermissions = [
            'dashboard',
            'service-list', 'service-edit',
            'package-list',
            'account-setting',
        ];

        Role::where('name', 'vendor')
            ->first()
            ->syncPermissions($vendorPermissions);


        // ============================
        // CREATE DEFAULT ADMIN USER
        // ============================
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]);
            $admin->assignRole('admin');
        }
    }
}
