<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSiswasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_siswas', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('id_user')->nullable();
			$table->integer('id_kelas');
			$table->date('tgl_lahir');
			$table->string('nomor_telepon');
			$table->string('jenis_kelamin');
			$table->string('alamat');
			$table->text('foto', 65535)->nullable();
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
		Schema::drop('tbl_siswas');
	}

}
