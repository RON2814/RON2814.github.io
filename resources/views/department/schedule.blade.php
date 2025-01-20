<x-app-layout>
 

    {{-- main contnet  --}}
    <div class="main-content p-4 bg-[#ebe9e9]">
        {{-- edit here below --}}

        <div class="bg-white p-8 rounded-lg shadow mt-2">
            <h2 class="text-2xl font-semibold mb-4 border-b border-gray-300">Schedule Creation</h2>

            <!-- Program, Year, Semester, Section, Student Info -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label for="program" class="text-lg font-medium">Program:</label>
                    <select id="program" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Program</option>
                        <option value="BSCS">BSCS</option>
                        <option value="IT">BSIT</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div>
                    <label for="year" class="text-lg font-medium">Year:</label>
                    <select id="year" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div>
                    <label for="semester" class="text-lg font-medium">Semester:</label>
                    <select id="semester" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Semester</option>
                        <option value="1">1st Semester</option>
                        <option value="2">2nd Semester</option>
                        <option value="mid_year">Mid Year</option>
                    </select>
                </div>
                <div>
                    <label for="section" class="text-lg font-medium">Section:</label>
                    <select id="section" class="mt-1 p-2 w-full border border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Section</option>
                    </select>
                </div>

            </div>
            <div class="mt-6 flex space-x-4">
                <div class="w-1/2">
                    <label for="studentName" class="text-lg font-medium">Student Name:</label>
                    <input type="text" id="studentName" class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        placeholder="Student Name">
                </div>
                <div class="w-1/2">
                    <label for="studentId" class="text-lg font-medium">Student Number:</label>
                    <input type="text" id="studentId" class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                        placeholder="Student ID">
                </div>
            </div>

            <div class="border-b border-gray-300 mt-5"></div>
            <div class="overflow-x-auto mt-2 rounded-md ">
                <table class="w-full table-auto border-collapse border border-gray-300 ">
                    <thead class="">
                        <tr class="bg-[#0A6847] text-white">
                            <th class="p-2">Start Time</th>
                            <th class="p-2">End Time</th>
                            <th class="p-2">Day</th>
                            <th class="p-2">Course Code</th>
                            <th class="p-2">Instructor</th>
                            <th class="p-2">Room</th>
                            <th class="p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="scheduleTableBody">
                        <tr>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="day" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Day">
                            </td>

                            <td class="p-2 border">
                                <input type="course_code" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Code">
                            </td>
                            <td class="p-2 border">
                                <input type="instructor" class="w-full p-1 border border-gray-300"
                                    placeholder="Instructor">
                            </td>
                            <td class="p-2 border">
                                <input type="room" class="w-full p-1 border border-gray-300" placeholder="Room">
                            </td>
                            <td class="p-2 border text-center flex space-x-2">
                                <button class="text-lg text-accent" onclick="addRow(event)">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button class="text-lg text-red-500" onclick="deleteRow(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="day" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Day">
                            </td>

                            <td class="p-2 border">
                                <input type="course_code" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Code">
                            </td>
                            <td class="p-2 border">
                                <input type="instructor" class="w-full p-1 border border-gray-300"
                                    placeholder="Instructor">
                            </td>
                            <td class="p-2 border">
                                <input type="room" class="w-full p-1 border border-gray-300" placeholder="Room">
                            </td>
                            <td class="p-2 border text-center flex space-x-2">
                                <button class="text-lg text-accent" onclick="addRow(event)">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button class="text-lg text-red-500" onclick="deleteRow(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="day" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Day">
                            </td>

                            <td class="p-2 border">
                                <input type="course_code" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Code">
                            </td>
                            <td class="p-2 border">
                                <input type="instructor" class="w-full p-1 border border-gray-300"
                                    placeholder="Instructor">
                            </td>
                            <td class="p-2 border">
                                <input type="room" class="w-full p-1 border border-gray-300" placeholder="Room">
                            </td>
                            <td class="p-2 border text-center flex space-x-2">
                                <button class="text-lg text-accent" onclick="addRow(event)">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button class="text-lg text-red-500" onclick="deleteRow(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="time" class="w-full p-1 border border-gray-300"
                                    placeholder="e.g. 8:00 AM - 10:00 AM">
                            </td>
                            <td class="p-2 border">
                                <input type="day" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Day">
                            </td>

                            <td class="p-2 border">
                                <input type="course_code" class="w-full p-1 border border-gray-300"
                                    placeholder="Course Code">
                            </td>
                            <td class="p-2 border">
                                <input type="instructor" class="w-full p-1 border border-gray-300"
                                    placeholder="Instructor">
                            </td>
                            <td class="p-2 border">
                                <input type="room" class="w-full p-1 border border-gray-300" placeholder="Room">
                            </td>
                            <td class="p-2 border text-center flex space-x-2">
                                <button class="text-lg text-accent" onclick="addRow(event)">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button class="text-lg text-red-500" onclick="deleteRow(event)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>




                    </tbody>
                </table>
            </div>
            <!-- Add Schedule Button -->
            <div class="mt-6 text-center">
                <button class="px-4 py-2 bg-blue-200 text-black font-semibold rounded-md" onclick="addSchedule()">
                    Set Schedule
                </button>
            </div>
        </div>


    </div>


    <script>
        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }

        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Add row to schedule table
        function addRow(event) {
            const table = document.getElementById('scheduleTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td class="p-2 border"><input type="text" class="w-full p-1 border border-gray-300" placeholder="e.g. 8:00 AM - 10:00 AM"></td>
        <td class="p-2 border"><input type="text" class="w-full p-1 border border-gray-300" 
        <td class="p-2 border"><input type="text" class="w-full p-1 border border-gray-300" placeholder="Instructor"></td>
        <td class="p-2 border"><input type="text" class="w-full p-1 border border-gray-300" placeholder="Room"></td>
        <td class="p-2 border text-center space-x-2">
          <button class="text-lg text-[var(--cvsu-yellow)]" onclick="addRow(event)">
            <i class="fas fa-plus"></i>
          </button>
          <button class="text-lg text-blue-500" onclick="editRow(event)">
                  <i class="fas fa-edit"></i> <!-- Edit icon -->
                </button>
          <button class="text-lg text-red-500" onclick="deleteRow(event)">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      `;
            table.appendChild(newRow);
        }

        function editRow(event) {
            const row = event.target.closest('tr');
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = false;
            });
        }

        function deleteRow(event) {
            const row = event.target.closest('tr');
            row.remove();
        }

        function addSchedule() {
            // Logic for saving schedule will go here
            alert('Schedule has been added!');
        }
    </script>
</x-app-layout>
