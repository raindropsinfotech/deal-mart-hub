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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maincat_id')->nullable();
            $table->text('name');
            $table->text('slug');
            $table->integer('parent_id');
            $table->unsignedBigInteger('author')->nullable();
            $table->timestamps();

            $table->foreign('maincat_id')->references('id')->on('main_categories')->onDelete('cascade');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
        Schema::dropForeign('maincat_id');
        Schema::dropForeign('author');
    }
};
