<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_coordinates', function (Blueprint $table) {
            $table->double('lat', 10, 6);
            $table->double('long', 10, 6);
            $table->foreignId('route_id')
                ->foreign('route_id')
                ->references('id')
                ->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_coordinates');
    }
}
