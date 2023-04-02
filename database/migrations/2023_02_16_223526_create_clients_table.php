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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->integer('post_code')->length(10);
            $table->string('client_address');
            $table->integer('client_phone')->default(0);
            $table->string('delivery_destination')->nullable(true);
            $table->integer('estimate_count')->length(10)->default(0);
            $table->integer('receive_count')->length(10)->default(0);
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
        Schema::dropIfExists('clients');
    }
};
