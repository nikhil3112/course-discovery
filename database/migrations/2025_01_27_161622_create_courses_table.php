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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('instructor');
            $table->string('category');
            $table->enum('difficulty', ['Beginner', 'Intermediate', 'Advanced']);
            $table->integer('duration'); // in hours
            $table->integer('rating')->default(0); // rating out of 5
            $table->enum('format', ['Video', 'Text-based', 'Interactive/Live']);
            $table->boolean('certification')->default(false);
            $table->timestamp('release_date')->nullable();
            $table->integer('popularity')->default(0);
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
        Schema::dropIfExists('courses');
    }
};
