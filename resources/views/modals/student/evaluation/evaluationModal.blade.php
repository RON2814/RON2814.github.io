<!-- Advising Modal -->
<div id="evaluationModal"
    class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="modal-container bg-white w-full sm:w-[80%] md:w-[80%] lg:w-[90%] max-w-full rounded-lg shadow-xl p-12 relative overflow-y-auto max-h-[calc(100vh-4rem)]">
        <!-- Close Button -->
        <button onclick="closeEvaluationModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-2xl text-center font-bold mb-2 text-dark-green border-b border-gray-300 w-full">
            <span class="text-green-700">Details for Advising</span>
        </h3>

        {{-- Enrollment Table COG  --}}
        <h2 class="text-xl font-semibold mb-2 text-gray-800">Submitted Grades for Evaluation</h2>

        <div id="evaltable">
            {{-- JS will do here  --}}
        </div>

        {{-- Checklist  --}}
        <h2 class="text-xl font-semibold text-gray-800 mt-12 ">Student Checklist</h2>
        <div id="checklistTable">
            {{-- JS will do here  --}}
        </div>

        {{-- Advising Table  --}}
        <div class="px-16 py-8 border border-gray-200 mt-12 shadow-lg rounded">
            <h3
                class="text-4xl font-semibold text-center mb-3 mt-3 text-dark-green border-b-2 border-gray-400 w-full pb-2">
                <span class="text-green-800">Advising</span>
            </h3>
            <p class="text-base text-center text-gray-900 mb-6">
                Kindly review the eligible courses for the student with student number
                <span class="font-semibold text-green-600" id="student_number"></span> to proceed with enrollment.<br>
                Once the checkboxes are marked, the selected courses will be displayed here.
            </p>
            <div id="advisingTableContainer">
                {{-- JS will do here  --}}
            </div>

        </div>


    </div>
</div>

