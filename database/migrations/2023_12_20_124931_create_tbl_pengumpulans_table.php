<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPengumpulansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_pengumpulans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('id_user');
			$table->integer('id_kelas');
			$table->integer('id_mapel');
			$table->integer('id_tugas')->nullable();
			$table->text('file', 65535);
			$table->integer('nilai')->nullable();
			$table->string('catatan')->nullable();
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
		Schema::drop('tbl_pengumpulans');
	}

}
