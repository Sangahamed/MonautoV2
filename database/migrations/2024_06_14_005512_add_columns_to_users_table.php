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
        Schema::table('users', function (Blueprint $table) {
            // Update the data type for last_login_at
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip', 45)->nullable()->after('last_login_at'); // Limit IP address length
            $table->string('last_login_agent_user', 255)->nullable()->after('last_login_ip');
            $table->string('device_type', 255)->nullable()->after('last_login_agent_user');
            $table->string('device_os', 255)->nullable()->after('device_type');
            $table->string('device_browser', 255)->nullable()->after('device_os');
            $table->string('device_resolution', 255)->nullable()->after('device_browser');
            $table->string('device_language', 255)->nullable()->after('device_resolution');
        });
    }

    /**
     * Reverse the migrations.
     */
      public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_login_at',
                'last_login_ip',
                'last_login_agent_user',
                'device_type',
                'device_os',
                'device_browser',
                'device_resolution',
                'device_language',
            ]);
        });
    }
};
