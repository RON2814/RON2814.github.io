<x-app-layout>

    {{-- main-content --}}
    <div class="main-content p-10 py-0 bg-[#ebe9e9]">
        <div class="bg-white mt-3 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8 py-5">
            <h2 class="font-medium text-xl border-b mb-4">Student Personal Information:</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2 text-sm">

                <div>
                    <p class="font-medium">Student Number:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->student_number }}</p>
                </div>
                <div>
                    <p class="font-medium">Student Name:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->last_name }}, {{ $student->first_name }}
                        @if ($student->middle_name)
                            {{ $student->middle_name }}
                        @endif
                        @if ($student->extension_name)
                            {{ $student->extension_name }}
                        @endif
                    </p>
                </div>

                <div>
                    <p class="font-medium">Program:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->program->title }}</p>
                </div>
                <div>
                    <p class="font-medium">Major:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->program->major ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="font-medium">Section:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">{Section}</p>
                </div>
                <div>
                    <p class="font-medium">Year Level:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->year_level : 'No Enrollment' }}
                    </p>
                </div>
                <div>
                    <p class="font-medium">Semester:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->semester : 'No Enrollment' }}
                    </p>
                </div>
                <div>
                    <p class="font-medium">Contact Number:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg bg-gray-200 bg-opacity-65">{{ $student->contact_number }}
                    </p>
                </div>
                <div>
                    <p class="font-medium">Birthday:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg bg-gray-200 bg-opacity-65">{{ $student->birthday }}</p>
                </div>
                <div>
                    <p class="font-medium">Sex:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->sex }}
                    </p>
                </div>
                <div class="col-span-2">
                    <p class="font-medium">Address:</p>
                    <p class="mt-1 px-2 py-1 border rounded-lg capitalize bg-gray-200 bg-opacity-65">
                        {{ $student->address->house_number }}, {{ $student->address->street }},
                        {{ $student->address->barangay }}, {{ $student->address->city }},
                        {{ $student->address->province }} {{ $student->address->zip_code }}
                    </p>
                </div>

            </div>




        </div>

        @foreach (['First Year', 'Second Year', 'Third Year', 'Fourth Year'] as $year_level)
            @foreach (['First Semester', 'Second Semester', 'Midyear'] as $semester)
                @php
                    $has_data = false;
                    foreach ($checklist as $item) {
                        if ($item->year == $year_level && $item->semester == $semester) {
                            $has_data = true;
                            break;
                        }
                    }
                @endphp
                @if ($has_data)
                    <div
                        class="bg-white mt-3 mb-4 rounded-lg-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8 py-5">
                        <h2 class="text-xl font-medium border-b border-gray-300 text-gray-800 mb-3 mt-6">
                            {{ $year_level }} - {{ $semester }}
                        </h2>

                        <div class="overflow-x-auto mt-0 rounded-lg-md border">
                            <form
                                action="{{ route('registrar.checklist', ['student_number' => $student->student_number]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <table class="min-w-full table-auto border-collapse border-spacing-0">
                                    <thead class="bg-[#0A6847] text-white text-xs">
                                        <tr>
                                            <th class="py-3 px-4 text-left font-medium">COURSE CODE</th>
                                            <th class="py-3 px-4 text-left font-medium">COURSE TITLE</th>
                                            <th class="py-3 px-4 text-left font-medium">Credit Units</th>
                                            <th class="py-3 px-4 text-left font-medium">Contact Hours</th>
                                            <th class="py-3 px-4 text-left font-medium">Pre-requisites</th>
                                            <th class="py-3 px-4 text-left font-medium">Semester Taken</th>
                                            <th class="py-3 px-4 text-left font-medium">Final Grade</th>
                                            <th class="py-3 px-4 text-left font-medium">Instructor</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-700">
                                        @foreach ($checklist as $item)
                                            @if ($item->year == $year_level && $item->semester == $semester)
                                                <tr class="hover rounded-lg transition-colors duration-200">
                                                    <td class="py-4 px-4 text-sm font-semibold">
                                                        {{ $item->course_code }}</td>
                                                    <td class="py-4 px-4 text-sm">{{ $item->course->course_title }}
                                                    </td>
                                                    <td class="text-center py-4 px-4 text-sm">
                                                        {{ $item->course->credit_unit_lecture + $item->course->credit_unit_laboratory }}
                                                    </td>
                                                    <td class="text-center py-4 px-4 text-sm">
                                                        {{ $item->course->contact_hours_lecture + $item->course->contact_hours_laboratory }}
                                                    </td>
                                                    <td class="py-4 px-4 text-sm max-w-[120px] break-words">
                                                        {{ $item->course->pre_requisite ?: '...' }}
                                                    </td>
                                                    <td class="py-4 px-4 text-sm">
                                                        {{ explode(' ', $item->semester)[0] ?? '' }}</td>

                                                    <!-- Grade Selection -->
                                                    <td class="py-4 px-4 text-sm text-center w-[100px]">
                                                        <input list="gradeOptions"
                                                            name="grades[{{ $item->course_code }}]"
                                                            class="border p-1 rounded-lg w-full"
                                                            value="{{ $item->grade }}">
                                                        <datalist id="gradeOptions">
                                                            @foreach (['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', '4.00', '5.00', 'INC', 'S'] as $grade)
                                                                <option value="{{ $grade }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </td>

                                                    <!-- Instructor Selection -->
                                                    <td class="py-4 px-4 text-sm w-[180px] text-xs">
                                                        <!-- Visible field for instructor's name -->
                                                        <input list="instructorOptions"
                                                            name="instructors[{{ $item->course_code }}]"
                                                            class="border p-1 rounded-lg w-full"
                                                            value="{{ $item->instructor ? $item->instructor->last_name . ', ' . $item->instructor->first_name : '' }}"
                                                            id="instructor-{{ $item->course_code }}">

                                                        <!-- Hidden field for instructor's ID -->
                                                        <input type="hidden"
                                                            name="instructor_ids[{{ $item->course_code }}]"
                                                            id="instructor-id-{{ $item->course_code }}"
                                                            value="{{ $item->instructor_id }}">

                                                        <datalist id="instructorOptions">
                                                            @foreach ($instructors as $instructor)
                                                                <option
                                                                    value="{{ $instructor->last_name }}, {{ $instructor->first_name }}"
                                                                    data-id="{{ $instructor->id }}">
                                                            @endforeach
                                                        </datalist>
                                                    </td>


                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 text-right">
                                    <button type="submit"
                                        class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg hover:bg-green-600">
                                        Submit Grades
                                    </button>
                                </div>
                            </form>



                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach



    </div>

    <script>
        document.querySelectorAll('input[list]').forEach(input => {
            input.addEventListener('input', function() {
                const instructorIdInput = document.getElementById('instructor-id-' + this.id.split('-')[1]);
                const selectedOption = Array.from(this.list.options).find(option => option.value === this
                    .value);
                if (selectedOption) {
                    instructorIdInput.value = selectedOption.getAttribute('data-id');
                } else {
                    instructorIdInput.value = ''; // Clear if no match
                }
            });
        });

        function removeDots(element) {
            if (element.innerText === '..') {
                element.innerText = ''; // Remove dots
            }
        }
    </script>

</x-app-layout>
