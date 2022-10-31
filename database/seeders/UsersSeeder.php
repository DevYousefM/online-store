<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        User::create([

            'name' => "User",
            'email' => "user@gmail.com",
            'password' => '$2y$10$L.JbWQ7Dd6J7crNqlmustOmYw/HKGALuSt4taA7GrW9zZl7YoaU8i',
            'address' => "El fath",
            'phone' => "010000000",
            "user_type" => "0"
        ]);
        User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => '$2y$10$9ZwrYJDRTa8II2ODBuxA5O4ux.j.yADR.Cb0L4/cWaM8sh13cHTmG',
            'address' => "El fath",
            'phone' => "011111111",
            "user_type" => "1"
        ]);
    }
}
