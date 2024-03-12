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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('prod_code');
            $table->string('prod_name');
            $table->tinyInteger('prod_count');
            $table->tinyInteger('prod_compare1');
            $table->tinyInteger('prod_compare2');
            $table->tinyInteger('prod_compare3')->nullable();
            $table->string('compare_success');
            $table->string('area_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
