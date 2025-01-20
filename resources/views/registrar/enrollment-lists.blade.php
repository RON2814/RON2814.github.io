<x-app-layout>

    {{-- main-content --}}
    <div class="main-content p-10 py-0 bg-[#ebe9e9]">

        <div class="p-4 rounded-lg shadow mt-3 flex items-center justify-between bg-white">
            <h3 class="text-base font-medium text-black-700">Filter By:</h3>

            <div class="flex space-x-6">
                <select id="yearLevelFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-48 text-sm">
                    <option value="all" class="text-gray-600">Year Level</option>
                    <option value="all">All</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>

                <select id="programFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-48 text-sm">
                    <option value="all" class="text-gray-600">Program</option>
                    <option value="all">All</option>
                    <option value="1">Computer Science</option>
                    <option value="2">Information Technology</option>
                </select>

                <select id="enrollmentStatusFilter"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-48 text-sm">
                    <option value="all" class="text-gray-600">Enrollment Status</option>
                    <option value="all">All</option>
                    <option value="enrolled">Enrolled</option>
                    <option value="pending">Pending</option>
                    <option value="under evaluation">Under Evaluation</option>
                </select>
            </div>
        </div>


        <div class="bg-white mt-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8 py-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-semibold text-gray-900 border-b borderpgray-300">Enrollment List</h3>

                <!-- Search and Filter Section -->
                <div class="flex space-x-4">
                    <!-- Search Bar -->
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="searchBar"
                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search student number / name" />
                    </div>

                    <button onclick="openAddStudentModal()"
                        class="px-4 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm">
                        + Enroll New Student
                    </button>

                    <!-- Section Capacity Button -->
                    <button onclick="openSectionModal()"
                        class="px-4 py-3 bg-indigo-600 text-white font-semibold rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm">
                        Set Section Capacity
                    </button>

                </div>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full table-auto border-separate border-spacing-0">
                    <thead class="bg-[#0A6847] text-white text-sm">
                        <tr>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Student #</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 33.33%;">Student Name</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Program</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Year Level</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Section</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Classification</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Status</th>
                            <th class="py-3 px-4 text-left font-medium" style="width: 16.66%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody" class="text-gray-700">
                        {{-- Student rows will be inserted here JS will do the job :) --}}
                        @foreach ($students as $student)
                            <tr>
                                <td class="py-3 px-4 font-medium border-b" style="white-space: nowrap;">
                                    {{ $student->student_number }}</td>
                                <td class="py-3 px-4 text-sm border-b"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name }}
                                </td>
                                <td class="py-3 px-4 text-sm border-b" style="white-space: nowrap;">
                                    {{ $student->program->title }}</td>
                                <td class="py-3 px-4 text-sm border-b" style="white-space: nowrap;">
                                    {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->year_level : 'No Enrollment' }}
                                </td>
                                <td class="py-3 px-4 text-sm border-b" style="white-space: nowrap;">{Section}</td>
                                <td class="py-3 px-4 text-sm border-b" style="white-space: nowrap;">
                                    {{ $student->classification }}</td>
                                <td class="py-3 px-4 text-sm border-b" style="white-space: nowrap;">
                                    <span class="capitalize"
                                        style="color: {{ $student->enrollment()->latest()->first()
                                            ? ($student->enrollment()->latest()->first()->status == 'enrolled'
                                                ? 'blue'
                                                : ($student->enrollment()->latest()->first()->status == 'under evaluation'
                                                    ? 'yellow'
                                                    : ($student->enrollment()->latest()->first()->status == 'evaluated'
                                                        ? 'blue'
                                                        : ($student->enrollment()->latest()->first()->status == 'pending'
                                                            ? 'red'
                                                            : ($student->enrollment()->latest()->first()->status == 'N/A'
                                                                ? 'gray'
                                                                : ($student->enrollment()->latest()->first()->status == 'completed'
                                                                    ? 'purple'
                                                                    : 'red'))))))
                                            : 'gray' }};">
                                        {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->status : 'No Enrollment' }}
                                    </span>
                                </td>

                                <td class="py-3 px-4 text-center text-sm border-b" style="white-space: nowrap;">
                                    @php
                                        $latestEnrollment = $student->enrollment()->latest()->first();
                                    @endphp

                                    @if ($latestEnrollment && $latestEnrollment->status == 'enrolled')
                                        <!-- Show 'COR' button for enrolled status -->
                                        <button onclick='openCORMOdal({{ $student }})'                                            style="background-color: #34D399; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                                            COR
                                        </button>
                                    @else
                                        <!-- Show 'Enroll' button if not enrolled -->
                                        <button onclick='openEnrollStudentModal({{ $student }})'
                                            style="background-color: #3b82f6; color: white; padding: 0.5rem 1rem; border-radius: 0.375rem;">
                                            Enroll
                                        </button>
                                    @endif
                                </td>



                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Include modals -->
    @include('modals.manage-users.add-student')
    @include('modals.registrar.sectioning')
    @include('modals.registrar.enroll-student')
    @include('modals.registrar.cor')


    <script>
        // Debounce function to limit the rate of AJAX calls
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Function to fetch and display students based on search and filter
        function fetchStudents() {
            const searchQuery = document.getElementById('searchBar').value.trim();
            const programId = document.getElementById('programFilter').value;

            let url = `{{ route('admin.manageUsers.search-student') }}?query=${encodeURIComponent(searchQuery)}`;

            if (programId && programId !== 'all') {
                url += `&program_id=${encodeURIComponent(programId)}`;
            }

            fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new TypeError("Expected JSON, got " + contentType);
                    }

                    return response.json();
                })
                .then(data => {
                    const tbody = document.getElementById('studentTableBody');
                    tbody.innerHTML = ''; // Clear existing table rows

                    if (data.length === 0) {
                        tbody.innerHTML = `
          <tr>
            <td colspan="9" class="py-4 px-4 text-center text-sm text-gray-500">No students found.</td>
          </tr>
        `;
                        return;
                    }

                    data.forEach(student => {
                        const row = document.createElement('tr');
                        row.classList.add('hover:bg-gray-100');

                        const email = student.user?.email || '';
                        const programTitle = student.program?.title || '';

                        row.innerHTML = `
          <td class="py-4 px-4 text-sm">${student.student_number}</td>
          <td class="py-4 px-4 text-sm">${student.last_name}</td>
          <td class="py-4 px-4 text-sm">${student.first_name}</td>
          <td class="py-4 px-4 text-sm">${student.middle_name}</td>
          <td class="py-4 px-4 text-sm">${email}</td>
          <td class="py-4 px-4 text-sm">${programTitle}</td>
          <td class="py-4 px-4 text-sm">${student.classification}</td>
          <td class="py-4 px-4 text-sm">
            <button
              onclick='openUpdateStudentModal(${JSON.stringify(student).replace(/'/g, "\\'")})'
              class="text-blue-500 hover:text-blue-700">
              <i class="fas fa-edit"></i>
            </button>
            <button onclick="deleteStudent('${student.student_number}')"
              class="ml-4 text-red-500 hover:text-red-700">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching students:', error);
                    alert('An error occurred while fetching students.');
                });
        }

        // Event listeners for search and filter
        document.getElementById('searchBar').addEventListener('input', debounce(fetchStudents, 300));
        document.getElementById('programFilter').addEventListener('change', fetchStudents);

        function deleteStudent(studentNumber) {
            Swal.fire({
                title: 'Are you sure?',
                html: `<span style="user-select: none;">Type "${studentNumber}" to confirm deletion.</span>`,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#d33',
                showLoaderOnConfirm: true,
                preConfirm: (input) => {
                    if (input !== studentNumber) {
                        Swal.showValidationMessage(`Input does not match "${studentNumber}".`);
                        return false;
                    }
                    return true;
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('/admin/manage-users/student/destroy') }}/${studentNumber}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                if (response.status === 404) {
                                    throw new Error('Student not found.');
                                }
                                throw new Error('Network response was not ok');
                            }

                            const contentType = response.headers.get('content-type');
                            if (!contentType || !contentType.includes('application/json')) {
                                throw new TypeError("Expected JSON, got " + contentType);
                            }

                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Remove the student's row from the table
                                const row = document.querySelector(
                                    `button[onclick="deleteStudent('${studentNumber}')"]`).closest(
                                    'tr');
                                row.remove();
                                Swal.fire('Deleted!', data.message, 'success');
                            } else {
                                Swal.fire('Error!', 'Failed to delete student.', 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting student:', error);
                            Swal.fire('Error!', error.message ||
                                'An error occurred while deleting the student.', 'error');
                        });
                }
            });
        }

        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            dropdownContent.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
