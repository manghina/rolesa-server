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
        Schema::table('users', function($table) {
            $table->string('website')->nullable();;
            $table->date('birthday')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('country')->nullable();;
            $table->string('state')->nullable();;
            $table->string('city')->nullable();;
            $table->string('bio')->nullable();;
            $table->string('birthplace')->nullable();;
            $table->string('genre')->nullable();;
            $table->string('occupation')->nullable();;
            $table->string('religion')->nullable();;
            $table->string('status')->nullable();;
            $table->string('politic')->nullable();;
            $table->string('facebook')->nullable();;
            $table->string('twitter')->nullable();;
            $table->string('rss')->nullable();;
            $table->string('dribble')->nullable();;
            $table->string('spotify')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function($table) {
            $table->dropColumn('website');
            $table->dropColumn('birthday');
            $table->dropColumn('phone');
            $table->dropColumn('country');
            $table->dropColumn('state');
            $table->dropColumn('city');
            $table->dropColumn('bio');
            $table->dropColumn('birthplace');
            $table->dropColumn('gender');
            $table->dropColumn('occupation');
            $table->dropColumn('religion');
            $table->dropColumn('status');
            $table->dropColumn('politic');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('rss');
            $table->dropColumn('dribble');
            $table->dropColumn('spotify');
        });
    }
};
