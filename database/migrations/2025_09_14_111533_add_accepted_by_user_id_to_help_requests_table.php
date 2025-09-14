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
        Schema::table('help_requests', function (Blueprint $table) {
            // Ajout de la colonne
            $table->foreignId('accepted_by_user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null')
                ->after('user_id'); // tu peux mettre "after" où tu veux
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('help_requests', function (Blueprint $table) {
            $table->dropForeign(['accepted_by_user_id']);
            $table->dropColumn('accepted_by_user_id');
        });
    }
};
