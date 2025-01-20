<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CvSU-B Enrollment System</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/cvsulogo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center h-screen relative"
    style="background-image: linear-gradient(rgba(121, 235, 121, 0.8), rgba(115, 204, 115, 0.7)), url('{{ Vite::asset('resources/assets/cvsu-bg.jpg') }}'); background-size: cover; background-position: center;">

    <div class="text-center w-[80vw] md:w-[55vw]">
        {{-- <div class="flex items-center justify-center mb-8">
            <img src="{{ Vite::asset('resources/assets/cvsulogo.png') }}" alt="University Logo" class="w-20 mr-4">
            <div>
                <h1 class="text-2xl font-semibold text-green-700">Cavite State University</h1>
                <h2 class="text-lg font-medium text-green-800">Bacoor Campus</h2>
            </div>
        </div> --}}



        <div class="flex flex-col lg:flex-row justify-between bg-white rounded-3xl shadow-lg overflow-hidden">

            <div class="lg:w-[55%] p-10">
                <div class="flex items-center justify-center mb-12">
                    <img src="{{ Vite::asset('resources/assets/cvsulogo.png') }}" alt="University Logo"
                        class="w-12 mr-2">
                    <div>
                        <h1 class="text-xl font-semibold text-green-700">Cavite State University</h1>
                        <h2 class="text-sm font-medium text-green-800">Bacoor Campus</h2>
                    </div>
                    <div class="border-b border-gray-300"></div>

                </div>
                <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
                    @csrf
                    <!-- Email Address -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-gray-700 text-left mb-2">Student ID
                            / Email</label>
                        <input id="login" type="text" name="login" value="{{ old('login') }}" required
                            autofocus autocomplete="username" placeholder="Enter your login credential"
                            class="p-3 border border-gray-300 rounded-md text-base focus:outline-none focus:ring-2 focus:ring-green-500 w-full">
                        @error('login')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 text-left mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            class="p-3 border border-gray-300 rounded-md text-base focus:outline-none focus:ring-2 focus:ring-green-500 w-full">
                        @error('password')
                            <span class="text-sm text-red-500 mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                        </div>

                        <!-- Forgot Password -->
                        <a href="{{ route('password.request') }}" class="text-sm text-green-700 hover:underline">
                            Forgot Your Password?
                        </a>
                    </div>

                    <button type="submit"
                        class="bg-green-700 text-white py-3 rounded-md text-base hover:bg-green-800 mt-8 mb-8">Log
                        In</button>
                </form>
            </div>

            <div class="md:w-[50%] hidden lg:flex items-center justify-center bg-gray-100">
                <img src="{{ Vite::asset('resources/assets/stingrays.png') }}" alt="University Logo"
                    class="w-full h-full object-cover rounded-lg">
            </div>
        </div>
    </div>
</body>

</html>
