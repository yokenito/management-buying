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
        Schema::create('rceives', function (Blueprint $table) {
            $table->id();
            $table->integer('receive_id')->length(20)->unique();
            $table->foreignId('estimate_id')->cascadeOnDelete()->nullable(true);
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('delivery_place')->nullable(true);
            $table->string('subject');
            $table->string('delivery_line');
            $table->string('date_line');
            $table->string('pay_requirement');
            $table->integer('sum_price')->length(15)->default(0);
            $table->foreignId('person_id')->constrained()->cascadeOnDelete();
            $table->date('issue_date');
            $table->text('receive_requirement',1000);
            $table->text('note',1000);
            $table->integer('status')->length(3)->default(0);
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
        Schema::dropIfExists('rceives');
    }
};
