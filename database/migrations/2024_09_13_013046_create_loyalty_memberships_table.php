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
        Schema::create('loyalty_memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên cấp độ thành viên
            $table->integer('spending_required'); // Số tiền chi tiêu yêu cầu để đạt cấp độ này
            $table->double('point_coefficient'); // Hệ số điểm tích lũy
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_memberships');
    }
};
