<x-app-layout>

    <div class="main-content p-16 py-0 bg-[#ebe9e9]">
        {{-- Student Information Section --}}

        {{-- Grades Management --}}
        <div class="bg-white p-8 rounded-lg shadow-2xl mt-4">
            <h2 class="text-lg font-semibold mb-4 border-b border-gray-200">Grades Management</h2>
            <form method="GET" action="{{ route('student.student-grades') }}" class="grid grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-medium text-gray-700 mb-1" for="school_year">Year Level</label>
                    <select id="school_year" name="school_year" class="w-full py-1 border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Select year</option>
                        @foreach ($yearLevels as $yearLevel)
                            <option value="{{ $yearLevel }}"
                                {{ request('school_year') == $yearLevel ? 'selected' : '' }}>
                                {{ $yearLevel }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1" for="semester">Semester</label>
                    <select id="semester" name="semester" class="w-full py-1 border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Select Semester</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester }}"
                                {{ request('semester') == $semester ? 'selected' : '' }}>
                                {{ $semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-2 rounded-md shadow text-sm">
                        Display Grades
                    </button>
                    <a href="{{ route('student.student-checklist') }}"
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-1.5 px-2 rounded-md shadow text-sm text-center block">
                        View Checklist
                    </a>
                </div>

            </form>

            {{-- grades management --}}
            <div class="overflow-x-auto rounded-lg mt-4">
                <table class="min-w-full table-auto border-collapse border-spacing-0">
                    <thead class="bg-[#0A6847] text-white text-xs">
                        <tr>
                            <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Code</th>
                            <th class="border border-gray-300 py-3 px-4 text-left font-semibold">Course Title</th>
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
                                    {{ $checklist->course->course_title ?? 'N/A' }}
                                </td>
                                <td class="py-4 px-4 text-sm truncate max-w-xs">
                                    {{ ($checklist->course->credit_unit_lecture ?? 0) + ($checklist->course->credit_unit_laboratory ?? 0) ?: 'N/A' }}
                                </td>
                                <td class="py-4 px-4 text-sm truncate max-w-xs">{{ $checklist->grade ?? 'N/A' }}</td>
                                <td class="py-4 px-4 text-sm truncate max-w-xs">
                                    {{ ($checklist->instructor->first_name ?? '') . ' ' . ($checklist->instructor->last_name ?? 'N/A') }}
                                </td>
                                <td
                                    class="py-4 px-4 text-sm truncate max-w-xs font-semibold 
                                @if (is_null($checklist->grade) && !is_null($checklist->instructor)) text-blue-700
                                @elseif(is_null($checklist->grade) && is_null($checklist->instructor))
                                    text-gray-600
                                @elseif(in_array($checklist->grade, ['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', 'S']))
                                    text-green-700
                                @elseif(in_array($checklist->grade, ['4.00', '5.00']))
                                    text-red-600
                                @elseif($checklist->grade === 'INC')
                                    text-red-600
                                @else
                                    text-gray-500 @endif
                            ">
                                    @if (is_null($checklist->grade) && !is_null($checklist->instructor))
                                        Enrolled
                                    @elseif(is_null($checklist->grade) && is_null($checklist->instructor))
                                        N/A
                                    @elseif(in_array($checklist->grade, ['1.00', '1.25', '1.50', '1.75', '2.00', '2.25', '2.50', '2.75', '3.00', 'S']))
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
                                <td colspan="6" class="py-4 px-4 text-center text-sm">No checklist data available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $filteredChecklist->links('pagination::tailwind') }}
            </div>
            
            
        </div>
    </div>

</x-app-layout>
