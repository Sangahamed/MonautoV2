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
        Schema::table('abonnement_plans', function (Blueprint $table) {
            $table->integer('type')->comment('0->Free, 1->Standard, 2->Premium')->after('prix');
            $table->integer('status')->comment('0->desactive, 1->active')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abonnement_plans', function (Blueprint $table) {
            //
        });
    }
};
