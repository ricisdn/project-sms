<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOrangtuasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_orangtuas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_user');
			$table->integer('id_siswa');
			$table->date('tgl_lahir');
			$table->string('nomor_telepon', 100);
			$table->string('jenis_kelamin');
			$table->string('alamat');
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
		Schema::drop('tbl_orangtuas');
	}

}
