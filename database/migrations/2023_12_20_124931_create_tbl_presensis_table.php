<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPresensisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_presensis', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('id_mapel');
			$table->integer('id_user');
			$table->string('status');
			$table->string('keterangan')->nullable();
			$table->date('tgl_presensi');
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
		Schema::drop('tbl_presensis');
	}

}
