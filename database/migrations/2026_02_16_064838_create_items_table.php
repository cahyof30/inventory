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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('code',50)->unique();
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('item_categories')->onDelete('cascade');
            $table->enum('item_type', ['fixed_asset', 'consumable'])->default('fixed_asset');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->decimal('purchase_price', 15,2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->enum('condition', ['good', 'broken']);
            $table->integer('stock')->default(1); 
            $table->string('image')->nullable();
            $table->text('qr_code')->nullable();
            $table->text('barcode')->nullable();
            $table->text('description')->nullable();
            $table->json('specifications')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
