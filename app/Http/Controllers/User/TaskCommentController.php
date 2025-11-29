<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\TaskComment;
use App\Models\Task;

class TaskCommentController
{
    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            "COMMENT" => "required|string|max:1000",
        ]);

        TaskComment::create([
            "task_id" => $task->id,
            "user_id" => auth()->id(),
            "comment" => $data["COMMENT"],
        ]);

        return redirect()->route("tasks.detail", $task->id);
    }
}
