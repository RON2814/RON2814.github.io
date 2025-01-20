<style>
    .submenu-item:hover,
    .submenu-item.active {
        background-color: #2c8c6d;
    }

    .submenu-item:active {
        background-color: #4F9A85;
    }

    .menu-item:hover,
    .menu-item.active {
        background-color: #2c8c6d;
    }

    .menu-item:active {
        background-color: #4F9A85;
    }
</style>

<aside
    class="sidebar fixed top-0 left-0 bottom-0 w-[15%] h-full p-4 bg-[#0A6847] text-white shadow-lg z-50 transition-all duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="sidebar-header mb-6">
        <div class="logo p-4 flex items-center gap-4">
            <!-- Logo Image -->
            <img src="{{ Vite::asset('resources/assets/cvsulogo.png') }}" alt="CvSU-B Logo"
                class="h-10 w-10 object-contain">
            <!-- Title -->
            <div>
                <h2 class="text-base font-medium opacity-80">CvSU-B</h2>
                {{-- <h2 class="text-sm font-medium opacity-80">Bacoor Campus</h2> --}}
            </div>
            <hr class="border-t-2 border-[#2c8c6d] mb-6">
        </div>

        <!-- Sidebar Navigation Menu -->
        <ul class="menu h-[80%] relative list-none p-0">
            <!-- Dashboard -->
            <li
                class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out @if (request()->routeIs('admin.dashboard')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
                <a href="{{ route('admin.dashboard') }}" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-tachometer-alt text-lg opacity-75 mr-2"></i>
                    <span class="text-sm opacity-80">Dashboard</span>
                </a>
            </li>

            <!-- Manage Users -->
            <li class="submenu relative p-4 my-2 rounded-xl transition-all duration-300 ease-in-out">
                <a href="#" id="manage-users-toggle" class="text-white no-underline flex items-center gap-3">
                    <i class="fas fa-users text-lg opacity-75 mr-2"></i>
                    <span class="text-xs opacity-80">Manage Users</span>
                    <i class="fas fa-chevron-down ml-auto text-xs transition-transform duration-100"></i>
                </a>
                <ul class="submenu-list list-none pl-0 mt-2">
                    <li
                        class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out @if (request()->routeIs('admin.manageUsers.student')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
                        <a href="{{ route('admin.manageUsers.student') }}"
                            class="text-white no-underline flex items-center gap-3">
                            <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                            <span class="text-xs opacity-80">Student</span>
                        </a>
                    </li>

                    <li
                        class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out @if (request()->routeIs('admin.manageUsers.department')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
                        <a href="{{ route('admin.manageUsers.department') }}"
                            class="text-white no-underline flex items-center gap-3">
                            <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                            <span class="text-xs opacity-80">Department</span>
                        </a>
                    </li>

                    <li
                        class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out @if (request()->routeIs('admin.manageUsers.registrar')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
                        <a href="{{ route('admin.manageUsers.registrar') }}"
                            class="text-white no-underline flex items-center gap-3">
                            <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                            <span class="text-xs opacity-80">Registrar</span>
                        </a>
                    </li>

                    <li
                        class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out @if (request()->routeIs('admin.manageUsers.admin')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
                        <a href="{{ route('admin.manageUsers.admin') }}"
                            class="text-white no-underline flex items-center gap-3">
                            <i class="fa-solid fa-chevron-right text-xs mr-2"></i>
                            <span class="text-xs opacity-80">Admin</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
</aside>

<script>
    document.getElementById('manage-users-toggle').addEventListener('click', function() {
        const submenu = this.closest('li').querySelector('.submenu-list');
        submenu.classList.toggle('hidden');
        this.querySelector('i').classList.toggle('rotate-180');
    });
</script>
