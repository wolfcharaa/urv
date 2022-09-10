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
        Schema::create('urv_objects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->string('address')->nullable();
        });
        Schema::create('firebird_controllers', function (Blueprint $table) {
           $table->id();
           $table->timestamps();
           $table->string('mac')->unique();
           $table->foreignId('urv_object_id')->unique()->constrained();
        });
        Schema::create('event_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('event_time');
            $table->string('name');
            $table->foreignId('event_status_id')->constrained();
            $table->string('screen_url');
            $table->string('screen_path');
            $table->foreignId('urv_objects_id')->constrained();
        });
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId(  'urv_object_id')->unique()->constrained();
            $table->string(     'server_ip')->default('office.icstech.ru');
            $table->integer(    'server_port')->default(8080);
            $table->string(     'sdk_password');
            $table->integer(    'rtsp_port')->default(556);
            $table->string(     'cam_guid');
            $table->string(     'database_ip')->default('office.icstech.ru');
            $table->integer(    'firebird_port')->default(3060);
            $table->string(     'firebird_login')->default('sysdba');
            $table->string(     'firebird_password')->default('Request11');
            $table->integer(    'screen_delta_second')->default(0);
            $table->integer(    'max_events_count')->default(10);
            $table->foreignId(  'firebird_controller_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_statuses');
        Schema::dropIfExists('firebird_controllers');
        Schema::dropIfExists('urv_objects');
    }
};
