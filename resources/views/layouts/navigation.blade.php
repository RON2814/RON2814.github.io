<aside
    class="sidebar fixed top-0 left-0 bottom-0 w-55 h-full p-6 bg-[#0A6847] text-white shadow-lg z-50 transition-all duration-300 ease-in-out">
    <!-- Sidebar Header -->
    <div class="sidebar-header mb-6">
        <div class="logo h-[80px] p-4 flex items-center gap-4">
            <img src="{{ Vite::asset('resources/assets/cvsulogo.png') }}" alt="CvSU-B Logo"
                class="h-12 w-12 object-contain">
            <h2 class="text-xl font-medium opacity-80">CvSU-B</h2>
        </div>
        <hr class="border-t-2 border-[#2c8c6d] mb-6">
    </div>

    <!-- Sidebar Navigation Menu -->
    <ul class="menu h-[80%] relative list-none p-0">
        <!-- Dashboard -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
            <a href="{{ route('admin.dashboard') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-tachometer-alt text-lg opacity-75 mr-2"></i>
                <span class="text-sm opacity-80">Dashboard</span>
            </a>
        </li>


        <!-- Manage Users -->
        <li
            class="submenu relative p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
            <a href="#" id="manage-users-toggle" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-users text-lg opacity-75 mr-2"></i>
                <span class="text-sm opacity-80">Manage Users</span>
                <i class="fas fa-chevron-down ml-auto text-sm transition-transform duration-100"></i>
            </a>
            <ul class="submenu-list list-none pl-5">
                <li
                    class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
                    <a href="#" class="text-white no-underline flex items-center gap-3">
                        <i class="fa-solid fa-chevron-right text-sm mr-2"></i>
                        <span class="text-sm opacity-80">Student</span>
                    </a>
                </li>
                <li
                    class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
                    <a href="#" class="text-white no-underline flex items-center gap-3">
                        <i class="fa-solid fa-chevron-right text-sm mr-2"></i>
                        <span class="text-sm opacity-80">Registrar</span>
                    </a>
                </li>
                <li
                    class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
                    <a href="#" class="text-white no-underline flex items-center gap-3">
                        <i class="fa-solid fa-chevron-right text-sm mr-2"></i>
                        <span class="text-sm opacity-80">Department</span>
                    </a>
                </li>
                <li
                    class="submenu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out hover:bg-[#2c8c6d] active:bg-[#4F9A85]">
                    <a href="#" class="text-white no-underline flex items-center gap-3">
                        <i class="fa-solid fa-chevron-right text-sm mr-2"></i>
                        <span class="text-sm opacity-80">Admin</span>
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

    // Highlight active menu item
    const menuItems = document.querySelectorAll('.menu-item, .submenu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            menuItems.forEach(i => i.classList.remove('active'));
            item.classList.add('active');
        });
    });
</script>
