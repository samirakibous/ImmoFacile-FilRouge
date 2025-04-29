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
            $table->string('title');
            $table->enum('type_transaction',['vendre', 'location']);
            $table->text('description');
            $table->string('price');
            // $table->string('location')-;
            $table->string('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('pays');
            $table->integer('age')->nullable();
            $table->integer('chambres')->nullable();
            $table->integer('pieces')->nullable();
            $table->integer('salons')->nullable();
            $table->integer('salle_de_bain')->nullable();
            $table->integer('etages');
            $table->integer('surface');
            $table->enum('condition',['neuf','occasion','bon_etat']);
            $table->enum('status', ['disponible', 'non disponible']);
            // $table->enum('equipement', ['assenceur', 'picine', 'climatisation', 'chauffage','parking', 'garage','terrasse', 'jardin','balcon']);
            $table->json('equipement')->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
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
