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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->string('categorie');
            $table->string('location');
            $table->string('price');
            $table->unsignedBigInteger('user_id'); // Champ pour la clé étrangère
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users'); // 'users' est le nom de la table des utilisateurs

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
