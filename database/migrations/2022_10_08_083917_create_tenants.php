<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kana');
            $table->string('age')->nullable();
            $table->string('sex')->nullable();
            $table->string('emergency_contact')->comment('緊急連絡先');
            $table->string('contact_name')->comment('緊急連絡先名');
            $table->string('institution_id')->comment('入居施設id');
            $table->integer('check')->default(0)->comment('体調登録フラグ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
