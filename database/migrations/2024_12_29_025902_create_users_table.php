<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 50);
            $table->string('password', 255);
            $table->string('email', 50)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
