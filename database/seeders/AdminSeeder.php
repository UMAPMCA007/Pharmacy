<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        $admin = new User();   
        $admin->name = 'admin';
        $admin->email = 'midhun@gmail.com';
        $admin->password = bcrypt('admin');
        $admin->is_admin = 1;
        $admin->save();

    }
}
