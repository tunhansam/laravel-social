<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('email',128);
            $table->string('facebook_id',64);
            $table->addColumn('integer','status',['lenght'=>1]);
            $table->addColumn('integer','ins_id',['lenght'=>11]);
            $table->addColumn('integer','upd_id',['lenght'=>11])->nullable();
            $table->timestamps();
            $table->boolean('del_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
