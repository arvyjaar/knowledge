<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create59a44f732424bAppealTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('appeal_tag')) {
            Schema::create('appeal_tag', function (Blueprint $table) {
                $table->integer('appeal_id')->unsigned()->nullable();
                $table->foreign('appeal_id', 'fk_p_69110_69098_tag_appe_59a44f7324326')->references('id')->on('appeals')->onDelete('cascade');
                $table->integer('tag_id')->unsigned()->nullable();
                $table->foreign('tag_id', 'fk_p_69098_69110_appeal_t_59a44f73243a6')->references('id')->on('tags')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appeal_tag');
    }
}
