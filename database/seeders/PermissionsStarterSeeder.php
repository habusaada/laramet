<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PermissionsStarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        // create dashobard permissions
        Permission::create(['name' => 'show dashobard']);

        // create user permissions
        Permission::create(['name' => 'view userDash']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'index user']);
        Permission::create(['name' => 'delete user']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'superAdmin']);

        $role1->givePermissionTo('show dashobard');


        $role1->givePermissionTo('view userDash');
        $role1->givePermissionTo('create user');
        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('show user');
        $role1->givePermissionTo('index user');
        $role1->givePermissionTo('delete user');



        // Create starter users
        $user = User::create([
            'name' => 'Trial user',
            'email' => 'demo@example.com',
            'password' => Hash::make('password'), // Ensure the password is hashed
            'email_verified_at' => now(),
        ]);

        $user->profile()->update([
            'profile_id' => 'ID-00000001',
            'phone_number' => '00970595369999',
            'company_name' => 'Unified Test Company',
            'company_location' => 'Istanbul',
            'job_title' => 'Test Account for System Evaluation',
            'date_of_birth' => '1989-01-28',
            'gender' => 'male',
            'profile_image' => 'https://picsum.photos/200',
            'address' => '123 Main Street, Test City, Country',
            'timezone' => 'UTC+2',
            'bio' => 'I am a demo user created to showcase system features, test functionality, and provide a safe environment for application trials. My account does not contain any personal data, and I am here to help developers and testers simulate real-world scenarios without compromising user privacy.',
            'notification_preferences' => [
                'email' => true,
                'sms' => false,
            ],
            'last_login_at' => now(),
            'verified' => true,
            'status' => 'approved',
            'rejection_reason' => null,
            'is_active' => true,
        ]);

        $user->assignRole($role1);


    }
}
