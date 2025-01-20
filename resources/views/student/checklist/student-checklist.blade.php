<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Student Grade Table</title>
</head>

<body class="main-content bg-[#ebe9e9]">
    {{-- header --}}
    <div class="header-wrapper flex justify-between items-center flex-wrap bg-white p-4 py-3">
        <div class="header-title pl-3 font-bold flex items-center gap-2">
            <a href="{{ route('student.student-grades') }}" class="text-gray-700 hover:text-gray-900 text-xl">
                <img src="{{ Vite::asset('resources/assets/back-arrow.svg') }}" alt="University Logo" class="w-6 mr-2">
            </a>
            <h2>Student Number: <span class="text-green-700">{{ $student->student_number }} </span> • <span
                    class="text-sm text-gray-600 uppercase">({{ $student->last_name }},
                    {{ $student->first_name }})</span></h2>
        </div>


        <div class="user-info flex items-center gap-2">
            <button onclick="open_request_grades()"
                class="text-sm text-blue-500 font-semibold py-2 px-4 underline">Request for Missing Grades</button>
        </div>
    </div>

    {{-- main content --}}
    <div class="p-16 py-2">
        @foreach (['First Year', 'Second Year', 'Third Year', 'Fourth Year'] as $year_level)
            @foreach (['First Semester', 'Second Semester'] as $semester)
                {{-- Year Level and Semester Section --}}
                <div class="bg-white p-8 rounded-lg shadow-xl mt-4">
                    <h2 class="text-2xl font-medium border-b border-gray-300 text-gray-800 mb-3">{{ $year_level }} -
                        {{ $semester }}</h2>
                    <div class="overflow-x-auto mt-0 rounded-md border">
                        <table class="min-w-full table-auto border-collapse border-spacing-0">
                            <thead class="bg-[#0A6847] text-white text-xs">
                                <tr>
                                    <th class="py-3 px-4 text-left font-medium">COURSE CODE</th>
                                    <th class="py-3 px-4 text-left font-medium">COURSE TITLE</th>
                                    <th class="py-3 px-4 text-left font-medium">Credit Units Lecture</th>
                                    <th class="py-3 px-4 text-left font-medium">Credit Units Laboratory</th>
                                    <th class="py-3 px-4 text-left font-medium">Contact Hours Lecture</th>
                                    <th class="py-3 px-4 text-left font-medium">Contact Hours Laboratory</th>
                                    <th class="py-3 px-4 text-left font-medium">Pre-requisites</th>
                                    <th class="py-3 px-4 text-left font-medium">Semester Taken</th>
                                    <th class="py-3 px-4 text-left font-medium">Final Grade</th>
                                    <th class="py-3 px-4 text-left font-medium">Instructor</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @php
                                    $total_grade_points = 0;
                                    $total_credits = 0;
                                    $total_credit_units_lecture = 0;
                                    $total_credit_units_laboratory = 0;
                                    $total_contact_hours_lecture = 0;
                                    $total_contact_hours_laboratory = 0;
                                @endphp

                                @foreach ($checklist as $item)
                                    @if ($item && $item->year == $year_level && $item->semester == $semester)
                                        
                                        <tr class="hover:bg-gray-100 transition-colors duration-200">
                                            <td class="py-4 px-4 text-sm truncate max-w-xs font-semibold">
                                                {{ $item->course_code }}</td>
                                            <td class="py-4 px-4 text-sm truncate max-w-xs">
                                                {{ $item->course->course_title }}</td>
                                            <td class="text-center py-4 px-4 text-sm truncate max-w-xs">
                                                {{ $item->course->credit_unit_lecture }}</td>
                                            <td class="text-center py-4 px-4 text-sm truncate max-w-xs">
                                                {{ $item->course->credit_unit_laboratory }}</td>
                                            <td class="text-center py-4 px-4 text-sm truncate max-w-xs">
                                                {{ $item->course->contact_hours_lecture }}</td>
                                            <td class="text-center py-4 px-4 text-sm truncate max-w-xs">
                                                {{ $item->course->contact_hours_laboratory }}</td>
                                            <td
                                                class="py-4 px-4 text-sm truncate whitespace-normal max-w-[120px] break-words">
                                                {{ $item->course->pre_requisite ?: '...' }}
                                            </td>
                                            <td class="py-4 px-4 text-sm truncate max-w-xs">
                                                {{ explode(' ', $item->semester)[0] ?? '' }}
                                            </td>
                                            <td class="py-4 px-4 text-sm truncate max-w-xs font-semibold text-center">
                                                {{ $item->grade ?? 'N/A' }}
                                            </td>
                                            <td class="py-4 px-4 text-sm truncate max-w-xs font-semibold">
                                                {{ $item->instructor ? $item->instructor->last_name . ', ' . $item->instructor->first_name[0] . '.' : 'N/A' }}
                                            </td>
                                        </tr>

                                        @php
                                            // Calculate total values for credits and grade points
                                            $credit_units =
                                                $item->course->credit_unit_lecture +
                                                $item->course->credit_unit_laboratory;
                                            $grade_value = floatval(trim($item->grade, 's')); // Assuming grade format includes 's'

                                            // Accumulate totals
                                            $total_credit_units_lecture += $item->course->credit_unit_lecture;
                                            $total_credit_units_laboratory += $item->course->credit_unit_laboratory;
                                            $total_contact_hours_lecture += $item->course->contact_hours_lecture;
                                            $total_contact_hours_laboratory += $item->course->contact_hours_laboratory;

                                            $total_grade_points += $credit_units * $grade_value;
                                            $total_credits += $credit_units;
                                        @endphp
                                    @endif
                                @endforeach

                                <tr class="mt-2">
                                    <td></td>
                                    <td class="font-semibold">Sub Total:</td>
                                    <td class="text-center">{{ $total_credit_units_lecture }}</td>
                                    <td class="text-center">{{ $total_credit_units_laboratory }}</td>
                                    <td class="text-center">{{ $total_contact_hours_lecture }}</td>
                                    <td class="text-center">{{ $total_contact_hours_laboratory }}</td>
                                    <td></td>
                                    <td class="font-semibold">GWA:</td>
                                    <td class="text-center">
                                        <strong class="text-green-600 font-semibold">
                                            {{ $total_credits > 0 ? number_format($total_grade_points / $total_credits, 2) : '' }}
                                        </strong>
                                    </td>

                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @endforeach

        @include('modals.student.student-request.request-grades')
    </div>

</body>

</html>
