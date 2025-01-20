<x-app-layout>
    {{-- main content  --}}
    <div class="main-content p-16 py-2 bg-[#ebe9e9]">
        <div class="overflow-x-auto bg-white p-8 rounded-lg shadow-2xl mt-2">
            <!-- Student Information Section -->
            <form action="" method="get">
                <h2
                    class="flex justify-between items-center text-2xl font-medium border-b border-gray-300 text-gray-800 mb-5">
                    <span class="flex-1">Student Evaluated Course:</span>
                    <div class="flex space-x-2">
                        <span class="text-sm text-gray-500">Enrollment /</span>
                        <span class="text-sm text-blue-500">Evaluation</span>
                    </div>
                </h2>
                <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="student_number">Student
                            Number</label>
                        <div id="student_number"
                            class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm font-semibold">
                            {{ $student->student_number }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="student_name">Student
                            Name</label>
                        <div id="student_name" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm ">
                            {{ strtoupper($student->last_name ?? '') }}, {{ strtoupper($student->first_name ?? '') }}
                            {{ strtoupper($student->middle_name ?? '') }}
                        </div>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="section">Section</label>
                        <div id="section" class="w-full px-4 py-1 rounded-md text-gray-700 bg-gray-100 text-sm">
                            next section
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1"
                            for="classification">Classification</label>
                        <div id="classification"
                            class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm font-semibold">
                            {{ strtoupper($student->classification ?? 'N/A') }}
                        </div>
                    </div>


                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="program_name">Program</label>
                        <div id="program_name" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                            {{ $student->program ? $student->program->title : '' }}

                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="major">Major</label>
                        <div id="major" class="w-full px-4 py-1 rounded-md text-gray-700 bg-gray-100 text-sm">
                            {{ strtoupper($student->program->major ?? 'N/A') }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="year_level">Year Level</label>
                        <div id="year_level" class="w-full px-4 py-1 rounded-md text-gray-700 bg-gray-100 text-sm">
                            {{ $nextYearLevelString }} <!-- Display the year level -->
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="semester">Semester</label>
                        <div id="semester" class="w-full px-4 py-1 rounded-md text-gray-700 bg-gray-100 text-sm">
                            {{ $nextSemesterString }}
                        </div>
                    </div>



                </div>
                <div class="border-b border-gray-400 py-2"></div>

                <div class="overflow-x-auto rounded-lg mt-3 ">

                    <table class="min-w-full table-auto border-collapse border-spacing-0">
                        <thead class="bg-gray-200 text-xs">
                            <tr>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Code</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Title</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Credit Units</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Instructor</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 border border-gray-200">
                            @if ($nextCourses->isEmpty())
                                <tr>
                                    <td colspan="4" class="py-4 px-4 text-center text-sm">No evaluated courses
                                        available.</td>
                                </tr>
                            @else
                                @foreach ($nextCourses as $course)
                                    <tr class="hover:bg-gray-100 transition-colors duration-200">
                                        <td class="py-4 px-4 text-sm truncate max-w-xs">{{ $course->course_code }}</td>
                                        <td class="py-4 px-4 text-sm truncate max-w-xs">
                                            {{ $course->course->course_title }}</td>
                                        <td class="py-4 px-4 text-sm truncate max-w-xs">
                                            {{ ($course->course->credit_unit_lecture ?? 0) + ($course->course->credit_unit_laboratory ?? 0) ?: 'N/A' }}
                                        </td>
                                        <td class="py-4 px-4 text-sm truncate max-w-xs">
                                            {{ $course->instructor ? $course->instructor->name : 'TBA' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    @if ($evaluationStatus === 'UNDER REVIEW')
                        <p class="text-center text-red-500 font-semibold mt-4">Your enrollment is under review due to
                            grade discrepancies.</p>
                    @else
                        <button type="submit" formaction="{{ route('student.enrollment-eval.cor') }}"
                            class="w-full bg-green-800 hover:bg-green-700 text-white py-1.5 px-2 shadow text-sm mt-4">
                            PROCEED TO ASSESSMENT
                        </button>
                    @endif

            </form>
        </div>
    </div>


    </div>
</x-app-layout>
