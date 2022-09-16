<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_guardian', function (Blueprint $table) {
            $table->integer('guardian_id')->unsigned();
            // $table->foreign('guardian_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('school_id')->unsigned();
            // $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            $table->primary(['guardian_id', 'school_id']);
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
        Schema::table('school_guardian',function(Blueprint $table)
        {
            $table->dropForeign('guardian_id_foreign');
            $table->dropForeign('school_id_foreign');
        });
        Schema::drop('school_guardian');
    }
};
