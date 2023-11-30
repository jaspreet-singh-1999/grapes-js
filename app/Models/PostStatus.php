<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomField;


class PostStatus extends Model
{
    use HasFactory;
    protected $table= "post_status";
    protected $fillable= [
        'id',
        'module',
        'status_id',
        'name',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
