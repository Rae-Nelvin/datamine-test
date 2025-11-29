<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController
{
    public function index()
    {
        $users = User::all();
        $tasks = Task::orderBy("created_at", "desc")->with(["creator", "assignee", "status"])->simplePaginate(10);

        return view("user.tasks", compact("users", "tasks"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "TITLE" => "required|string|max:255",
            "DESCRIPTION" => "nullable|string",
            "DEADLINE" => "required|date|after_or_equal:now",
            "ASSIGNEE" => "required|integer|exists:users,id",
        ], [
            "DEADLINE.after_or_equal" => "The deadline must be a date after or equal to today.",
        ]);

        $task = Task::create([
            "title" => $data["TITLE"],
            "description" => $data["DESCRIPTION"] ?? null,
            "deadline" => $data["DEADLINE"],
            "status_id" => 1,
            "creator_id" => auth()->id(),
            "assignee_id" => $data["ASSIGNEE"],
        ]);

        return response()->json([
            "success" => true,
            "task" => $task->load(["creator", "assignee", "status"])
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            "TITLE" => "required|string|max:255",
            "DESCRIPTION" => "nullable|string",
            "DEADLINE" => "required|date|after_or_equal:now",
            "ASSIGNEE" => "required|integer|exists:users,id",
        ], [
            "DEADLINE.after_or_equal" => "The deadline must be a date after or equal to today.",
        ]);

        $task->update([
            "title" => $data["TITLE"],
            "description" => $data["DESCRIPTION"] ?? null,
            "deadline" => $data["DEADLINE"],
            "assignee_id" => $data["ASSIGNEE"],
        ]);

        return response()->json([
            "success" => true,
            "task" => $task->load(["creator", "assignee", "status"])
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route("tasks.index");
    }
}
