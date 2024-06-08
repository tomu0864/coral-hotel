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
        Schema::create('restaurant_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_category_id');
            $table->string('name');
            $table->string('description');
            $table->longText('image');
            $table->double('price', 8, 2);
            $table->timestamps();

            $table->foreign('restaurant_category_id')->references('id')->on('restaurant_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_menus');
    }
};
