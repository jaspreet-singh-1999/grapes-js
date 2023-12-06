<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CustomField;

class PageType extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='pages_type';
    protected $fillable= [
        'id',
        'page_type',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function field(){
        return $this->hasMany(CustomField::class,'page_id','id');
    }
}
