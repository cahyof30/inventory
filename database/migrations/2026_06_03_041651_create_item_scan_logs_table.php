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
        Schema::create('item_scan_logs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('item_id');

            $table->ipAddress('ip')->nullable();

            $table->text('user_agent')->nullable();

            $table->timestamp('scanned_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_scan_logs');
    }
};
