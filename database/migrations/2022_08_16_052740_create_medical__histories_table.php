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
        Schema::create('medical__histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->mediumText('medical_detail');
            $table->string('date');
            $table->string('dr_name');
            

            // $table->unsignedBigInteger('cat_id');
            // $table->foreign('cat_id')->references('id')->on('cats')->nullable()->onDelete('cascade');
            $table->foreignId('cat_id')->nullable()->constrained("cats")->cascadeOnUpdate()->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical__histories');
    }
};
