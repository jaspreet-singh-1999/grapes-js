<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PostStatus;

class PostStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $create_status= [
            ['module'=> 'post','status_id'=> 1,'name'=> 'Draft','created_by'=> 1],
            ['module'=> 'post','status_id'=> 2,'name'=> 'Pending review','created_by'=> 1],
            ['module'=> 'post','status_id'=> 3,'name'=> 'Publish','created_by'=> 1], 
            ['module'=> 'post','status_id'=> 4,'name'=> 'Password protected','created_by'=> 1], 
            ['module'=> 'post','status_id'=> 5,'name'=> 'Trash','created_by'=> 1]
        ];

        foreach($create_status as $status){
            PostStatus::create($status);
        }
    }
}
