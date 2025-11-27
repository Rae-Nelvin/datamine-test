<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

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

        return view("user.dashboard");
    }
}
