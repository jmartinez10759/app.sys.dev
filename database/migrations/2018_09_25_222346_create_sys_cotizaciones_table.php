<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->nullable();
            $table->mediumText('descripcion')->nullable();
            $table->integer('id_moneda')->default(1);
            $table->integer('id_contacto')->default(1);
            $table->string('condiciones_pago')->nullable();
            $table->integer('id_estatus')->default(1);
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
        Schema::dropIfExists('sys_cotizaciones');
    }
}
