@extends('user.auth-layout')

@section('main')
<div class="max-w-5xl mx-auto px-4 py-6">
    <div class="flex flex-col gap-3 mb-6 md:flex-row md:items-start md:justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl md:text-4xl break-words">
                {{ $task->title }}
            </h1>
            <p class="mt-1 text-md text-gray-500">
                Task ID: #{{ $task->id }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            @if ($task->status->name === "In Progress")
                <span class="bg-yellow-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span>
            @elseif ($task->deadline->isPast() && $task->status->name !== "Completed Overdue")
                <span class="bg-red-200 rounded-full px-4 font-medium">Overdue</span>
            @elseif ($task->status->name === "Completed Overdue")
                <span class="bg-red-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span>
            @elseif ($task->status->name === "Completed")
                <span class="bg-green-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span>
            @else
                <span class="bg-blue-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span>
            @endif

        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3 mb-6">
        <div class="md:col-span-2 flex flex-col gap-4">
            <section class="rounded-xl border border-gray-200 p-4 shadow-sm">
                <h2 class="text-xl font-medium">
                    Description
                </h2>
                <div class="text-md leading-relaxed text-gray-800 break-words py-4">
                    {!! $task->description ? nl2br(e($task->description)) : 'No description provided.' !!}
                </div>
            </section>

            <section class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
                <h2 class="text-xl font-medium">
                    Actions
                </h2>

                <div class="flex flex-wrap gap-2 py-4">
                    @if ($task->status->name === "Pending")
                        <form method="POST" action="{{ route('tasks.start', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400"
                            >
                                Start
                            </button>
                        </form>

                        <form method="POST" action="{{ route('tasks.finish', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-green-500 text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-green-400 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-green-600"
                            >
                                Finish
                            </button>
                        </form>

                    @elseif ($task->status->name === "In Progress")
                        <form method="POST" action="{{ route('tasks.pause', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400"
                            >
                                Pause
                            </button>
                        </form>

                        <form method="POST" action="{{ route('tasks.finish', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-green-500 text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-green-400 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-green-600"
                            >
                                Finish
                            </button>
                        </form>

                    @elseif ($task->status->name === "Waiting for Approval")
                        <form method="POST" action="{{ route('tasks.approve', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-green-500 text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-green-400 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-green-600"
                            >
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('tasks.reject', $task) }}">
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="bg-red-500 text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-red-400 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-red-600"
                            >
                                Reject
                            </button>
                        </form>

                    @endif

                </div>
            </section>
        </div>

        <aside class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
            <h2 class="text-xl font-medium">
                Task Information
            </h2>

            <div class="space-y-3 py-4">
                <div class="gap-2 flex-flex-col">
                    <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        Deadline
                    </h5>
                    <h4 class="text-gray-900">
                        {{ $task->deadline->format('d M Y H:i') }}
                    </h4>
                </div>

                <div class="gap-2 flex flex-col">
                    <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        Assignee
                    </h5>
                    <h4 class="text-gray-900">
                        {{ $task->assignee->first_name . ' ' . $task->assignee->last_name }}
                    </h4>
                </div>

                <div class="gap-2 flex flex-col">
                    <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        Creator
                    </h5>
                    <h4 class="text-gray-900">
                        {{ $task->creator->first_name . ' ' . $task->creator->last_name }}
                    </h4>
                </div>

                <div class="gap-2 flex flex-col">
                    <h5 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        Created Date
                    </h5>
                    <h4 class="text-gray-900">
                        {{ $task->created_at->format('d M Y H:i') }}
                    </h4>
                </div>
            </div>
        </aside>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm flex flex-col">
            <h2 class="text-xl font-medium">
                Comments
            </h2>

            <form method="POST" action="{{ route('tasks.comments.store', $task) }}" class="py-4">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="block text-sm font-semibold uppercase tracking-wide text-gray-600 mb-1">
                        Add Comment
                    </label>
                    <textarea
                        name="COMMENT"
                        required
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:outline-2 focus:outline-blue-400"
                        placeholder="Write your comment here..."
                    >{{ old('comment') }}</textarea>
                </div>

                <button
                    type="submit"
                    class="bg-black text-white rounded-lg font-semibold text-base md:text-lg lg:text-xl px-8 py-2 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400"
                >
                    Post Comment
                </button>
            </form>

            <div class="flex-1 overflow-y-auto max-h-80 border-t border-gray-100 pt-3 space-y-3">
                @forelse ($task->comments as $comment)
                    <article class="border-b border-gray-100 pb-3 last:border-0">
                        <header class="flex items-center justify-between gap-2 mb-1">
                            <div class="text-lg font-semibold text-gray-800">
                                {{ $comment->user->first_name . ' ' . $comment->user->last_name }}
                            </div>
                            <time class="text-md text-gray-500">
                                {{ $comment->created_at->format('d M Y H:i') }}
                            </time>
                        </header>
                        <p class="text-gray-800 break-words">
                            {{ $comment->comment }}
                        </p>
                    </article>
                @empty
                    <p class="text-sm text-gray-500 text-center">
                        No comments yet. Be the first to comment on this task.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm flex flex-col">
            <h2 class="text-xl font-medium text-gray-700 mb-3">
                Task Histories
            </h2>

            <div class="flex-1 overflow-y-auto max-h-96 border-t border-gray-100 pt-3 space-y-3">
                @forelse ($task->histories as $history)
                    <div class="border-b border-gray-100 pb-3 last:border-0 text-sm text-gray-800">
                        <header class="flex items-center justify-between gap-2 mb-1">
                            <div class="text-lg font-semibold text-gray-800">
                                Changed by #{{ $history->user->first_name . ' ' . $history->user->last_name }}
                            </div>
                            <h5 class="text-md text-gray-500">
                                {{ $history->created_at->format('d M Y H:i') }}
                            </h5>
                        </header>
                        <div class="space-y-1 text-sm text-gray-700">
                            <div>
                                <span class="font-semibold">Old:</span>
                                <span class="break-words">{{ $history->old_value }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">New:</span>
                                <span class="break-words">{{ $history->new_value }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center">
                        No history recorded for this task yet.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
