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
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name');
            $table->string('mother_name')->nullable();
            $table->date('dob')->nullable();             // fecha de nacimiento
            $table->string('gender')->nullable();        // género
            $table->string('phone_number')->nullable();  // teléfono de contacto
            $table->text('address')->nullable();         // dirección
            $table->string('occupation')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('referal_source')->nullable();
            $table->text('emergency_contact')->nullable(); // contacto en caso de emergencia
            $table->text('medical_history')->nullable(); // historial médico
            $table->string('status')->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
            'dob',
            'gender',
            'phone_number',
            'address',
            'occupation',
            'marital_status',
            'referal_source',
            'emergency_contact',
            'medical_history',
            'status']);
        });
    }
};
