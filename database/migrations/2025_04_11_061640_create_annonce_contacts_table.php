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
        Schema::create('annonce_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->references('id')->on('annonces')->onDelete('cascade');
            $table->foreignId('contact_type_id')->references('id')->on('contact_types')->onDelete('cascade');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonce_contacts');
    }
};
