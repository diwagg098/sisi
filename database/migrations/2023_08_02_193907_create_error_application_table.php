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
        Schema::create('error_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('modules');
            $table->string('controller');
            $table->string('function');
            $table->string('error_line');
            $table->longText('error_message');
            $table->string('status');
            $table->string('param');
            $table->boolean('delete_mark')->default(false);
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
        Schema::dropIfExists('error_application');
    }
};
