<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_district', function (Blueprint $table) {
            $table->foreignId('route_id')
                ->foreign('route_id')
                ->references('id')
                ->on('routes');
            $table->foreignId('district_id')
                ->foreign('district_id')
                ->references('id')
                ->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_district');
    }
}
