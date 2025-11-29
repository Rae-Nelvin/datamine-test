<?php

namespace App\Http\Controllers\User;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskHistory;
use Illuminate\Http\Request;

class TaskController
{
    public function index(Request $request)
    {
        $search = $request->input("SEARCH");
        $query = Task::query();
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where("title", "like", "%" . $search . "%");
            });
        }

        $users = User::all();
        $tasks = $query->orderBy("created_at", "desc")->with(["creator", "assignee", "status"])->paginate(10)->withQueryString();

        return view("user.tasks", compact("users", "tasks"));
    }

    public function detail(Task $task)
    {
        return view("user.task_detail", compact("task"));
    }

    public function start(Task $task)
    {
        $task->update(["status_id" => 2]);
        TaskHistory::create([
            "task_id" => $task->id,
            "changed_by" => auth()->id(),
            "old_value" => "Status Pending",
            "new_value" => "Status In Progress",
        ]);

        return redirect()->route("tasks.detail", $task);
    }

    public function pause(Task $task)
    {
        $task->update(["status_id" => 1]);
        TaskHistory::create([
            "task_id" => $task->id,
            "changed_by" => auth()->id(),
            "old_value" => "Status In Progress",
            "new_value" => "Status Pending",
        ]);

        return redirect()->route("tasks.detail", $task);
    }

    public function finish(Task $task)
    {
        $task->update(["status_id" => 3]);
        TaskHistory::create([
            "task_id" => $task->id,
            "changed_by" => auth()->id(),
            "old_value" => "Status In Progress",
            "new_value" => "Status Completed",
        ]);

        return redirect()->route("tasks.detail", $task);
    }

    public function approve(Task $task)
    {
        if ($task->deadline->isPast()) {
            $task->update(["status_id" => 5]);
            TaskHistory::create([
                "task_id" => $task->id,
                "changed_by" => auth()->id(),
                "old_value" => "Status Completed",
                "new_value" => "Status Approved Late",
            ]);

            return redirect()->route("tasks.detail", $task);
        }

        $task->update(["status_id" => 4]);
        TaskHistory::create([
            "task_id" => $task->id,
            "changed_by" => auth()->id(),
            "old_value" => "Status Completed",
            "new_value" => "Status Approved",
        ]);

        return redirect()->route("tasks.detail", $task);
    }

    public function reject(Task $task)
    {
        $task->update(["status_id" => 2]);

        return redirect()->route("tasks.detail", $task);
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

        TaskHistory::create([
            "task_id" => $task->id,
            "changed_by" => auth()->id(),
            "old_value" => null,
            "new_value" => "New Task Created",
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

        $original = $task->only([
            "title",
            "description",
            "deadline",
            "assignee_id",
        ]);

        $task->update([
            "title" => $data["TITLE"],
            "description" => $data["DESCRIPTION"] ?? null,
            "deadline" => $data["DEADLINE"],
            "assignee_id" => $data["ASSIGNEE"],
        ]);

        $changes = $task->getChanges();
        unset($changes["updated_at"]);
        foreach ($changes as $field => $newValue) {
            $oldValue = $original[$field] ?? null;
            if ($field === "deadline") {
                $oldValue = $oldValue ? \Carbon\Carbon::parse($oldValue)->format("d M Y H:i") : null;
                $newValue = $newValue ? \Carbon\Carbon::parse($newValue)->format("d M Y H:i") : null;
            }

            if ($field === "assignee_id") {
                $oldValue = $oldValue ? User::find($oldValue)->name : null;
                $newValue = $newValue ? User::find($newValue)->name : null;
            }

            TaskHistory::create([
                "task_id" => $task->id,
                "changed_by" => auth()->id(),
                "old_value" => ucfirst(str_replace("_", " ", $field)) . ": " . ($oldValue ?? "null"),
                "new_value" => ucfirst(str_replace("_", " ", $field)) . ": " . ($newValue ?? "null"),
            ]);
        }

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
