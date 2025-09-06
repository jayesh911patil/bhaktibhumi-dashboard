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
        Schema::create('partner_with_us', function (Blueprint $table) {
            $table->id('partner_with_us_id');
            $table->string('dharamshala_id')->nullable();
            $table->string('name')->nullable();
            $table->string('dharamshala_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->longText('address')->nullable();
            $table->longText('dharamshala_address')->nullable();
            $table->string('auth_sign')->nullable();
            $table->string('auth_aadhar')->nullable();
            $table->string('auth_img')->nullable();
            $table->string('status')->nullable();
            $table->string('admin_status')->nullable();
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
