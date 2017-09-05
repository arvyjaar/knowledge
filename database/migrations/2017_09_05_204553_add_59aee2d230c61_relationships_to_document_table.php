<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add59aee2d230c61RelationshipsToDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function(Blueprint $table) {
            if (!Schema::hasColumn('documents', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '71366_59aee2d086154')->references('id')->on('doccategories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('documents', 'organisation_id')) {
                $table->integer('organisation_id')->unsigned()->nullable();
                $table->foreign('organisation_id', '71366_59aee2d091035')->references('id')->on('organisations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('documents', 'department_id')) {
                $table->integer('department_id')->unsigned()->nullable();
                $table->foreign('department_id', '71366_59aee2d097c37')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::table('documents', function(Blueprint $table) {
            
        });
    }
}
