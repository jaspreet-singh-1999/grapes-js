<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_field',function(Blueprint $table){
            $table->id();
            $table->integer('page_id');
            $table->string('label');
            $table->string('name');
            $table->string('field_type')->default(0);
            $table->string('default_value');
            $table->integer('status')->comment('deactivate => 0, active=> 1')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('custom_field');
    }
};