<script>
    const submittedChecklist = @json($submittedChecklist);

    function openEvaluationModal(student) {
        console.log("Opening modal", student);

        const modal = document.getElementById('evaluationModal');
        const checklistTable = document.getElementById('checklistTable');
        const advisingTableContainer = document.getElementById('advisingTableContainer');
        const studentNumberElement = document.getElementById('student_number');

        studentNumberElement.textContent = student.student_number;
        checklistTable.innerHTML = '';
        advisingTableContainer.innerHTML = '';

        const checklist = student.checklist;

        const yearLevels = ['First Year', 'Second Year', 'Third Year', 'Fourth Year'];
        const semesters = ['First Semester', 'Second Semester', 'Midyear'];

        let totalCreditUnits = 0;

        // Create the modal to show when the credit units exceed the limit
        const creditLimitModal = document.createElement('div');
        creditLimitModal.classList.add('modal', 'hidden');
        creditLimitModal.innerHTML = `
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>The Courses Total Credit Units Exceeds the Limit</h2>
            <p>You cannot select more than 23 credit units.</p>
        </div>
    `;
        document.body.appendChild(creditLimitModal);

        const closeBtn = creditLimitModal.querySelector('.close-btn');
        closeBtn.addEventListener('click', function() {
            creditLimitModal.classList.add('hidden');
        });

        function showCreditLimitModal() {
            console.log("Credit limit exceeded, showing modal.");
            creditLimitModal.classList.remove('hidden');
        }

        // Create the evaluation table
        const evalTable = document.createElement('div');
        evalTable.id = 'evaltable';
        const table = document.createElement('table');
        table.classList.add('w-full', 'border-collapse', 'mb-4');

        // Table header
        const thead = document.createElement('thead');
        thead.classList.add('bg-[#0A6847]', 'text-white', 'text-xs');
        thead.innerHTML = `
<tr>
    <th class="px-4 py-2 text-left">Course Code</th>
    <th class="px-4 py-2 text-left">Course Title</th>
    <th class="px-4 py-2 text-left">Credit Units</th>
    <th class="px-4 py-2 text-center">Final Grades</th>
    <th class="px-4 py-2 text-left">Instructor</th>
</tr>
`;
        table.appendChild(thead);

        // Table body
        const tbody = document.createElement('tbody');
        submittedChecklist.forEach(checklistItem => {
            const row = document.createElement('tr');
            row.classList.add('border-b', 'border-gray-300');

            const courseCode = checklistItem.course_code || 'N/A';
            const courseTitle = checklistItem.course?.course_title || 'N/A';
            const creditUnits = (checklistItem.course?.credit_unit_lecture ?? 0) + (checklistItem.course
                ?.credit_unit_laboratory ?? 0) || 'N/A';
            const grade = checklistItem.grade || 'TBA';
            const instructor = checklistItem.instructor ? checklistItem.instructor.last_name : 'TBA';

            const gradeClass = ['4.00', '5.00', 'INC', 'DROPPED'].includes(grade) ? 'text-red-500' :
                'text-green-600';

            row.innerHTML = `
    <td class="px-4 py-2">${courseCode}</td>
    <td class="px-4 py-2">${courseTitle}</td>
    <td class="px-4 py-2">${creditUnits}</td>
    <td class="px-4 py-2 text-center font-bold ${gradeClass}">${grade}</td>
    <td class="px-4 py-2">${instructor}</td>
    `;
            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        evalTable.appendChild(table);
        document.getElementById('evaltable').appendChild(evalTable);

        function updateCheckboxes() {
            const checkboxes = document.querySelectorAll('.course-checkbox');
            checkboxes.forEach(checkbox => {
                const creditUnits = parseFloat(checkbox.dataset.creditUnits) || 0;
                const row = checkbox.closest('tr');
                const grade = row.querySelector('td:nth-child(7)')?.textContent.trim();
                const instructor = row.querySelector('td:nth-child(8)')?.textContent.trim();

                if (grade !== '..' && instructor !== '..') {
                    checkbox.disabled = true;
                    return;
                }

                if (totalCreditUnits + creditUnits > 23 && !checkbox.checked) {
                    checkbox.disabled = true;
                } else {
                    checkbox.disabled = false;
                }
            });
        }

        yearLevels.forEach(yearLevel => {
            semesters.forEach(semester => {
                const filteredItems = checklist.filter(item => item.year === yearLevel && item
                    .semester === semester);

                if (filteredItems.length > 0) {
                    const table = document.createElement('table');
                    table.classList.add('min-w-full', 'table-auto', 'border-collapse',
                        'border-spacing-0', 'table-fixed');

                    table.innerHTML = `
                    <thead class="bg-gray-200 text-xs">
                        <tr class="text-left bg-white border-none">
                            <th colspan="9" class="text-sm border-none font-medium border-b border-gray-300 py-2">
                                ${yearLevel} - ${semester}
                            </th>
                        </tr>
                        <tr class="border">
                            <th class="py-3 px-4 text-left font-medium border" style="width: 10%;">COURSE CODE</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 18%;">COURSE TITLE</th>
                            <th class="py-3 px-4 text-center font-medium border" style="width: 12%;">Credit Units</th>
                            <th class="py-3 px-4 text-center font-medium border" style="width: 12%;">Contact Hours</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 12%;">Pre-requisites</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 10%;">Semester Taken</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 8%;">Final Grade</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 12%;">Instructor</th>
                            <th class="py-3 px-4 text-left font-medium border" style="width: 8%;">Advise</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700"></tbody>
                `;

                    checklistTable.appendChild(table);

                    const tbody = table.querySelector('tbody');
                    filteredItems.forEach(item => {
                        const row = document.createElement('tr');
                        row.classList.add('hover', 'rounded-lg', 'transition-colors',
                            'duration-200');

                        const course = item.course ?? {};
                        const creditUnits = course.credit_unit_lecture ? Number(course
                            .credit_unit_lecture) + Number(course.credit_unit_laboratory ||
                            0) : 0;

                        row.innerHTML = `
                        <td class="py-4 px-4 text-sm truncate max-w-xs font-semibold border">${course.course_code ?? '..'}</td>
                        <td class="py-4 px-4 text-sm truncate max-w-[200px] break-words border">${course.course_title ?? '..'}</td>
                        <td class="text-center py-4 px-4 text-sm truncate max-w-xs border">${creditUnits}</td>
                        <td class="text-center py-4 px-4 text-sm truncate max-w-xs border">${course.contact_hours_lecture ? Number(course.contact_hours_lecture) + Number(course.contact_hours_laboratory || 0) : '..'}</td>
                        <td class="py-4 px-4 text-sm truncate border whitespace-normal max-w-[120px] break-words">${item.course?.pre_requisite ?? '..'}</td>
                        <td class="py-4 px-4 text-sm truncate max-w-xs border">${item.semester ?? '..'}</td>
                        <td class="py-4 px-4 text-sm font-semibold text-center max-w-xs border">${item.grade ?? '..'}</td>
                        <td class="py-4 px-4 text-sm font-semibold max-w-xs border"> ${item.instructor?.last_name || item.instructor?.first_name ? `${item.instructor?.last_name ?? '..'}, ${item.instructor?.first_name ? item.instructor.first_name.charAt(0) + '.' : '..'}` : '..'}</td>
                        <td class="py-4 px-4 text-sm font-semibold max-w-xs border">
                            <input type="checkbox" class="form-checkbox course-checkbox h-5 w-5 text-green-600 disabled:opacity-20 disabled:cursor-not-allowed"
                                data-credit-units="${creditUnits}" 
                                ${item.grade && item.instructor ? 'checked disabled' : ''} />
                        </td>
                    `;

                        tbody.appendChild(row);

                        const checkbox = row.querySelector('.course-checkbox');
                        if (checkbox) {
                            checkbox.addEventListener('change', function() {
                                const creditUnits = parseFloat(checkbox.dataset
                                    .creditUnits) || 0;
                                if (this.checked) {
                                    totalCreditUnits += creditUnits;

                                    const advisingRow = document.createElement('tr');
                                    advisingRow.classList.add('advising-row');
                                    advisingRow.innerHTML = `
                                    <td class="py-4 px-4 text-sm border" style="width: 10%;">${course.course_code ?? '..'}</td>
                                    <td class="py-4 px-4 text-sm border" style="width: 18%;">${course.course_title ?? '..'}</td>
                                    <td class="text-center py-4 px-4 text-sm border" style="width: 12%;">${creditUnits}</td>
                                    <td class="text-center py-4 px-4 text-sm border" style="width: 12%;">${course.contact_hours_lecture ? Number(course.contact_hours_lecture) + Number(course.contact_hours_laboratory || 0) : '..'}</td>
                                `;
                                    advisingTable.querySelector('tbody').appendChild(
                                        advisingRow);
                                } else {
                                    totalCreditUnits -= creditUnits;
                                    const rows = advisingTable.querySelectorAll(
                                        'tbody tr');
                                    rows.forEach(row => {
                                        const courseCode = row.querySelector(
                                            'td').textContent.trim();
                                        if (courseCode === course.course_code) {
                                            row.remove();
                                        }
                                    });
                                }

                                console.log(`Total credit units: ${totalCreditUnits}`);

                                if (totalCreditUnits > 23) {
                                    showCreditLimitModal();
                                    this.checked = false;
                                    totalCreditUnits -= creditUnits;
                                    const rows = advisingTable.querySelectorAll(
                                        'tbody tr');
                                    rows.forEach(row => {
                                        const courseCode = row.querySelector(
                                            'td').textContent.trim();
                                        if (courseCode === course.course_code) {
                                            row.remove();
                                        }
                                    });
                                }

                                updateCheckboxes();
                                updateAdvisingTable();
                            });
                        }
                    });
                }
            });
        });

        const advisingTable = document.createElement('table');
        advisingTable.classList.add('min-w-full', 'table-auto', 'border-collapse', 'border-spacing-0', 'table-fixed');
        advisingTable.innerHTML = `
        <thead>
            <tr class="bg-[#0A6847] text-white text-sm">
                <th class="py-3 px-4 text-left font-medium border" style="width: 10%;">COURSE CODE</th>
                <th class="py-3 px-4 text-left font-medium border" style="width: 18%;">COURSE TITLE</th>
                <th class="py-3 px-4 text-center font-medium border" style="width: 12%;">Credit Units</th>
                <th class="py-3 px-4 text-center font-medium border" style="width: 12%;">Contact Hours</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <tr id="no-advised-courses-row">
                <td colspan="4" class="text-center">No courses have been advised yet.</td>
            </tr>
        </tbody>
    `;

        function updateAdvisingTable() {
            const advisingRows = advisingTable.querySelectorAll('tbody tr');
            const noAdvisedCoursesRow = advisingTable.querySelector('#no-advised-courses-row');

            if (advisingRows.length > 1) { // More than the "No advised courses yet" row
                noAdvisedCoursesRow.style.display = 'none'; // Hide the message
            } else {
                noAdvisedCoursesRow.style.display = ''; // Show the message
            }
        }

        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('flex', 'justify-center', 'mt-6');

        const adviseButton = document.createElement('button');
        adviseButton.classList.add('px-6', 'py-3', 'bg-blue-500', 'text-white', 'font-semibold', 'rounded-lg',
            'hover:bg-blue-600', 'transition-colors', 'duration-300');
        adviseButton.textContent = 'Send Advising Request';

        buttonContainer.appendChild(adviseButton);

        advisingTableContainer.appendChild(advisingTable);
        advisingTableContainer.appendChild(buttonContainer);

        modal.classList.remove('hidden');
    }


    // Close Section Modal
    function closeEvaluationModal() {
        document.getElementById('evaluationModal').classList.add('hidden');
    }
</script>
