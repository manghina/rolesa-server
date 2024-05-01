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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('friend_request');            
            $table->string('view_level');            
            $table->string('notification_sound');            
            $table->string('notification_email');            
            $table->string('friend_birthday');            
            $table->string('chat_sound');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropIfExists('friend_request');            
        $table->dropIfExists('view_level');            
        $table->dropIfExists('notification_sound');            
        $table->dropIfExists('notification_email');            
        $table->dropIfExists('friend_birthday');            
        $table->dropIfExists('chat_sound');          
    }
};
