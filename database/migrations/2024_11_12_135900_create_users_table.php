<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('surname',64);
            $table->string('name',64);
            $table->string('patronymic',64)->nullable();
            $table->string('login',64)->unique();
            $table->string('password',64);
            $table->string('api_token')->nullable()->unique();
            $table->foreignId('role_id')->constrained();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
