<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

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
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('number_telephone')->nullable();
            $table->string('username')->nullable();
            $table->string('password');
            $table->enum('level', ['user', 'admin']);
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'number_telephone' => '08980533093',
            'username' => 'admin',
            'password' =>   Hash::make('123456'),
            'level' => 'admin',
        ]);
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
