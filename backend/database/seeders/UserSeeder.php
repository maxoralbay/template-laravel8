<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'role_id' => Role::ADMIN,
            'email' => 'admin@test.com',
            'garanty' => 'Test garanty',
            'zipcode' => '160000',
            'password' => 'Admin123!',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role_id' => Role::USER,
            'email' => 'johndoe@test.com',
            'garanty' => 'Test garanty for user',
            'zipcode' => '160012',
            'password' => 'John123!',
        ]);
    }
}
