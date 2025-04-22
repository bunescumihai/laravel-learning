<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('restrict');
            $table->string('title');
            $table->string('description');
            $table->string('address');
            $table->json('specifications')->nullable();
            $table->boolean('use_client_contacts')->default(false);
            $table->integer('annonce_type')->nullable();
            $table->date('start_publication_date')->nullable();
            $table->date('end_publication_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
