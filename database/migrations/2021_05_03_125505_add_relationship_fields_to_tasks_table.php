<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('boards', function (Blueprint $table) {
           $table->foreignId('tasks_id')->constrained('boards')->onDelete('cascade');

         });
     }

  }
  public function down()
  {
      Schema::dropIfExists('boards');
  }
}
