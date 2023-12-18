<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageData extends Model
{
    use HasFactory, SoftDeletes;
    protected $table= 'pages_data';
    protected $fillable= [
        'id',
        'page_id',
        'field_data',
        'template_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
