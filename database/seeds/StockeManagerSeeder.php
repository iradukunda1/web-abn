<?php

use Illuminate\Database\Seeder;

class StockeManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'Manager')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Stocker')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'stock@manager.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'first_name'     => 'Stocker',
                'last_name'      => 'Manager',
                'email'    => 'stock@manager.com',
                'phone_number' => '+254712345678',
                'active' => 1,
                'verified' => 1,
                'country' => 'Rwanda',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }
    }
}
