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
        Schema::create('annonces_client_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->references('id')->on('annonces')->onDelete('cascade');
            $table->foreignId('client_contacts_id')->references('id')->on('client_contacts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces_client_contacts');
    }
};
