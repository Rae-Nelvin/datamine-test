<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        "title",
        "description",
        "deadline",
        "status_id",
        "creator_id",
        "assignee_id",
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, "creator_id");
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, "assignee_id");
    }

    public function status()
    {
        return $this->hasOne(TaskStatus::class, "id", "status_id");
    }

    protected $casts = [
        "deadline" => "datetime",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];
}
