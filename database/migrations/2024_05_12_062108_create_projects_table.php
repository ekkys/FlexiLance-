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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->text('about'); // karena akan panjang (text)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // cascade : induk dihapus anak terhapus
            $table->unsignedBigInteger('client_id'); //buatkan reference karena beda dengan nama tabel aslinya yaitu user
            $table->unsignedBigInteger('budget'); //unsignedBigInteger supaya tidak bisa minus
            $table->string('skill_level');
            $table->boolean('has_finished');
            $table->boolean('has_started');
            $table->softDeletes(); // hapus tapi tidak permanen
            $table->timestamps();
            //reference for client id
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
