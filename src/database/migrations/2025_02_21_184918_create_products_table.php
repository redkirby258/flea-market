<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('sold')->default(false);
            $table->text('description');
            $table->string('category');
            $table->string('status');
            $table->timestamps();
        });
    }
 
    /* * * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
