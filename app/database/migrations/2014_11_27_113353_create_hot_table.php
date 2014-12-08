<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('hot', function ($table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('hid', 10000)->comment('热点ID');
            $table->bigInteger('uid')->index()->comment('用户ID');
            $table->string('title',500)->comment('标题');
            $table->string('link',300)->nullable()->comment('链接');
            $table->string('password', '100')->nullable()->comment('密码');
            $table->string('email', '50')->nullable()->unique()->comment('邮箱');
            // created_at, updated_at DATETIME
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::dropIfExists('hot');
	}

}
