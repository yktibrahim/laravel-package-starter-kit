<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Migrasyonları çalıştır.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_package_starter_kit_table', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Migrasyonları geri al.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laravel_package_starter_kit_table');
    }
}; 