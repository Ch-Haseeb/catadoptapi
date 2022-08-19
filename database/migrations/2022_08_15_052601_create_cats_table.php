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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();            
            $table->string('name');
            $table->string('color');
            $table->enum('breed',['Exotic Shorthair Cats','Ragdoll Cats','British Shorthair','Persian Cats','Maine Coon Cats','American Shorthair Cats','Scottish Fold Cats','Sphynx Cats'])->default('Ragdoll Cats');
            $table->string('DOB');
            $table->string('features');
            $table->string('picture');
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('cats');
    }
};
