<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WebPage extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="web_pages";
    protected $fillable = [
        'id',
        'page_id',
        'page_slug',
        'page_title',
        'description',
        'page_html',
        'page_css',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
