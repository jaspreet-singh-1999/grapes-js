<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FieldType;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $field_type= [
            ['name'=> 'Text','created_by'=> 1],
            ['name'=> 'Number','created_by'=> 1],
            ['name'=> 'Range','created_by'=> 1],
            ['name'=> 'Email','created_by'=> 1],
            ['name'=> 'Url','created_by'=> 1],
            ['name'=> 'Password','created_by'=> 1],
            ['name'=> 'Image','created_by'=> 1],
            ['name'=> 'File','created_by'=> 1],
            ['name'=> 'Select','created_by'=> 1],
            ['name'=> 'Checkbox','created_by'=> 1],
            ['name'=> 'True/False','created_by'=> 1]
        ];

        foreach($field_type as $type){
            FieldType::create($type);
        }
    }
}
