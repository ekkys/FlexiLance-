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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->string('type');
            $table->boolean('is_paid');
            $table->string('proof');
            $table->string('bank_name');
            $table->string('bank_account_name');
            $table->string('bank_account_number');
            $table->softDeletes(); // hapus tapi tidak permanen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
