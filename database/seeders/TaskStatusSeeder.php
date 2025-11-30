<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaskStatus::create([
            "name" => "Pending",
        ]);

        TaskStatus::create([
            "name" => "In Progress",
        ]);

        TaskStatus::create([
            "name" => "Waiting for Approval",
        ]);

        TaskStatus::create([
            "name" => "Completed",
        ]);

        TaskStatus::create([
            "name" => "Completed Overdue",
        ]);
    }
}
