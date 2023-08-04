<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user',60);
            $table->string('username', 60)->unique();
            $table->string('password');
            $table->string('email', 200)->unique();
            $table->string('no_hp', 30);
            $table->string('wa', 30);
            $table->string('pin', 30);
            $table->string('id_jenis_user', 3);
            $table->string('status_user', 30)->default('active');
            $table->boolean('delete_mark')->default(false);
            $table->string('create_by',60);
            $table->string('update_by');
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
        Schema::dropIfExists('users');
    }
};
