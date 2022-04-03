<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->text('reason')->nullable();
            $table->text('response')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('requester_id');
            $table->foreign('requester_id')->references('id')->on('users');
            $table->foreignId('responder_id')->nullable();
            $table->foreign('responder_id')->references('id')->on('users');
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_requests');
    }
}
