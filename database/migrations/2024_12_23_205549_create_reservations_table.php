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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->unsignedBigInteger('guests_id');
            $table->unsignedBigInteger('rooms_id');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->boolean('payment_method');
            $table->decimal('total_payment', 10, 2)->default(0);
            $table->enum('status', ['pending', 'success', 'canceled'])->default('pending');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('guests_id')
                ->references('id')
                ->on('guests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('rooms_id')
                ->references('id')
                ->on('rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
