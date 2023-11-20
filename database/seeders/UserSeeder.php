<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;   

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $create= [
            "name"=> "testing",
            "email"=> "testing@yopmail.com",
            "password"=> Hash::make("123456"),
            "created_by"=>1
        ];
        User::create($create);
    }
}
