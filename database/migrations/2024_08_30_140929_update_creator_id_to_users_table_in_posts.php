<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the old foreign key constraint and column
            $table->dropForeign(['creator_id']);
            $table->dropColumn('creator_id');

            // Add the new foreign key constraint referencing the users table
            $table->foreignId('creator_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop the new foreign key constraint and column
            $table->dropForeign(['creator_id']);
            $table->dropColumn('creator_id');

            // Optionally, you can revert back to the creators table foreign key if needed
            $table->foreignId('creator_id')->nullable()->constrained('creators')->onDelete('cascade')->onUpdate('cascade');
        });
    }
};
