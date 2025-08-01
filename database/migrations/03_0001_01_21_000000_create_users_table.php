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
            $table->string('surname_1')->nullable();
            $table->string('surname_2')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean("otp_verified")->default(false);
            $table->timestamp('otp_verified_at')->nullable();
            $table->string('password')->nullable(); //Cuando importo de csv no habrá
            //NExt el usuario deberá de aportar la primera vez
            $table->string('departament')->nullable();
            $table->rememberToken();


            //Un profesor tiene una especialidad que implica un departamento
            //Profesor es un tipo de usuario por eso nullable
            $table->foreignId("specialization_id")->constrained("specializations")->nullable();





            $table->foreignId('current_team_id')->nullable();

            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
