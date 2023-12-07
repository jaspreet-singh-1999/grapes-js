<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageData extends Model
{
    use HasFactory;
    protected $table= 'pages_data';
    protected $fillable= [
        'id',
        'page_id',
        'fiels_data',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
