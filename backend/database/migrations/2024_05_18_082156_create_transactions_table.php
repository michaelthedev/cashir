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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('amount');

            $table->string('trans_id')->unique();
            $table->string('reference')->nullable();
            $table->string('type');
            $table->string('fee')->default(0);

            $table->enum('flow', ['credit', 'debit']);
            $table->json('details')->nullable();
            $table->enum('status', ['pending', 'success', 'failed']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
