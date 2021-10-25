<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_ar")->nullable();
            $table->integer("delivery_fees")->default(0);
            $table->text("deactivation_notes")->nullable();
            $table->boolean("active")->default(0);
            $table->integer("city_id")->unsigned();
            $table->foreign("city_id")->references("id")->on("cities")->onDelete("cascade");
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
        Schema::dropIfExists('areas');
    }
}
