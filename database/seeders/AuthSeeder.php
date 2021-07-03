<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\PermissionRegistrar;

class AuthSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->disableForeignKeys();
        // Reset cached roles and permissions
        Artisan::call('cache:clear');

        resolve(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
            'password_resets',
        ]);

        // Create Roles
        $adminRole = Role::create([
            'id' => 1,
            'name' => 'admin',
            'guard_name'=> 'web',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'tour-agent',
            'guard_name'=> 'web',
        ]);

        Role::create([
            'id' => 3,
            'name' => 'tourist',
            'guard_name'=> 'web',
        ]);

        // Create Permissions
        Permission::create(['name' => 'view admin', 'guard_name' => 'web']);

        $adminRole->givePermissionTo(Permission::all());

        $masterAdmin = User::create([
            'id'=>1,
            'email'=>'admin@vidviday.org.ua',
            'first_name'=>'Super',
            'last_name'=>'Admin',
            'password'=> bcrypt('secret12345'),
            'email_verified_at' => now(),
        ]);

        $masterAdmin->assignRole('admin');

        $this->enableForeignKeys();
    }
}
