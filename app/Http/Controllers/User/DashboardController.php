<?php

namespace App\Http\Controllers\User;

use App\Models\Task;

class DashboardController
{
    public function index()
    {
        $city = "Jakarta";
        $apiKey = env("OPENWEATHER_API_KEY");
        try {
            $geo = \Http::get("https://api.openweathermap.org/geo/1.0/direct", [
                "q" => $city,
                "limit" => 1,
                "appid" => $apiKey
            ]);

            if ($geo->failed() || empty($geo->json())) {
                throw new \Exception("City not found");
            }

            $lat = $geo->json()[0]["lat"];
            $lon = $geo->json()[0]["lon"];

            $response = \Http::get("https://api.openweathermap.org/data/2.5/weather", [
                "lat" => $lat,
                "lon" => $lon,
                "appid" => $apiKey,
                "units" => "metric"
            ]);

            session(["weather" => $response->json()]);
        } catch (\Exception $e) {
            session(["weather" => null]);
        }

        $ongoingTasks = Task::where("assignee_id", auth()->id())
            ->whereIn("status_id", [1, 2, 3])
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->count();

        $completedTasks = Task::where("assignee_id", auth()->id())
            ->whereIn("status_id", [4, 5])
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->count();

        $overdueTasks = Task::where("assignee_id", auth()->id())
            ->where("deadline", "<", now())
            ->whereMonth("created_at", now()->month)
            ->whereYear("created_at", now()->year)
            ->count();

        return view("user.dashboard", compact("ongoingTasks", "completedTasks", "overdueTasks"));
    }
}
