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
            $table->unsignedBigInteger('guests_id');
            $table->unsignedBigInteger('rooms_id');
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->boolean('payment');
            $table->decimal('total_payment', 10, 2)->default(0);
            $table->timestamps();
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
