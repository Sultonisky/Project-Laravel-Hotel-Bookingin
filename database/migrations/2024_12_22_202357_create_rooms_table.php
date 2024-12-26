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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_categories_id');
            // $table->unsignedBigInteger('guests_id');
            $table->boolean('status');
            $table->string('room_name');
            $table->text('detail');
            $table->double('price');
            $table->integer('number_of_rooms');
            $table->string('foto'); // Thumbnail image 
            $table->timestamps();
            $table->foreign('room_categories_id')
                ->references('id')
                ->on('room_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // $table->foreign('guests_id')
            //     ->references('id')
            //     ->on('guests')
            //     ->onDelete('cascade')
            //     ->onUpdate('cascade');
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
