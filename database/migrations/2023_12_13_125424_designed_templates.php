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
        Schema::create('designed_templates',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->json('html');
            $table->json('css');
            $table->foreign('page_id')->references('id')->on('pages_type')->cascadeOnDelete();
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
        Schema::drop('designed_templates');
    }
};
