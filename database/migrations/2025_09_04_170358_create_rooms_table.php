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
            $table->unsignedBigInteger('dharmashala_id');
            $table->string('room_number')->nullable();
            $table->string('room_title')->nullable();
            $table->string('room_type')->nullable();
            $table->string('category')->nullable();
            $table->integer('total_rooms')->default(1);
            $table->decimal('base_price', 10, 2);
            $table->decimal('extra_bed_price', 10, 2)->nullable();
            $table->tinyInteger('max_adults')->default(2)->nullable();;
            $table->tinyInteger('max_children')->default(0);
            $table->string('bed_type')->nullable();
            $table->text('amenities')->nullable();
            $table->text('description')->nullable();
            $table->string('floor_number')->nullable();
            $table->integer('room_size')->nullable();
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
