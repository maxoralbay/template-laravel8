<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\BlogUser;

class BlogUsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        BlogUser::updateOrCreate([
            'id'=>1,
            'name' => 'Jhon Doe',
            'salary' => '1000',
            'age' => '20',

        ]);
        BlogUser::updateOrCreate([
            'id'=>2,
            'name' => 'Jhon Doe 2',
            'salary' => '2000',
            'age' => '30',

        ]);
        BlogUser::updateOrCreate([
            'id'=>3,
            'name' => 'Jhon Doe 3',
            'salary' => '3000',
            'age' => '40',
        ]);

    }
}
