<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1503940463AppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('appeals')) {
            Schema::create('appeals', function (Blueprint $table) {
                $table->increments('id');
                $table->text('description');
                $table->text('report')->nullable();
                $table->string('appellant');
                $table->date('date')->nullable();
                $table->string('court_decision')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('appeals');
    }
}
