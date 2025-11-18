<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class NewModulePermissionSeeder extends Seeder
{
    public function run()
    {
        // New modules you added
        $modules = [
            'abouts',
            'why_chooses',
            'teams',
            'testimonials',
            'blogs',
            'processes',
        ];

        // Create missing permissions
        foreach ($modules as $module) {

            // CRUD Permissions
            $permissions = [
                "{$module}-list",
                "{$module}-create",
                "{$module}-edit",
                "{$module}-delete",
            ];

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
        }

        // Assign to Admin Role
        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            $allNewPermissions = Permission::where(function ($q) {
                $q->where('name', 'LIKE', 'abouts-%')
                  ->orWhere('name', 'LIKE', 'why_chooses-%')
                  ->orWhere('name', 'LIKE', 'teams-%')
                  ->orWhere('name', 'LIKE', 'testimonials-%')
                  ->orWhere('name', 'LIKE', 'blogs-%')
                  ->orWhere('name', 'LIKE', 'processes-%');
            })->get();

            $adminRole->syncPermissions($adminRole->permissions->merge($allNewPermissions));
        }
    }
}
