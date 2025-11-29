@extends('user.auth-layout')

@section('main')
    <div class="grid grid-cols-3 gap-12">
        <div class="col-span-3">
            <h1>Hi {{ Auth::user()->FIRST_NAME }}</h1>
            <h2>Current Weather in Jakarta</h2>
            <h3>{{ session("weather.main.temp") }}</h3>
            <h3>{{ ucfirst(session("weather.0.description")) }}</h3>
        </div>
    </div>
@endsection
