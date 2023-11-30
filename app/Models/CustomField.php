<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PostStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomField extends Model
{
    use HasFactory,SoftDeletes;
    protected $table= 'custom_field';
    protected $fillable= [
        'id',
        'group_name',
        'group_key',
        'field_key',
        'type',
        'label',
        'name',
        'default_value',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function fieldType(){
        return $this->hasOne(FieldType::class,'id','type');
    }
    
}
