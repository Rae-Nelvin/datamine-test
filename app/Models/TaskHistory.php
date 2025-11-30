<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{

    protected $fillable = [
        "task_id",
        "changed_by",
        "old_value",
        "new_value",
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, "task_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "changed_by");
    }
}
