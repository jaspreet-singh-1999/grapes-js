<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PageType;

class DesignedTemplates extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= "designed_templates";
    protected $fillable= [
        'id',
        'page_id',
        'html',
        'css',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function page(){
        return $this->belongsTo(PageType::class,'page_id','id');
    }
}
