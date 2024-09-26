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
        Schema::create('concessions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('concession_name')->nullable()->unique();
            $table->string('concession_phone')->nullable();
            $table->string('concession_address')->nullable();
            $table->text('concession_description')->nullable();
            $table->string('concession_logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concessions');
    }
};
