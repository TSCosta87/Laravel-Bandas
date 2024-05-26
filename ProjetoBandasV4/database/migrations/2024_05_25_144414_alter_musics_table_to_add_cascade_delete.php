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
        Schema::table('musics', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->foreign('album_id')
                ->references('id')
                ->on('albuns')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('musics', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->foreign('album_id')
                ->references('id')
                ->on('albuns');
        });
    }
};
