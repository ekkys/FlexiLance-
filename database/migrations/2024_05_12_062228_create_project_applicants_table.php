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
        Schema::create('project_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('freelancer_id');  //buatkan reference karena beda dengan nama tabel aslinya yaitu user
            $table->text('message');
            $table->string('status');
            $table->softDeletes(); // hapus tapi tidak permanen
            $table->timestamps();

            //reference for client id
            $table->foreign('freelancer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_applicants');
    }
};
