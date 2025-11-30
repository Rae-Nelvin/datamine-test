<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = Task::with(["creator", "assignee", "status"])
            ->where("assignee_id", $user->id)
            ->orWhere("creator_id", $user->id)
            ->orderBy("created_at", "desc")
            ->get();

        return response()->json([
            "success" => true,
            "data" => $tasks
        ]);
    }
}
