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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->unique();
            $table->string('lastname');
            $table->string('image_path')->nullable(); // Chemin vers l'image de l'étudiant
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->foreignId('class_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table 'classes'
            $table->string('gender')->nullable();
            $table->string('parent_email')->nullable();
            // $table->string('initial_password')->unique(); // Mot de passe initial (sera probablement hashé)
            // $table->string('final_password')->nullable(); // Mot de passe initial (sera probablement hashé)
            $table->boolean('paid')->default(false); // Mot de passe initial (sera probablement hashé)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};