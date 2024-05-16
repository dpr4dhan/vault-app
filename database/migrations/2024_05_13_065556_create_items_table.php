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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid();
            $table->enum('type', ['login', 'card', 'identity', 'note']);
            $table->string('title');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('favourite')->default(false);
            $table->string('url')->nullable();
            $table->longText('note')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_type')->nullable();
            $table->tinyInteger('card_expiration_month')->nullable();
            $table->integer('card_expiration_year')->nullable();
            $table->integer('card_security_code')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();
        });
        Schema::table('items', function($table) {
           $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
