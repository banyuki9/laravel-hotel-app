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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
            $table->longText('note');
            $table->integer('adult_number');
            $table->integer('child_number');
            $table->integer('total_amount');
            $table->string('stripe_id');
            $table->boolean('checkin_status');
            $table->boolean('has_credit_card');
            $table->string('book_code', 16);
            $table->date('checkin_at');
            $table->date('checkout_at');
            $table->date('booked_at');
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
        Schema::dropIfExists('books');
    }
};