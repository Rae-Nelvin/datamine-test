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
}
