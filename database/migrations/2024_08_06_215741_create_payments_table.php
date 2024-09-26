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
        Schema::create('payments', function (Blueprint $table) {
    $table->id();
    $table->string('transaction_id')->unique();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('abonnement_plan_id');
    $table->decimal('amount', 8, 2);
    $table->string('currency', 3);
    $table->string('status')->default('pending');
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('abonnement_plan_id')->references('id')->on('abonnement_plans')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
