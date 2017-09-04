<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59a5af976573bRelationshipsToAppealTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appeals', function (Blueprint $table) {
            if (!Schema::hasColumn('appeals', 'court_decision_id')) {
                $table->integer('court_decision_id')->unsigned()->nullable();
                $table->foreign('court_decision_id', '69110_59a45091f3832')->references('id')->on('court_decisions')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appeals', function (Blueprint $table) {
        });
    }
}
