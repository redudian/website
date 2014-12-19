<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotTable extends Migration
{

    /**
     * Run the migrations.
     * 热点表
     * @return void
     */
    public function up()
    {
        //
        Schema::create('hot', function ($table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('hid', 10000)->comment('热点ID');
            $table->bigInteger('uid')->index()->comment('用户ID');
            $table->integer('bid')->index()->comment('版块ID');
            $table->string('title', 500)->comment('标题');
            $table->string('link', 300)->nullable()->comment('链接');
            $table->integer('up_num', 0)->comment('up次数');
            $table->integer('down_num', 0)->comment('down次数');
            $table->integer('comment_num', 0)->comment('评论次数');
            $table->integer('fav_num', 0)->comment('收藏次数');
            $table->dateTime('interact_at')->comment('最后互动时间');
            $table->tinyInteger('status', 1)->comment('状态');
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
