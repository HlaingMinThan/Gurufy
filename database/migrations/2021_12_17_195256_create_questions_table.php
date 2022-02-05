<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serial');
            $table->longText('title')->nullable()->comment('Here will be question, ex: where do you live?');
            $table->unsignedBigInteger('question_type')->comment('like description, mcq, rearrange, equation question');
            $table->json('options')->nullable()->comment("['option1'=>'Dhaka','option2'=>'Sylhet','option3'=>'Barishal','option4'=>'Ctg']");
            $table->json('correct_answer')->nullable()->comment("['option1'=>Dhaka]");
            $table->text('explanation')->nullable();
            $table->string('question_file')->nullable()->comment('if its an equation question type');
            $table->smallInteger('level')->default(1);

            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('topic_id');
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
