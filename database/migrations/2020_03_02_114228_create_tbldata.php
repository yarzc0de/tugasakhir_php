<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbldata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_biodata', function (Blueprint $table) {
            $table->increments('id');
            $table->char("nama", 100);
            $table->char("no_hp", 100);
            $table->char("alamat", 100);
            $table->text("hobi");
            $table->text("foto");
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
        Schema::dropIfExists('tbl_biodata');
    }
}
