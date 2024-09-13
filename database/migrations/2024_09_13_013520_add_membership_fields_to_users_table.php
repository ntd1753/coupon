<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('membership_level_id')->nullable()->after('id');
            $table->foreign('membership_level_id')->references('id')->on('loyalty_memberships')->onDelete('set null');
            $table->date('membership_expires_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('membership_level_id');
            $table->dropColumn('membership_expires_at');
        });
    }
};
