@extends('layout')

@section('content')
    @if (session("weather"))
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold text-2xl">Weather Info:</strong>
            <span class="block mt-2">{{ session("weather.main.temp") }} C</span>
            <span class="block mt-2">{{ session("weather.weather.0.description") }}</span>
        </div>
    @endif
    Hello World. Welcome to Dashboard Page
@endsection
