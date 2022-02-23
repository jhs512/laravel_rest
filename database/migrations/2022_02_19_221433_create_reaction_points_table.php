<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reaction_points', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->string('reaction_pointable_type', 20);
            $table->unsignedBigInteger('reaction_pointable_id');
            $table->smallInteger('point')->default(0);

            $table->unique(array('reaction_pointable_type', 'reaction_pointable_id', 'user_id'), 'unique_key_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reaction_points');
    }
}
