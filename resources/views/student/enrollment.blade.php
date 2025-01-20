<x-app-layout>
    {{-- main content  --}}
    <div class="main-content p-16 py-2 bg-[#ebe9e9]">
        <div class="overflow-x-auto bg-white p-8 rounded-lg shadow-2xl mt-2">
            <!-- Student Information Section -->
                <h2
                    class="flex justify-between items-center text-2xl font-medium border-b border-gray-300 text-gray-800 mb-5">
                    <span class="flex-1">Enrollment Module</span>
                    <div class="flex space-x-2">
                        <span class="text-sm text-blue-500">Enrollment /</span>
                        <span class="text-sm text-gray-500">Evaluation</span>
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
                            current section
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
                            {{ $highestYearLevel ?? 'N/A' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1" for="semester">Semester</label>
                        <div id="semester" class="w-full px-4 py-1 rounded-md text-gray-700 bg-gray-100 text-sm">
                            {{ $highestSemester ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="border-b border-gray-400 py-3"></div>

                <div class="overflow-x-auto rounded-lg mt-4 ">
                  <form action="" method="get">
                    <table class="min-w-full table-auto border-collapse border-spacing-0">
                        <thead class="bg-gray-200 text-xs">
                            <tr>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Code</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Description
                                </th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Credit Units</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Final Grade</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Instructor</th>
                                <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Remark</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 border border-gray-200">
                            @forelse($filteredChecklist as $checklist)
                                <tr class="hover:bg-gray-100 transition-colors duration-200">
                                    <td class="py-4 px-4 text-sm truncate max-w-xs">{{ $checklist->course_code }}</td>
                                    <td class="py-4 px-4 text-sm truncate max-w-xs">
                                        {{ $checklist->course->course_title ?? 'N/A' }}</td>
                                    <td class="py-4 px-4 text-sm truncate max-w-xs">
                                        {{ ($checklist->course->credit_unit_lecture ?? 0) + ($checklist->course->credit_unit_laboratory ?? 0) ?: 'N/A' }}
                                    </td>
                                    <td
                                        class="py-4 px-4 text-sm truncate max-w-xs @if (in_array($checklist->grade, ['4.00', '5.00'])) text-red-500 @elseif($checklist->grade === 'INC') text-yellow-500 @elseif($checklist->grade === 'DROPPED') text-gray-500 @endif">
                                        {{ $checklist->grade ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-4 text-sm truncate max-w-xs">
                                        {{ $checklist->instructor->last_name ?? 'N/A' }}
                                    </td>
                                    <td class="py-4 px-4 text-sm truncate max-w-xs font-semibold">
                                        @if (in_array($checklist->grade, ['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', 'S']))
                                            Passed
                                        @elseif(in_array($checklist->grade, ['4.00', '5.00']))
                                            Failed
                                        @elseif($checklist->grade === 'INC')
                                            INC
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 px-4 text-center text-sm">
                                        No data available for the enrollment. Please coordinate with the University.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                    <div class="mt-4">
                      <button type="submit"
                          formaction="{{ $evaluationStatus === 'PROCEED' ? route('student.enrollment-eval.evaluated-courses') : route('student.enrollment-eval.under-review') }}"
                          class="w-full bg-green-800 hover:bg-green-700 text-white py-1.5 px-2 shadow text-sm mt-4">
                          SUBMIT GRADES FOR EVALUATION
                      </button>
                  </div>
                  
            </form>
        </div>
    </div>
    </div>
</x-app-layout>
