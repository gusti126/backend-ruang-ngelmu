<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            // nama, sertifikat, thumbnail, type, status, price, level, deskripsi
            $table->id();
            $table->string('nama');
            $table->boolean('sertifikat');
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['free', 'premium']);
            $table->integer('price')->default(0)->nullable();
            $table->enum('level', ['all-level', 'beginer', 'intermediate', 'advance']);
            $table->longText('deskripsi')->nullable();
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade');
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
}
