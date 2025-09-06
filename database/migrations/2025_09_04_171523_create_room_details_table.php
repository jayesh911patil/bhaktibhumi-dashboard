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
        Schema::create('room_details', function (Blueprint $table) {
            $table->id('room_detail_id');
            $table->unsignedBigInteger('room_id');
            $table->string('room_code');
            $table->string('room_number')->nullable();
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->tinyInteger('current_status')->default(1)->comment('1-Available, 2-Occupied, 3-Maintenance, 4-Under Construction');
            $table->tinyInteger('owner_confirmation_status')->default(1)->comment('1-confirm, 2-cancel');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_details');
    }
};
