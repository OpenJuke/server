<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrackToArtistRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_artist', function (Blueprint $table) {
            $table->unsignedBigInteger('track_id');
            $table->unsignedBigInteger('artist_id');
        
            $table->foreign('track_id')->references('id')->on('tracks')
                ->onDelete('cascade');
        
            $table->foreign('artist_id')->references('id')->on('artists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('track_artist');
    }
}
