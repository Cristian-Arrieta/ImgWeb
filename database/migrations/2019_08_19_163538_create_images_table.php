<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
	    $table->string('name');
	    $table->text('description')->nullable();
		$table->text('tags')->nullable();
	    $table->string('type');
	    $table->string('path')->nullable();
		$table->integer('width')->nullable();
	    $table->integer('height')->nullable();
	    $table->Date('date');
	    
	    $table->BigInteger('user_id')->unsigned()->index();
	    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	    
	    	    
	    $table->softDeletes();
            $table->timestamps();
	    
	    
	    
        });
	
	//DB::statement("ALTER TABLE images ADD img LONGBLOB");
	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
