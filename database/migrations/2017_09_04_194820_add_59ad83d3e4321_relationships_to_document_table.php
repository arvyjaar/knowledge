<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59ad83d3e4321RelationshipsToDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'organisation_id')) {
                $table->integer('organisation_id')->unsigned()->nullable();
                $table->foreign('organisation_id', '70985_59ad82c15d21a')->references('id')->on('organisations')->onDelete('cascade');
            }
            if (!Schema::hasColumn('documents', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '70985_59ad82c163e63')->references('id')->on('doccategories')->onDelete('cascade');
            }
            if (!Schema::hasColumn('documents', 'changed_id')) {
                $table->integer('changed_id')->unsigned()->nullable();
                $table->foreign('changed_id', '70985_59ad83d298863')->references('id')->on('documents')->onDelete('cascade');
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
        Schema::table('documents', function (Blueprint $table) {
        });
    }
}
