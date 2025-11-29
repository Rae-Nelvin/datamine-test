@extends('layout')

@section('content')
    <div class="flex h-screen">
        <input type="checkbox" id="sidebar-toggle" class="peer hidden" />
        <aside class="fixed inset-y-0 left-0 z-40 w-64 md:w-72 lg:w-80 bg-gray-100 flex flex-col justify-between border-r border-gray-200 shadow-lg transform -translate-x-full peer-checked:translate-x-0 transition-transform
            duration-300 ease-in-out md:relative md:translate-x-0">
            <div class="flex flex-col gap-6 lg:gap-12 p-4 lg:p-8">
                <div class="text-center flex flex-col gap-2 lg:gap-4">
                    <h1 class="text-cyan-500 font-bold text-2xl lg:text-4xl">DATAMINE</h1>
                    <h2 class="text-sm lg:text-lg font-semibold text-gray-600">Tasks Management System</h2>
                </div>

                <ul class="gap-3 lg:gap-6 flex flex-col">
                    <a href="{{ route('dashboard') }}" class="p-3 lg:p-4 rounded-xl text-base lg:text-xl font-medium hover:bg-black hover:text-white transition-colors duration-300 ease-in-out hover:cursor-pointer
                        {{ request()->routeIs('dashboard') ? 'bg-black text-white' : 'bg-gray-200 border border-gray-300 shadow-sm' }}">
                        Dashboard
                    </a>
                    <a href="" class="p-3 lg:p-4 rounded-xl text-base lg:text-xl font-medium hover:bg-black hover:text-white transition-colors duration-300 ease-in-out hover:cursor-pointer
                        {{ request()->routeIs('notifications') ? 'bg-black text-white' : 'bg-gray-200 border border-gray-300 shadow-sm' }}">
                        Notifications
                    </a>
                    <a href="" class="p-3 lg:p-4 rounded-xl text-base lg:text-xl font-medium hover:bg-black hover:text-white transition-colors duration-300 ease-in-out hover:cursor-pointer
                        {{ request()->routeIs('tasks') ? 'bg-black text-white' : 'bg-gray-200 border border-gray-300 shadow-sm' }}">
                        Tasks
                    </a>
                </ul>
            </div>

            <form method="POST" action="" class="p-4 lg:p-8">
                @csrf
                <button class="w-full bg-red-400 py-2 lg:py-3 lg:text-2xl rounded-lg text-white font-semibold uppercase hover:cursor-pointer hover:bg-red-600 focus:ring-2 focus:ring-red-800 transition-colors duration-300 ease-in-out">
                    Logout
                </button>
            </form>
        </aside>

        <div class="flex-1 flex flex-col justify-between">
            <label for="sidebar-toggle" class="md:hidden fixed top-4 left-4 z-50 p-2 rounded bg-black text-white cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </label>

            <main class="p-4 lg:p-7 pt-16 md:pt-4">
                @yield("main")
            </main>

            <footer class="bg-gray-100 text-center py-3 lg:py-4 text-sm lg:text-base text-gray-600 border-t border-gray-200">
                &copy; 2025 <strong>DATAMINE</strong>. All rights reserved.
            </footer>
        </div>
    </div>
@endsection
