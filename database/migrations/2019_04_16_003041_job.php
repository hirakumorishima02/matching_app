<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Job extends Migration {
    public function up() { 
        Schema::create('jobs', function (Blueprint $table) { 
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('user_id'); 
            $table->string('title'); 
            $table->longText('content'); 
            $table->date('wish_at'); 
            $table->timestamps(); 

            $table->index( 'user_id' );

            // 参照制約（Usersテーブルへの外部キー）
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users');
        }); 
    } 
    public function down() {
        Schema::drop('jobs'); 
    } 
} 
