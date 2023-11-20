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
        Schema::create('web_pages',function(Blueprint $table){
            $table->id();
            $table->integer('page_id');
            $table->string('page_slug');
            $table->string('page_title');
            $table->text('description')->nullable();
            $table->json('page_html');
            $table->json('page_css');
            $table->integer('status')->comment('1=> draft, 2=> publish')->default(1);
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
        Schema::drop('web_pages');
    }
};
