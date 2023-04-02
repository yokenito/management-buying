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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->length(20)->unique();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('delivery_place')->nullable(true);
            $table->string('subject');
            $table->string('delivery_line');
            $table->string('date_line');
            $table->string('pay_requirement');
            $table->integer('sum_price')->length(15);
            $table->foreignId('person_id')->constrained()->cascadeOnDelete();
            $table->date('issue_date');
            $table->text('estimate_requirement',1000);
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
        Schema::dropIfExists('estimates');
    }
};
