@extends('user.auth-layout')

@section('main')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 lg:gap-12">
        <div class="md:col-span-3 border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md">
            <h1 class="font-bold text-2xl sm:text-3xl: md:text-4xl lg:text-5xl">Hi {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}!</h1>
            @if (session()->has("weather"))
                <div class="mt-4 md:mt-5 lg:mt-6 gap-1 flex flex-col">
                   <h2 class="font-medium text-lg sm:text-xl md:text-2xl text-gray-700">Current Weather in Jakarta</h2>
                   <h3 class="font-semibold text-xl sm:text-2xl md:text-3xl">{{ number_format(session("weather.main.temp"), 0) }} °C, <span class="text-lg sm:text-xl md:text-2xl text-gray-600">{{ session("weather.weather.0.main") }}</span></h3>
                   <h4 class="text-base sm:text-lg md:text-xl text-gray-500">{{ ucfirst(session("weather.weather.0.description")) }}</h4>
                </div>
            @endif
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md flex flex-col gap-6 md:gap-10 lg:gap-20">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-9xl font-bold">{{ $ongoingTasks }}</h1>
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-semibold">Ongoing Tasks This Month</h2>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md flex flex-col gap-6 md:gap-10 lg:gap-20">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-9xl font-bold">{{ $completedTasks }}</h1>
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-semibold">Completed Tasks This Month</h2>
        </div>

        <div class="border border-gray-300 rounded-lg p-4 md:p-5 lg:p-6 shadow-md flex flex-col gap-6 md:gap-10 lg:gap-20">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-9xl font-bold">{{ $overdueTasks }}</h1>
            <h2 class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-semibold">Overdue Tasks This Month</h2>
        </div>
    </div>
@endsection
