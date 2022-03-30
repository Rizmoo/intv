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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table ->string('shipment_id')->nullable();
            $table ->foreignId('fleet_id')->nullable()->constrained()->nullOnDelete();
            $table -> string('from')->nullable();
            $table -> string('to')->nullable();
            $table -> string('state')->default('pending');
            $table -> timestamp('departure_time')->nullable();
            $table -> timestamp('arrival_time')->nullable();
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
        Schema::dropIfExists('shipments');
    }
};
