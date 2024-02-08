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
        Schema::create('cursuses', function (Blueprint $table) {
            $table->id();
            $table->string('degree');
            $table->string('institution');
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->timestamps();
            $table->foreignId('cv_id')->references('id')->on('cvs')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursuses');
    }
};
