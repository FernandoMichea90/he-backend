<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearRelacionesRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
           
            $table->foreign('id_tipo_habitacion','fk_tipo_rooms')->references('id')->on('tipo_rooms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
         
           $table->dropForeign('fk_tipo_rooms');
        });
    }
}
