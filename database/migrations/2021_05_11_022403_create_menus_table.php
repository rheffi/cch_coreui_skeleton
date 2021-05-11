<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable()->comment('메뉴이름');
            $table->integer('parent_id')->nullable()->default(0)->comment('상위메뉴id');
            $table->string('manifest_name')->nullable()->comment('권한이름');
            $table->string('href')->nullable()->comment('링크');
            $table->integer('sort')->nullable()->default(0)->comment('순서');
            $table->integer('creator_id')->nullable()->comment('작성자id');
            $table->integer('updater_id')->nullable()->comment('수정자id');
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
