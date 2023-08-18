<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Chats', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer("user_id");
            $table->foreignId('user_id')->constrained('users'); // usersは適切なテーブル名に置き換えてください
            $table->integer("partner")->unsigned();;
            $table->string('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_chats');
    }
};
