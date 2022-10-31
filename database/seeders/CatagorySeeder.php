<?php

namespace Database\Seeders;

use App\Models\Catagory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatagorySeeder extends Seeder
{
    public function run()
    {
        Catagory::create([
            "catagory_name" => "Laptop",
        ]);
        Catagory::create([
            "catagory_name" => "Mobile",
        ]);
        Catagory::create([
            "catagory_name" => "Computer",
        ]);
        Catagory::create([
            "catagory_name" => "Screen",
        ]);
    }
}
