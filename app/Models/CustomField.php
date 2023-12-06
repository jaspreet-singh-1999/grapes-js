<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PostStatus;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomField extends Model
{
    use HasFactory,SoftDeletes;
    protected $table= 'custom_field';
    protected $fillable= [
        'id',
        'page_id',
        'field_type',
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
        return $this->hasOne(FieldType::class,'id','field_type');
    }
    public function pageType(){
        return $this->belongsTo(PageType::class,'page_id','id');
    }
}
