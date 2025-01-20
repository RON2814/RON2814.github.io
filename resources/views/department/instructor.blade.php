<x-app-layout>

    <div class="main-content p-16 py-0 bg-[#ebe9e9]">
        <div class="bg-white p-10 rounded-lg shadow mt-4 shadow-xl">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold text-gray-900  border-b border-gray-200 ">List of Instructors</h3>
                <!-- Search Section -->
                <div class="flex space-x-4">
                    <!-- Search Bar -->
                    <form method="GET" action="{{ route('department.instructor') }}" class="flex items-center space-x-4">
                        <div class="relative mt-1">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search" name="search" value="{{ $search ?? '' }}"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search for Instructor name" oninput="this.form.submit()">
                        </div>
                    </form>


                    <!-- Add New Course Button -->
                    <button onclick="openModal()"
                        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        + Add Instructor
                    </button>



                </div>
            </div>

            <div class="overflow-x-auto rounded-lg mt-4 ">
                <table class="min-w-full table-auto border-collapse border-spacing-0">
                    <thead class="bg-[#0A6847] text-white text-xs">
                        <tr>
                            <th class=" py-3 px-4 text-left font-medium">Instructor ID</th>
                            <th class="py-3 px-4 text-left font-medium">Instructor Name</th>
                            <th class="py-3 px-4 text-left font-medium">Email Address</th>
                            {{-- <th class="border border-gray-200 py-3 px-4 text-left font-medium">Status</th> --}}
                            <th class="py-3 px-4 text-left font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody id="instructor-table-body" class="text-gray-700 border border-gray-200">
                        @foreach ($instructors as $instructor)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="py-4 px-4 text-sm truncate max-w-xs border-b ">{{ $instructor->id }}</td>
                                <td class="py-4 px-4 text-sm truncate max-w-xs border-b ">
                                    {{ $instructor->last_name }}, {{ $instructor->first_name }}
                                    {{ $instructor->middle_name }}
                                </td>
                                <td class="py-4 px-4 text-sm truncate max-w-xs border-b ">{{ $instructor->email }}</td>
                                {{-- <td class="py-4 px-4 text-sm truncate max-w-xs font-medium text-green-900">Active
                                </td> --}}
                                <td class="py-4 px-4 text-sm truncate max-w-xs font-medium text-green-900 border-b ">
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="openEditModal({{ $instructor->id }}, 
                                        '{{ $instructor->last_name }}', 
                                        '{{ $instructor->first_name }}', 
                                        '{{ $instructor->middle_name }}', 
                                        '{{ $instructor->email }}')">
                                        View
                                        <i class="fas fa-edit ml-2"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $instructors->appends(['search' => $search])->links('pagination::tailwind') }}
            </div>

        </div>

        <!-- Modal -->
        @include('modals.instructor.add-instructor')
        @include('modals.instructor.update-instructor')



    </div>

    <script>
        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }

        function openModal() {
            document.getElementById('addInstructorModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addInstructorModal').classList.add('hidden');
        }

        // Live Search Function
        function filterTable() {
            const searchInput = document.getElementById('table-search').value.toLowerCase();
            const tableRows = document.querySelectorAll('#instructor-table-body tr');

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowContent = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = rowContent.includes(searchInput) ? '' : 'none';
            });
        }


        // Open Edit Modal and populate fields with instructor data
        function openEditModal(id, last_name, first_name, middle_name, email) {
            document.getElementById('updateInstructorModal').classList.remove('hidden');
            populateField('last_name', last_name);
            populateField('first_name', first_name);
            populateField('middle_name', middle_name);
            populateField('email', email);

            const formAction = `/department/instructor/update-instructor/${id}`;
            document.getElementById('updateForms').action = formAction;
        }

        // Function to populate fields and handle focus/typing behavior
        function populateField(fieldId, value) {
            const input = document.getElementById(fieldId);
            input.value = value || 'N/A';

            // Set initial style based on whether the value is 'N/A'
            if (input.value === 'N/A') {
                input.classList.add('text-gray-500');
                input.classList.remove('text-normal');
            } else {
                input.classList.add('text-normal');
                input.classList.remove('text-gray-500');
            }

            // Clear 'N/A' and change text color on focus
            input.addEventListener('focus', function() {
                if (this.value === 'N/A') {
                    this.value = '';
                    this.classList.remove('text-gray-500');
                    this.classList.add('text-normal');
                }
            });

            // Restore 'N/A' if field is empty on blur and apply styles
            input.addEventListener('blur', function() {
                if (this.value.trim() === '') {
                    this.value = 'N/A';
                    this.classList.add('text-gray-500');
                    this.classList.remove('text-normal');
                }
            });

            // Change text color back to normal when typing
            input.addEventListener('input', function() {
                if (this.value !== 'N/A') {
                    this.classList.add('text-normal');
                    this.classList.remove('text-gray-500');
                }
            });
        }



        function closeUpdateModal() {
            document.getElementById('updateInstructorModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
