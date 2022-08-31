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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(1)->after('password');
            $table->string('name_kanji')->nullable()->after('role');
            $table->string('name_kana')->nullable()->after('name_kanji');
            $table->string('number')->nullable()->after('name_kana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('name_kanji');
            $table->dropColumn('name_kana');
            $table->dropColumn('number');
        });
    }
};
