<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class order_details extends Model
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('order_id')->default(0);
			$table->integer('product_id')->default(0);
			$table->integer('qty')->default(0);
            $table->integer('price')->default(0);
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
		Schema::drop('order_details');
	}
}
