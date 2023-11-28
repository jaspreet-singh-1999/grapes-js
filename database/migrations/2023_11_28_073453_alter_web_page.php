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
        Schema::table('web_pages', function(Blueprint $table){
            $table->string('protected_password')->after('status')->nullable();
            $table->integer('status')->comment('draft=> 1, pending_review=> 2, Publish=> 3, password_protected=> 4, trash=> 5')->default(0)->change();
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
