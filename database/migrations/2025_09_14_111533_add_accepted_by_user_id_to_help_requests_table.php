<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->foreignId('accepted_by_user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dropForeign(['accepted_by_user_id']);
            $table->dropColumn('accepted_by_user_id');
        });
    }
};
