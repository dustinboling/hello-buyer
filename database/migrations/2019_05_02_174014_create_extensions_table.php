<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('number')->unique();
            $table->string('name');
            $table->text('message');
            $table->text('transfer_prompt');
            $table->text('voicemail_prompt');
            $table->timestamps();

            // Indexes
            $table->index('number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extensions');
    }
}
