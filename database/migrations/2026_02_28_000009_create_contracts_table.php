<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique();
            $table->foreignId('listing_id')->nullable()->constrained('listings')->nullOnDelete();
            $table->foreignId('property_id')->constrained('properties')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('owners')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('broker_id')->nullable()->constrained('brokers')->nullOnDelete();
            $table->enum('contract_type', ['sale', 'rent']);
            $table->decimal('contract_value', 12, 2);
            $table->decimal('commission_amount', 12, 2)->nullable();
            $table->decimal('broker_commission', 12, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('payment_method', ['cash', 'installments', 'transfer'])->default('cash');
            $table->enum('status', ['active', 'expired', 'cancelled', 'suspended'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
