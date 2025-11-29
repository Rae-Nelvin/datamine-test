@extends('user.auth-layout')

@section('main')
    <div class="flex flex-col gap-6 sm:gap-10 md:gap-20">
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 items-stretch sm:items-center">
            <button type="button" id="openModalButton" class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400">+ Add New Tasks</button>

            <form class="flex-grow flex flex-col sm:flex-row gap-3 sm:gap-4">
                @csrf
                <input type="text" name="SEARCH" placeholder="Search Tasks by Name" class="border border-gray-300 focus:outline-2 focus:outline-blue-400 focus:border-blue-500 w-full md:w-1/2 py-2 px-4 rounded-md"/>
                <button type="submit" class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl px-8 py-2 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400">Search</button>
            </form>
        </div>

        @if ($tasks->isEmpty())
            <h3 class="text-center text-gray-600 mt-10 text-lg">No Tasks Found.</h3>
        @else

            <div class="hidden md:block overflow-x-auto border border-gray-300 shadow-sm rounded-md">
                <table class="min-w-full">
                    <thead class="bg-gray-100 text-gray-700 uppercase tracking-wide">
                        <tr>
                            <th class="p-4 text-center border-r border-gray-300">Title</th>
                            <th class="p-4 text-center border-r border-gray-300">Status</th>
                            <th class="p-4 text-center border-r border-gray-300">Deadline</th>
                            <th class="p-4 text-center border-r border-gray-300">Assignee</th>
                            <th class="p-4 text-center border-r border-gray-300">Created By</th>
                            <th class="p-4 text-center border-r border-gray-300">Created At</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="border-t border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 border-r border-gray-300 hover:cursor-pointer font-semibold text-blue-600 hover:underline">{{ $task->title }}</td>
                                @if ($task->status->name === "In Progress")
                                    <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-yellow-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span></td>
                                @elseif ($task->deadline->isPast())
                                    <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-red-200 rounded-full px-4 font-medium">Overdue</span></td>
                                @elseif ($task->status->name === "Completed")
                                    <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-green-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span></td>
                                @else
                                    <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-blue-200 rounded-full px-4 font-medium">{{ $task->status->name }}</span></td>
                                @endif
                                <td class="px-4 py-2 border-r border-gray-300">{{ $task->deadline->format("d M Y H:i") }}</td>
                                <td class="px-4 py-2 border-r border-gray-300">{{ $task->assignee->first_name . ' ' . $task->assignee->last_name }}</td>
                                <td class="px-4 py-2 border-r border-gray-300">{{ $task->creator->first_name . ' ' . $task->creator->last_name }}</td>
                                <td class="px-4 py-2 border-r border-gray-300">{{ $task->created_at->format("d M Y H:i") }}</td>
                                @if ($task->creator->id === auth()->id())
                                    <td class="flex flex-row gap-4 justify-center py-2">
                                        <button
                                            data-id="{{ $task->id }}"
                                            data-title="{{ $task->title }}"
                                            data-description="{{ $task->description }}"
                                            data-deadline="{{ $task->deadline->format('Y-m-d\TH:i') }}"
                                            data-assignee="{{ $task->assignee_id }}"
                                            class="edit-btn bg-yellow-500 text-white rounded-lg font-semibold text-lg px-8 py-1 hover:cursor-pointer hover:bg-yellow-400 transition-color duration-300
                    ease-in-out focus:ring-2 focus:ring-yellow-600">Edit</button>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Delete this task?');">
                                            @csrf @method("DELETE")
                                            <button type="submit" class="bg-red-500 text-white rounded-lg font-semibold text-lg px-8 py-1 hover:cursor-pointer hover:bg-red-400 transition-color duration-300
                    ease-in-out focus:ring-2 focus:ring-red-600">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="md:hidden space-y-4">
                @foreach ($tasks as $task)
                    <div class="border border-gray-300 rounded-lg p-4 bg-white shadow-sm">
                        <div class="flex justify-between items-start mb-2">
                            <span class="font-semibold text-base">{{ $task->title }}</span>
                            @if ($task->status->name === "In Progress")
                                <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-yellow-200 rounded-full px-4">{{ $task->status->name }}</span></td>
                            @elseif ($task->deadline->isPast())
                                <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-red-200 rounded-full px-4">Overdue</span></td>
                            @elseif ($task->status->name === "Completed")
                                <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-green-200 rounded-full px-4">{{ $task->status->name }}</span></td>
                            @else
                                <td class="px-4 py-2 border-r border-gray-300 text-center"><span class="bg-blue-200 rounded-full px-4">{{ $task->status->name }}</span></td>
                            @endif
                        </div>
                        <div class="text-sm text-gray-700 space-y-1">
                            <div>Deadline: <span class="font-medium">{{ $task->deadline }}</span></div>
                            <div>Assignee: <span class="font-medium">{{ $task->assignee->first_name . ' ' . $task->assignee->last_name }}</span></div>
                            <div>Creator: <span class="font-medium">{{ $task->creator->first_name . ' ' . $task->creator->last_name }}</span></div>
                            <div>Created: <span class="font-medium">{{ $task->created_at }}</span></div>
                        </div>
                        @if ($task->creator->id === auth()->id())
                             <div class="mt-3 flex gap-2">
                                <button
                                    data-id="{{ $task->id }}"
                                    data-title="{{ $task->title }}"
                                    data-description="{{ $task->description }}"
                                    data-deadline="{{ $task->deadline->format('Y-m-d\TH:i') }}"
                                    data-assignee="{{ $task->assignee_id }}"
                                    class="edit-btn flex-1 text-center rounded-md px-3 py-2 text-sm font-medium bg-yellow-500 text-white hover:bg-yellow-400 transition-color duration-300 ease-in-out focus:ring-2 focus:ring-yellow-600">Edit</button>
                                <form method="POST" action="{{ route('tasks.destroy', $task ) }}" class="flex-1" onsubmit="return confirm('Delete this task?');">
                                    @csrf @method("DELETE")
                                    <button type="submit" class="w-full rounded-md px-3 py-2 text-sm font-medium bg-red-500 text-white hover:bg-red-400 transition-color duration-300 ease-in-out focus:ring-2 focus:ring-red-600">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="flex flex-row justify-center">
                {{ $tasks->links() }}
            </div>

        @endif
    </div>

    <div id="taskModal" class="fixed inset-0 z-50 items-center justify-center bg-black/50 flex flex-col hidden">
        <div class="bg-white rounded-xl shadow-lg w-11/12 max-w-2xl p-6 md:p-8 flex flex-col gap-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl sm:text-2xl font-bold text-black">Create New Task</h2>
                <button id="closeModalButton" class="text-gray-500 hover:text-black hover:cursor-pointer text-2xl">&times;</button>
            </div>

            <form method="POST" class="flex flex-col gap-4" id="taskForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST" />
                <input type="hidden" name="TASK_ID" id="taskId" value="" />

                <div id="formErrorBanner" class="hidden bg-red-100 border border-red-400 text-red-700 px-3 py-2 md:px-4 md:py-3 rounded relative text-sm md:text-base" role="alert">
                    <strong class="font-bold md:text-xl">Error!</strong>
                    <ul id="formErrorList" class="mt-1 md:mt-2 list-disc list-inside text-xs md:text-sm"></ul>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="TITLE" class="text-base md:text-lg lg:text-xl font-semibold">Task Title <span class="text-red-600">*</span></label>
                    <input type="text" name="TITLE" id="TITLE" placeholder="Please Input the Task Title" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" required />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="DESCRIPTION" class="text-base md:text-lg lg:text-xl font-semibold">Task Description</label>
                    <textarea name="DESCRIPTION" id="DESCRIPTION" placeholder="Task Description" rows="3" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2"></textarea>
                </div>
                <div class="flex flex-col gap-1">
                    <label for="DEADLINE" class="text-base md:text-lg lg:text-xl font-semibold">Task Deadline <span class="text-red-600">*</span></label>
                    <input type="datetime-local" name="DEADLINE" id="DEADLINE" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" required />
                </div>
                <div class="flex flex-col gap-1">
                    <label for="ASSIGNEE" class="text-base md:text-lg lg:text-xl font-semibold">Task Assignee <span class="text-red-600">*</span></label>
                    <select name="ASSIGNEE" id="ASSIGNEE" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2">
                        <option value="">Choose Assignee</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" id="submitModalButton" class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl py-2 md:py-3 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                    ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400"><span id="buttonText">Create Task</span></button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById("taskModal");
        const modalForm = document.getElementById("taskForm");
        const openButton = document.getElementById("openModalButton");
        const closeButton = document.getElementById("closeModalButton");
        const submitButton = document.getElementById("submitModalButton");
        const deadlineInput = document.getElementById("DEADLINE");
        const methodInput = document.getElementById("formMethod");
        const taskId = document.getElementById("taskId");
        const buttonText = document.getElementById("buttonText");

        const now = new Date();
        const today = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 2, 0);
        if (now >= today) today.setDate(today.getDate() + 1);
        const min = today.toISOString().slice(0,16);
        deadlineInput.setAttribute("min", min);
        deadlineInput.value = min;
        deadlineInput.addEventListener("change", function() {
            if (this.value < min) {
                alert("Deadline cannot be earlier than now.");
                this.value = min;
            }
        });

        modalForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            clearErrors();
            lockModal();
            const data = new FormData(modalForm);
            const id = taskId.value;
            const url = id ? `{{ url('tasks') }}/${id}` : "{{ route('tasks.store') }}";
            const method = id ? "PUT" : "POST";

            try {
                const res = await fetch(url, {
                    method: "POST",
                    body: data,
                    headers: {'X-Requested-With': 'XMLHttpRequest'}
                });
                const json = await res.json();

                if (res.ok && json.success) {
                    hide();
                    modalForm.reset();
                    location.reload();
                } else {
                    showErrors(json.errors || {});
                    unlockModal();
                }
            } catch (error) {
                console.error(error);
                unlockModal();
            }
        });

        function showCreate() {
            taskId.value = "";
            methodInput.value = "POST";
            buttonText.textContent = "Create Task";
            modalForm.reset();
            deadlineInput.value = min;
            show();
        }

        function showEdit(task) {
            const data = task.dataset;
            taskId.value = data.id;
            methodInput.value = "PUT";
            buttonText.textContent = "Update Task";
            document.getElementById("TITLE").value = data.title;
            document.getElementById("DESCRIPTION").value = data.description;
            document.getElementById("DEADLINE").value = data.deadline;
            document.getElementById("ASSIGNEE").value = data.assignee;
            show();
        }

        function show() {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function hide() {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }

        function clearErrors() {
            document.getElementById("formErrorBanner").classList.add("hidden");
        }

        function showErrors(errors) {
            const banner = document.getElementById("formErrorBanner");
            const list = document.getElementById("formErrorList");
            list.innerHTML = "";
            for (const messages of Object.values(errors)) {
                messages.forEach(message => list.insertAdjacentHTML("beforeend", `<li>${messages}></li>`));
            }

            banner.classList.remove("hidden");
        }

        function lockModal() {
            modalForm.querySelectorAll("input, textarea, select").forEach(element => element.readOnly = true);
            closeButton.disabled = true;
            submitButton.disabled = true;
            submitButton.textContent = "Processing...";
        }

        function unlockModal() {
            modalForm.querySelectorAll("input, textarea, select").forEach(element => element.readOnly = false);
            closeButton.disabled = false;
            submitButton.disabled = false;
            submitButton.textContent = buttonText.textContent;
        }

        openButton.addEventListener("click", show);
        closeButton.addEventListener("click", hide);

        modal.addEventListener("click", function (event) {
            if (event.target === modal) hide();
        })

        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                showEdit(this);
            });
        });
    });
    </script>
@endsection
