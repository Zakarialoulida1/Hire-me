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
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->text('description');
            $table->text('compétences_requises');
            $table->enum('type_contrat', ['à distance', 'hybride', 'à temps plein']);
            $table->string('emplacement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emplois');
    }
};
