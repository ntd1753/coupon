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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->nullable();
            $table->string('code');
            $table->string('discount_type'); // percentage, fixed
            $table->double('discount_amount', 12, 2);
            $table->text('description');
            $table->integer('minimum_purchases')->default(0);
            $table->integer('maximum_purchases')->nullable();
            $table->double('minimum_price', 12, 2)->nullable();
            $table->double('maximum_spend_discount', 12, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('use_limit')->nullable();
            $table->integer('use_limit_per_user')->nullable();
            $table->enum('multiple_use', ['yes', 'no'])->default('no');
            $table->integer('total_use')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
