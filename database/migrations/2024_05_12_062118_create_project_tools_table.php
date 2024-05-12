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
        Schema::create('project_tools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('tool_id')->constrained()->onDelete('cascade');
            $table->softDeletes(); // hapus tapi tidak permanen
            $table->timestamps();
        });
        //Note : tidak dibuatkan reference karena nama table dan foreignId sama.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_tools');
    }
};
