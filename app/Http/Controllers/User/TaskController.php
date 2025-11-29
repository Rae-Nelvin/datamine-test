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
        $tasks = Task::with(["creator", "assignee", "status"])->get();

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
}
