<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSeriesEntregadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_series_entregadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('serie_entregada_id')->unsigned();
            $table->foreign('serie_entregada_id')->references('id')->on('series_entregadas');
            $table->bigInteger('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->bigInteger('serie_id')->unsigned();
            $table->foreign('serie_id')->references('id')->on('num_series');
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
        Schema::dropIfExists('detalle_series_entregadas');
    }
}
