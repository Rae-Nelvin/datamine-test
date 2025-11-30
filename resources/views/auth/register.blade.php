@extends('layout')

@section('content')
    <div class="w-full min-h-screen flex flex-col items-center justify-center px-4 md:px-0">
        <h1 class="font-bold text-center text-3xl md:text-4xl lg:text-5xl">DATAMINE Tasks Management System</h1>

        <form method="POST" action="{{ route('register.attempt') }}" class="w-full max-w-sm md:max-w-md lg:max-w-xl flex flex-col rounded-xl shadow-lg border mt-12 md:mt-16 lg:mt-20 p-6 md:p-8 gap-2 md:gap-8 lg:gap-10">
            @csrf
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 md:px-4 md:py-3 rounded relative text-sm md:text-base" role="alert">
                    <strong class="font-bold md:text-xl">Error!</strong>
                    <ul class="mt-1 md:mt-2 list-disc list-inside text-xs md:text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="FIRST_NAME" class="text-base md:text-lg lg:text-xl font-semibold">First Name <span class="text-red-600">*</span></label>
                    <input type="text" name="FIRST_NAME" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Input Your First Name" required/>
                </div>
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="LAST_NAME" class="text-base md:text-lg lg:text-xl font-semibold">Last Name</label>
                    <input type="text" name="LAST_NAME" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Input Your Last Name"/>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="EMAIL" class="text-base md:text-lg lg:text-xl font-semibold">Email <span class="text-red-600">*</span></label>
                    <input type="email" name="EMAIL" id="EMAIL" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Input Your Email" required/>
                    <span id="EMAIL_ERROR" class="text-red-600 text-xs md:text-sm hidden"></span>
                </div>
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="PHONE" class="text-base md:text-lg lg:text-xl font-semibold">Phone Number</label>
                    <input type="tel" name="PHONE" id="PHONE" class="p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Input Your Phone Number (Ex: 628)"/>
                    <span id="PHONE_ERROR" class="text-red-600 text-xs md:text-sm hidden"></span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4">
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="PASSWORD" class="text-base md:text-lg lg:text-xl font-semibold">Password <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <input type="password" name="PASSWORD" id="PASSWORD" class="w-full p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Input Your Password" required/>
                        <button type="button" tabindex="-1" onclick="togglePassword('PASSWORD', this)" class="absolute inset-y-0 right-3 flex items-center text-gray-5500 hover:text-gray-800 hover:cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <span id="PASSWORD_ERROR" class="text-red-600 text-xs md:text-sm hidden"></span>
                </div>
                <div class="flex flex-col gap-1 md:gap-2">
                    <label htmlFor="PASSWORD_CONFIRMATION" class="text-base md:text-lg lg:text-xl font-semibold">Password Confirmation <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <input type="password" name="PASSWORD_CONFIRMATION" id="PASSWORD_CONFIRMATION" class="w-full p-2 md:p-3 lg:p-1 rounded-md border focus:border-blue-500 focus:outline-blue-400 focus:outline-2" placeholder="Please Re-type Your Password" required/>
                        <button type="button" tabindex="-1" onclick="togglePassword('PASSWORD_CONFIRMATION', this)" class="absolute inset-y-0 right-3 flex items-center text-gray-5500 hover:text-gray-800 hover:cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    <span id="PASSWORD_CONFIRMATION_ERROR" class="text-red-600 text-xs md:text-sm hidden"></span>
                </div>
            </div>

            <div class="flex flex-col gap-3 md:gap-4 mt-12 md:mt-0">
                <button type="submit" id="submitButton" class="bg-black text-white rounded-lg font-semibold text-lg md:text-xl lg:text-2xl py-2 md:py-3 hover:cursor-pointer hover:bg-black/80 transition-color duration-300
                    ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed focus:ring-2 focus:ring-gray-400">Register Now</button>
                <h5 class="text-center text-sm md:text-base lg:text-lg">Already Have an Account? <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:text-blue-800 hover:cursor-pointer transition-color
                    duration-300 ease-in-out">Log In</a></h5>
            </div>
        </form>
    </div>

    <script>
        const form = document.querySelector("form");
        const submit = document.getElementById("submitButton");
        form.addEventListener("submit", () => {
            form.querySelectorAll("input:not([type=hidden]), button, a").forEach(element => element.readonly = true);
            submit.textContent = "Processing...";
        });

        function showError(elementId, message, show) {
            const error = document.getElementById(elementId+"_ERROR");
            if (show) {
                error.textContent = message;
                error.classList.remove("hidden");
            } else {
                error.classList.add("hidden");
            }

            toggleSubmit();
        }

        const rules = {
            email: validate => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(validate),
            phone: validate => validate === "" || (/^\d+$/.test(validate) && !/^0/.test(validate)),
            password: validate => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(validate),
            passwordConfirmation: () =>
                document.getElementById("PASSWORD").value === document.getElementById("PASSWORD_CONFIRMATION").value
        };

        ["EMAIL", "PHONE", "PASSWORD", "PASSWORD_CONFIRMATION"].forEach(id => {
            document.getElementById(id).addEventListener("input", () => validateField(id));
        });

        function validateField(id) {
            const value = document.getElementById(id).value.trim();
            switch(id) {
                case "EMAIL":
                    showError(id, "Please Enter a Valid Email Address", !rules.email(value));
                    break;
                case "PHONE":
                    showError(id, "Numbers only, no +, 0, spaces or dashes.", !rules.phone(value));
                    break;
                case "PASSWORD":
                    showError(id, "Password Must Be at Least 8 Characters Long and Include Uppercase, Lowercase, and a Number", !rules.password(value));
                    validateField("PASSWORD_CONFIRMATION");
                    break;
                case "PASSWORD_CONFIRMATION":
                    showError(id, "Passwords Do Not Match", !rules.passwordConfirmation());
                    break;
            }
        }

        function toggleSubmit() {
            const ok =
                rules.email(document.getElementById("EMAIL").value.trim()) &&
                rules.phone(document.getElementById("PHONE").value.trim()) &&
                rules.password(document.getElementById("PASSWORD").value.trim()) &&
                rules.passwordConfirmation();
            document.getElementById("submitButton").disabled = !ok;
        }

        function togglePassword(fieldId, button) {
            const input = document.getElementById(fieldId);
            const icon = button.querySelector("svg");
            if (input.type === "password") {
                input.type = "text";
                icon.innterHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                `;
            } else {
                input.type = "password";
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }
    </script>
@endsection
