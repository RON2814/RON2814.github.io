<aside
    class="sidebar fixed top-0 left-0 bottom-0 h-full p-6 bg-[#0A6847] text-white shadow-lg z-50 transition-all duration-300 ease-in-out">
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
    <ul class="menu h-[80%] relative list-none p-0">
        <!-- Dashboard -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
      @if (request()->routeIs('student.dashboard')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.dashboard') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-tachometer-alt text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Dashboard</span>
            </a>
        </li>

        <!-- Student Information -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
      @if (request()->routeIs('student.student-information')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.student-information') }}"
                class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Information</span>
            </a>
        </li>



        <!-- Class Schedule -->
        {{-- <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
      @if (request()->routeIs('student.schedule')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.schedule') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Class Schedule</span>
            </a>
        </li> --}}

        <!-- Student Grades -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
      @if (request()->routeIs('student.student-grades')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.student-grades') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Student Grades</span>
            </a>
        </li>

        <!-- Enrollment Module -->
        <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
            @if (request()->routeIs('student.enrollment') ||
                    request()->routeIs('student.enrollment-eval.cor') ||
                    request()->routeIs('student.enrollment-eval.evaluated-courses')) bg-[#4F9A85]             @else 
                hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.enrollment') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">Enrollment</span>
            </a>
        </li>

        <!-- Enrolled Subjects -->
        {{-- <li
            class="menu-item p-4 my-2 rounded-xl transition-all duration-300 ease-in-out 
      @if (request()->routeIs('student.enrolled-sub')) bg-[#4F9A85] @else hover:bg-[#2c8c6d] @endif">
            <a href="{{ route('student.enrolled-sub') }}" class="text-white no-underline flex items-center gap-3">
                <i class="fas fa-user text-xs opacity-75 mr-2"></i>
                <span class="text-xs opacity-80">COR</span>
            </a>
        </li> --}}
    </ul>

</aside>
