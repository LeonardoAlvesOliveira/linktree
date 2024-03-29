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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('password');
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('id_owner');
        });

        Schema::create('unitpeoples', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('name');
            $table->date('birthdate');
        });
        Schema::create('unitvehicles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('id_unit');
            $table->string('color');
            $table->string('plate');
        });

        Schema::create('unitpets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('race');
            $table->integer('id_unit');
        });

        Schema::create('walls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('datecreated');
            $table->integer('body');
        });
        Schema::create('walllikes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_wall');
            $table->integer('id_user');
        });

        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('fileurl');
        });

        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('title');
            $table->string('fileurl');
        });

        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('title');
            $table->date('datecreated');
            $table->text('photos');
            $table->string('status')->default('IN_REVIEW');
        });

        Schema::create('foundandlost', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('LOST');
            $table->string('photo');
            $table->string('description');
            $table->string('where');
            $table->date('datecreated');
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->integer('allowed')->default(1);
            $table->string('title');
            $table->string('cover');
            $table->string('days');
            $table->time('start_time');
            $table->time('end_time');
        });

        Schema::create('areasdisableddays', function (Blueprint $table) {
            $table->id();
            $table->integer('id_area');
            $table->date('day');
        });

        Schema::create('reversations', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->integer('id_area');
            $table->dateTime('reservation_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('reversations');
        Schema::dropIfExists('areasdisableddays');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('foundandlost');
        Schema::dropIfExists('warnings');
        Schema::dropIfExists('billets');
        Schema::dropIfExists('walllikes');
        Schema::dropIfExists('walls');
        Schema::dropIfExists('unitpets');
        Schema::dropIfExists('unitvehicles');
        Schema::dropIfExists('unitpeoples');
        Schema::dropIfExists('units');
        Schema::dropIfExists('docs');
    }
};
