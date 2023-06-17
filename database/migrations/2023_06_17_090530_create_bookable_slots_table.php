<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookableSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookable_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->integer('total_entries')->default(0);
            $table->boolean('is_booked')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookable_slots');
    }
}
