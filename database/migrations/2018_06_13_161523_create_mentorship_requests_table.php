<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorshipRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentorship_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->enum('for', ['mentor', 'mentee']);
            $table->text('description');
            $table->timeTz('pairing_time');
            $table->integer('days');
            $table->enum('status', ['pending', 'progress', 'ended'])->default('pending');
            $table->integer('session_duration');
            $table->integer('mentorship_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentorship_requests');
    }
}
