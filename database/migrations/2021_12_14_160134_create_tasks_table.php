<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->timestamp('start_task')->nullable();
            $table->timestamp('must_end_task');
            $table->timestamp('end_task')->nullable();
            $table->text('task_description')->nullable();
            $table->string('priority');
            $table->boolean('accepted')->nullable();
            $table->boolean('deadline_expired')->nullable();
            $table->foreignId('executor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('creator_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
