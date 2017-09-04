<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create59a44f73285e0AppealReasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('appeal_reason')) {
            Schema::create('appeal_reason', function (Blueprint $table) {
                $table->integer('appeal_id')->unsigned()->nullable();
                $table->foreign('appeal_id', 'fk_p_69110_69105_reason_a_59a44f73286ef')->references('id')->on('appeals')->onDelete('cascade');
                $table->integer('reason_id')->unsigned()->nullable();
                $table->foreign('reason_id', 'fk_p_69105_69110_appeal_r_59a44f73287a2')->references('id')->on('reasons')->onDelete('cascade');
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
        Schema::dropIfExists('appeal_reason');
    }
}
