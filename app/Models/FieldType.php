<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldType extends Model
{
    use HasFactory,SoftDeletes;
    protected $table= 'field_types';
    protected $fillable= [
        'id',
        'name',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
  
}
