<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');            
            $table->tinyInteger('event_status')->nullable()->default(1)->comment('1 => Active, 2 => Disabled');
            $table->tinyInteger('event_type')->nullable()->default(0)->comment('1 => Public, 2 => Private');        
            $table->unsignedInteger('user_id')->nullable();
            $table->text('body')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->datetime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
