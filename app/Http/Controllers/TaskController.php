<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
  public function tasks()
      {
          $tasks = Task::with('board,user')->paginate(10);

          return view(
              'tasks.index',
              ['tasks' => $tasks]
          );
      }

      public function edit($id)
      {
          $task = DB::find($id);

          return response()->json([
              'data' => $task
          ]);
      }

      public function update(Request $request, $id)
      {
          DB::table('boards')->updateOrCreate(
              ['id' => $id]

          );

          return response()->json(['success' => true]);

      }

      public function delete($id)
      {

          $task = Task::find()->where('id', $id)->first();
          $task->delete();
          return response()->json([
              'message' => 'Task deleted successfully!'
          ]);

      }
  }
