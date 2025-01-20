<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/assets/cvsulogo.png') }}">
    

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body .main {
            background: #ebe9e9;
        }

        /* Wrapper for Sidebar and Main Content */
        .layout-wrapper {
            display: flex;
            flex-wrap: wrap;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            /* background: white; */
            border-right: 1px solid #e0e0e0;
            width: 15%;
            height: 100%;
            display: block;
        }


        /* Main Content */
        .main-content {
            flex: 1;
            background: #ebe9e9;
        }

        /* Mobile view adjustments */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                display: none;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }

            .sidebar.active {
                display: block;
                /* Show sidebar when active class is added */
            }

            .main-content {
                padding: 10px;
            }

            .layout-wrapper {
                flex-direction: column;
            }

            /* Header Layout for mobile */
            .header-wrapper {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            /* Burger Icon */
            .burger-icon {
                display: block;
                cursor: pointer;
                font-size: 24px;
            }

            .burger-icon.open {
                transform: rotate(90deg);
            }
        }

        /* For larger screens, burger icon is hidden */
        @media screen and (min-width: 769px) {
            .burger-icon {
                display: none;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 h-screen">
            @if (auth()->check())
                @switch(auth()->user()->role->id)
                    @case(1)
                        <!-- Student -->
                        @include('student.student-navbar')
                    @break

                    @case(2)
                        <!-- Department -->
                        @include('department.department-navbar')
                    @break

                    @case(3)
                        <!-- Registrar -->
                        @include('registrar.registrar-navbar')
                    @break

                    @case(4)
                        <!-- Admin -->
                        @include('admin.admin-navbar')
                    @break

                    @default
                        <p>Role not recognized: {{ auth()->user()->role->id }}</p>
                @endswitch
            @else
                <p>User not authenticated</p>
            @endif
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header-wrapper flex justify-between items-center flex-wrap bg-white p-4 py-3">
                <!-- Burger Icon for Mobile -->
                <div class="burger-icon" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </div>

                <div class="header-title pl-3 font-semibold text-[#206A5D]">
                    <h2>{{ $pageTitle ?? 'Welcome, ' . Auth::user()->name }}</h2>
                </div>

                <div class="user-info flex items-center gap-2">
                    <div class="dropdown relative inline-block">
                        <button
                            class="dropdown-button bg-white text-[#333] border border-[#ccc] py-2 px-4 text-sm font-medium rounded-lg flex items-center cursor-pointer"
                            onclick="toggleDropdown()">
                            <span id="username">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </button>

                        <div
                            class="dropdown-content absolute hidden bg-white min-w-[160px] shadow-lg z-10 top-full right-0 rounded-xl py-2">
                            <a href="{{ route('profile.edit') }}"
                                class="block py-3 px-4 text-sm text-[#333] hover:bg-[#f1f1f1]">Profile</a>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 px-4 text-sm text-[#333] bg-transparent border-0 text-left hover:bg-[#f1f1f1]">Log
                                    Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        // Toggle sidebar visibility on mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');

            // Optional: Add class for animating burger icon
            const burgerIcon = document.querySelector('.burger-icon');
            burgerIcon.classList.toggle('open');
        }

        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }
    </script>
</body>

</html>
