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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->unsignedBigInteger('user_id');
            $table->string('modele');
            $table->string('slug')->unique();
            $table->integer('annee');
            $table->integer('kilometrage')->nullable();
            $table->text('description')->nullable();
            $table->json('equipements')->nullable();
            $table->json('accesoires')->nullable();
            $table->string('immatriculation')->nullable();
            $table->integer('annee_circulation')->nullable();
            $table->date('date_assurance_debut')->nullable();
            $table->date('date_assurance_fin')->nullable();
            $table->string('image_assurance')->nullable();
            $table->string('category');
            $table->string('subcategory');
            $table->decimal('prix', 9, 2);
            $table->decimal('dernier_prix', 9, 2)->nullable();
            $table->boolean('visibility')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
