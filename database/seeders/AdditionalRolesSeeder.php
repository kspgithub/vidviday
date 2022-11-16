<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class AdditionalRolesSeeder extends Seeder
{
    public function run()
    {
        //
        $viewAdmin = Permission::where('name', 'view admin')->where('guard_name', 'web')->first();
        if (empty($viewAdmin)) {
            $viewAdmin = Permission::create(['name' => 'view admin', 'guard_name' => 'web']);
        }

        $tourManager = Role::where('name', 'tour-manager')->where('guard_name', 'web')->first();
        if (empty($tourManager)) {
            $tourManager = Role::create([
                'name' => 'tour-manager',
                'guard_name' => 'web',
            ]);

        }

        $dutyManager = Role::where('name', 'duty-manager')->where('guard_name', 'web')->first();
        if (empty($dutyManager)) {
            $dutyManager = Role::create([
                'name' => 'duty-manager',
                'guard_name' => 'web',
            ]);

        }

        $tourManager->givePermissionTo($viewAdmin);
        $dutyManager->givePermissionTo($viewAdmin);
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
