<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->string('brand');
        $table->string('model');
        $table->string('car_type');
        $table->string('license_plate')->unique();
        $table->year('year');
        $table->string('color');
        $table->integer('seat');
        $table->enum('gearbox', ['manual', 'matic']);
        $table->integer('price_per_day');
        $table->enum('status', ['tersedia', 'disewa'])->default('tersedia');
        $table->text('description');
        $table->string('main_image');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
