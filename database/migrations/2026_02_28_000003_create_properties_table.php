<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->foreignId('owner_id')->constrained('owners')->cascadeOnDelete();
            $table->string('title');
            $table->enum('status', ['available', 'reserved', 'sold', 'rented'])->default('available');
            $table->decimal('price', 12, 2)->nullable();
            $table->decimal('area', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();

            // حقول المباني
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('building_age')->nullable();
            $table->boolean('furnished')->default(false);
            $table->string('direction')->nullable();

            // حقول الأراضي
            $table->enum('land_type', ['residential', 'commercial', 'agricultural'])->nullable();
            $table->string('plan_number')->nullable();
            $table->string('plot_number')->nullable();
            $table->decimal('street_width', 6, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
