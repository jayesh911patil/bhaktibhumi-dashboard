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
        Schema::create('room_header', function (Blueprint $table) {
            $table->id('room_id');
            $table->string('room_number')->nullable();
            $table->tinyInteger('room_type')->nullable();
            $table->tinyInteger('ac_no_ac')->nullable()->comment('1 for AC, 0 for Non-AC');
            $table->integer('bed_capacity')->nullable();
            $table->string('rent')->nullable();
            $table->string('dharmashala_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
