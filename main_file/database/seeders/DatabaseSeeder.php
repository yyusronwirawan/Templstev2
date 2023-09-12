<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $allpermissions = [
            'manage-permission', 'create-permission', 'edit-permission', 'delete-permission',
            'manage-role', 'create-role', 'edit-role', 'delete-role', 'show-role',
            'manage-user', 'create-user', 'edit-user', 'delete-user', 'show-user', 'impersonate-user',
            'manage-module', 'create-module', 'delete-module', 'show-module', 'edit-module',
            'manage-setting',
            'manage-language', 'create-language', 'delete-language', 'show-language', 'edit-language',
            'manage-plan', 'create-plan', 'delete-plan', 'show-plan', 'edit-plan',
            'manage-chat',
            'manage-transaction',
            'manage-landingpage',
            'manage-post', 'create-post', 'delete-post', 'show-post', 'edit-post',
            'manage-category', 'create-category', 'delete-category', 'show-category', 'edit-category',

        ];
        $adminpermissions = [
            'manage-permission', 'create-permission', 'edit-permission', 'delete-permission',
            'manage-role', 'create-role', 'edit-role', 'delete-role', 'show-role',
            'manage-user', 'create-user', 'edit-user', 'delete-user', 'show-user', 'impersonate-user',
            'manage-setting',
            'manage-plan',
            'manage-chat',
            'manage-transaction',
            'manage-landingpage',
            'manage-post', 'create-post', 'delete-post', 'show-post', 'edit-post',
            'manage-category', 'create-category', 'delete-category', 'show-category', 'edit-category',

        ];

        $modules = [
            'user', 'role', 'module', 'setting', 'language', 'permission', 'plan', 'chat', 'transaction', 'category', 'post', 'landingpage'
        ];

        $settings = [
            ['key' => 'app_name', 'value' => 'Multi Tenancy Laravel Admin Saas'],
            ['key' => 'app_logo', 'value' => 'logo/app-logo.png'],
            ['key' => 'app_small_logo', 'value' => 'logo/app-small-logo.png'],
            ['key' => 'app_dark_logo', 'value' => 'logo/app-dark-logo.png'],
            ['key' => 'favicon_logo', 'value' => 'logo/app-favicon-logo.png'],
            ['key' => 'settingtype', 'value' => 'local'],
            ['key' => 'color', 'value' => 'theme-1'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'currency', 'value' => 'usd'],
            ['key' => 'currency_symbol', 'value' => '$'],
            ['key' => 'date_format', 'value' => 'M j, Y'],
            ['key' => 'time_format', 'value' => 'g:i A'],
            ['key' => 'approve_type', 'value' => 'Manually'],


        ];
        foreach ($settings as $setting) {
            Setting::create($setting);
        }
        foreach ($allpermissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        Plan::create([
            'name' => 'Free',
            'price' => '0',
            'duration' => '1',
            'durationtype' => 'Year',
            'max_users' => '10'
        ]);

        $role = Role::create([
            'name' => 'Super Admin'
        ]);
        $adminRole = Role::create([
            'name' => 'Admin'
        ]);

        foreach ($allpermissions as $permission) {
            $per = Permission::findByName($permission);
            $role->givePermissionTo($per);
        }
        foreach ($adminpermissions as $permission) {
            $per = Permission::findByName($permission);
            $adminRole->givePermissionTo($per);
        }

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'avatar' => 'avatar/avatar.png',
            'type' => 'Super Admin',
            'lang' => 'en',
        ]);

        $user->assignRole($role->id);

        foreach ($modules as $module) {
            Module::create([
                'name' => $module
            ]);
        }
    }
}
