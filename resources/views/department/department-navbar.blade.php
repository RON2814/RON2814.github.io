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
        </div>
        <hr class="border-t-2 border-[#2c8c6d] mb-6">
    </div>


    <!-- Sidebar Navigation Menu -->
    <ul class="menu relative list-none p-0">
        <!-- Dashboard -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
                @if (request()->routeIs('department.dashboard')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('department.dashboard') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-tachometer-alt text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Dashboard</span>
            </a>
        </li>

          <!-- Advising List -->
          <li
          class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
         @if (request()->routeIs('department.advising')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
          <a href="{{ route('department.advising') }}"
              class="text-white no-underline flex items-center gap-3">
              <i class="fas fa-user text-xs opacity-75 mr-2"></i>
              <span class="text-xs opacity-80">Advising List</span>
          </a>
      </li>

        <!-- Department -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
                @if (request()->routeIs('department.instructor')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('department.instructor') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Instructor List</span>
            </a>
        </li>



        <!-- Courses -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
                @if (request()->routeIs('department.courses')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('department.courses') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Course List</span>
            </a>
        </li>

      

        <!-- Schedule -->
        {{-- <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
                @if (request()->routeIs('department.schedule')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('department.schedule') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Schedule</span>
            </a>
        </li> --}}
    </ul>
</aside>
