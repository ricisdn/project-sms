<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNilaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nilais', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('id_mapel');
			$table->integer('id_pengumpulan');
			$table->integer('id_user');
			$table->integer('nilai')->nullable();
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
		Schema::drop('tbl_nilais');
	}

}
