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
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('price'); // Remove the generic price field

            // Sale specific fields
            $table->decimal('asking_price', 15, 2)->nullable()->after('listing_type');
            $table->decimal('minimum_price', 15, 2)->nullable()->after('asking_price')->comment('For admin/broker eyes only');

            // Rent specific fields
            $table->decimal('rent_price', 15, 2)->nullable()->after('minimum_price');
            $table->enum('rent_cycle', ['monthly', 'quarterly', 'semi_annually', 'annually'])->nullable()->after('rent_price');
            $table->decimal('security_deposit', 15, 2)->nullable()->after('rent_cycle');

            // Shared Negotiation options
            $table->boolean('is_negotiable')->default(false)->after('security_deposit');
            $table->boolean('accepts_installments')->default(false)->after('is_negotiable');

            // Listing Source
            $table->enum('source', ['owner', 'broker'])->default('owner')->after('accepts_installments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->nullable();
            
            $table->dropColumn([
                'asking_price', 'minimum_price', 
                'rent_price', 'rent_cycle', 'security_deposit',
                'is_negotiable', 'accepts_installments', 'source'
            ]);
        });
    }
};
