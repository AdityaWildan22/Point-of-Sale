<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cafe_menu', function (Blueprint $table) {
            $table->increments("id");
            $table->string('kd_menu',10);
            $table->string('nm_menu',5)->unique();
            $table->string('kategori',10);
            $table->string('dapur',10);
            $table->string('harga',10);
            $table->string('stok',15);
            $table->text('desc');
            $table->text('foto');
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
        Schema::dropIfExists('cafe_menu');
    }
}
