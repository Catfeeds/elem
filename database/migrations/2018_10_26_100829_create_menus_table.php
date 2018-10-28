<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name' ,100)->unique()->comment('菜品名称');
            $table->float('rating')->comment('评分');
            $table->integer('shop_id')->comment('所属商家');
            $table->integer('category_id')->comment('	所属分类');
            $table->decimal('goods_price')->nullable()->comment('价格');
            $table->string('description')->nullable()->comment('描述');
            $table->integer('month_sales')->nullable()->comment('月销量');
            $table->integer('rating_count')->nullable()->comment('评分数量');
            $table->boolean('tips')->nullable()->comment('提示信息');
            $table->integer('satisfy_count')->comment('满意度数量');
            $table->float('satisfy_rate')->comment('满意度评分');
            $table->string('goods_img')->comment('店公告');
            $table->integer('status')->comment('状态:1上架,0下架');

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
        Schema::dropIfExists('menus');
    }
}
