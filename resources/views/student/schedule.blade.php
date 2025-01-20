<x-app-layout>
    <div class="header-wrapper flex justify-between items-center flex-wrap bg-white p-4 py-3">
        <div class="header-title pl-3 font-semibold  text-[#206A5D]">
            <span></span>
            <h2>Class Schedule</h2>
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
    {{-- main content  --}}
    <div class="main-content p-4 bg-[#ebe9e9]">
        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow mt-2">
            <h2 class="font-bold ">Sample Schedule - no fetch</h2>

            <table class="table-auto w-full border-collapse border border-gray-200 mt-3 text-xs">
              <thead>
                <tr>
                  <th class="border border-gray-200 p-4 bg-gray-100">Time</th>
                  <th class="border border-gray-200 p-4 text-left">Mon</th>
                  <th class="border border-gray-200 p-4 text-left">Tues</th>
                  <th class="border border-gray-200 p-4 text-left">Wed</th>
                  <th class="border border-gray-200 p-4 text-left">Thurs</th>
                  <th class="border border-gray-200 p-4 text-left">Fri</th>
                  <th class="border border-gray-200 p-4 text-left">Sat</th>
                </tr>
              </thead>
              <tbody>
                <!-- Time rows -->
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">9am - 10am</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">10am - 11am</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-yellow-100 p-2 border-yellow-300">
                    <p class="font-semibold">GNED 08</p>
                    <p class="text-sm">10 AM - 11 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-yellow-100 p-2 border-yellow-300">
                    <p class="font-semibold">COSC 80</p>
                    <p class="text-sm">10 AM - 11 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-yellow-100 p-2 border-yellow-300">
                    <p class="font-semibold">COSC 80</p>
                    <p class="text-sm">10 AM - 11 PM</p>
                  </td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">11am - 12pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-blue-100 p-2 border-blue-300">
                    <p class="font-semibold">DCIT 25</p>
                    <p class="text-sm">11 AM - 12 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">12pm - 1pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">1pm - 2pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-blue-100 p-2 border-blue-300">
                    <p class="font-semibold">GNED 12</p>
                    <p class="text-sm">1 PM - 2 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-blue-100 p-2 border-blue-300">
                    <p class="font-semibold">COSC 80</p>
                    <p class="text-sm">1 PM - 2 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-blue-100 p-2 border-blue-300">
                    <p class="font-semibold">COSC 80</p>
                    <p class="text-sm">1 PM - 2 PM</p>
                  </td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">2pm - 3pm</td>
                  <td class="border border-gray-200 bg-green-100 p-2 border-green-300">
                    <p class="font-semibold">DCIT 65</p>
                    <p class="text-sm">2 PM - 3 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-green-100 p-2 border-green-300">
                    <p class="font-semibold">COSC 101</p>
                    <p class="text-sm">2 PM - 3 PM</p>
                  </td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">3pm - 4pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">4pm - 5pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200 bg-green-100 p-2 border-green-300">
                    <p class="font-semibold">COSC 101</p>
                    <p class="text-sm">4 PM - 5 PM</p>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">5pm - 6pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
                <tr>
                  <td class="border border-gray-200 text-center p-2 bg-gray-100">6pm - 7pm</td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                  <td class="border border-gray-200"></td>
                </tr>
              </tbody>
            </table>
          </div>
          
          

    </div>
    <script>
        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
