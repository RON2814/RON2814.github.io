<!-- Update Student Modal -->
<div id="enrollModal"
    class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="modal-container bg-white w-full sm:w-[80%] md:w-[80%] lg:w-[80%] max-w-full h-[92vh] max-h-[92vh] rounded-lg shadow-2xl p-12 py-8 relative overflow-y-auto">

        <!-- Close Button -->
        <button onclick=c() class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        {{-- Page 1  --}}
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b border-gray-300">STUDENT ENROLLMENT </h3>

        <h2
            class="text-sm font-semibold text-black-600 mb-4 border-b border-gray-200 flex justify-between items-center">
            <span>Student Personal Information:</span>
            <span class="text-xs text-red-500">Update information if required</span>
        </h2>

        <form id="enrollmentForm" method="POST"
            action="{{ route('registrar.enrollment-lists', ['student_number' => $student->student_number]) }}">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-x-4 gap-y-2">


                {{-- Student Number --}}
                <div>
                    <label for="updateStudentNumber" class="text-xs font-medium text-gray-700">Student Number <span
                            class="text-red-400">*</span></label>
                    <input required type="text" id="updateStudentNumber" name="student_number"
                        value="{{ old('student_number') }}" disabled
                        class="mt-1 px-3 py-2 border bg-gray-200 @error('student_number') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                    <x-input-error :messages="$errors->get('student_number')" class="mt-1 text-xs" id="error-student_number" />
                </div>
                {{-- Student Full Name  --}}
                <div class="col-span-2">
                    <label for="updatefullName" class="text-xs font-medium text-gray-700">Student Name (LN, FN MN)
                        <span class="text-red-400">*</span></label>
                    <input required type="text" id="fullName" name="full_name"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('full_name') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent uppercase">
                    <x-input-error :messages="$errors->get('full_name')" class="mt-1 text-xs" id="error-full_name" />
                </div>

                {{-- Classification --}}
                <div>
                    <label for="updateClassification" class="text-xs font-medium text-gray-700">Classification <span
                            class="text-red-400">*</span></label>
                    <select required id="updateClassification" name="classification"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('classification') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Select Classification</option>
                        <option value="Regular" @if (old('classification', $student->classification) == 'Regular') selected @endif>Regular</option>
                        <option value="Irregular" @if (old('classification', $student->classification) == 'Irregular') selected @endif>Irregular
                        </option>
                        <option value="Transferee" @if (old('classification', $student->classification) == 'Transferee') selected @endif>Transferee
                        </option>
                        <option value="Returnee" @if (old('classification', $student->classification) == 'Returnee') selected @endif>Returnee</option>
                    </select>

                    <x-input-error :messages="$errors->get('classification')" class="mt-1 text-xs" id="error-classification" />
                </div>

                {{-- Program --}}
                <div>
                    <label for="updateProgram" class="text-xs font-medium text-gray-700">Program <span
                            class="text-red-400">*</span></label>
                    <select required id="updateProgram" name="program_id"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('program_id') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Select Program</option>
                        <option value="1" {{ old('program_id') == 1 ? 'selected' : '' }}>BSCS</option>
                        <option value="2" {{ old('program_id') == 2 ? 'selected' : '' }}>BSIT</option>
                    </select>
                    <x-input-error :messages="$errors->get('program_id')" class="mt-1 text-xs" id="error-program_id" />
                </div>

                {{-- Section --}}
                <div>
                    <label for="section" class="text-xs font-medium text-gray-700">Section <span
                            class="text-red-400">*</span></label>

                    <select id="section" name="section"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('section') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Section</option>

                    </select>
                    <x-input-error :messages="$errors->get('section')" class="mt-1 text-xs" id="error-section" />
                </div>


                {{-- Email --}}
                <div class="col-span-2">
                    <label for="updateEmail" class="text-xs font-medium text-gray-700">Email <span
                            class="text-red-400">*</span></label></label>
                    <input type="text" id="updateEmail" name="email" value="{{ old('email') }}"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('email') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" id="error-email" />
                </div>

                {{-- Contact Number --}}
                <div>
                    <label for="updateContactNumber" class="text-xs font-medium text-gray-700">Contact
                        Number</label>
                    <input type="text" id="updateContactNumber" name="contact_number"
                        value="{{ old('contact_number') }}"
                        class="mt-1 px-3 py-2 border bg-gray-100 @error('contact_number') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                    <x-input-error :messages="$errors->get('contact_number')" class="mt-1 text-xs" id="error-contact_number" />
                </div>

                @if (auth()->user()->role_id === 3)
                    {{-- Address --}}
                    <div class="col-start-1">
                        <label for="updateHouseNumber" class="text-xs font-medium text-gray-700">House
                            Number</label>
                        <input type="text" id="updateHouseNumber" name="house_number"
                            value="{{ old('house_number') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('house_number') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('house_number')" class="mt-1 text-xs" id="error-house_number" />
                    </div>

                    <div>
                        <label for="updateStreet" class="text-xs font-medium text-gray-700">Street</label>
                        <input type="text" id="updateStreet" name="street" value="{{ old('street') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('street') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('street')" class="mt-1 text-xs" id="error-street" />
                    </div>

                    <div>
                        <label for="updateBarangay" class="text-xs font-medium text-gray-700">Barangay</label>
                        <input type="text" id="updateBarangay" name="barangay" value="{{ old('barangay') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('barangay') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('barangay')" class="mt-1 text-xs" id="error-barangay" />
                    </div>

                    <div>
                        <label for="updateCity" class="text-xs font-medium text-gray-700">City</label>
                        <input type="text" id="updateCity" name="city" value="{{ old('city') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('city') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('city')" class="mt-1 text-xs" id="error-city" />
                    </div>

                    <div>
                        <label for="updateProvince" class="text-xs font-medium text-gray-700">Province</label>
                        <input type="text" id="updateProvince" name="province" value="{{ old('province') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('province') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('province')" class="mt-1 text-xs" id="error-province" />
                    </div>

                    <div>
                        <label for="updateZipcode" class="text-xs font-medium text-gray-700">Zip code</label>
                        <input type="text" id="updateZipcode" name="zip_code" value="{{ old('zip_code') }}"
                            class="mt-1 px-3 py-2 border bg-gray-100 @error('zip_code') border-red-500 @enderror border-gray-300 rounded-md w-full shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('zip_code')" class="mt-1 text-xs" id="error-zip_code" />
                    </div>
                @endif
            </div>

            <div class="mt-8 flex space-x-6">

                <!-- Courses Section -->
                <div id="checklistTable">
                    {{-- JS will do here  --}}
                </div>
            </div>
        </form>

        {{-- Billing Information  --}}
        @include('modals.registrar.partials.billing', ['student' => $student])


        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-12 border-t border-gray-300 pt-2">
            <!-- Text on the left -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="verifyCheckbox" class="form-checkbox h-4 w-4 text-indigo-600">
                <label for="verifyCheckbox" class="text-gray-700">I confirm that the student's information is
                    accurate
                    and complete.</label>
            </div>

            <!-- Buttons on the right -->
            <div class="flex space-x-4">
                <!-- Cancel Button -->
                <button type="button" onclick="c()"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none transition duration-200 ease-in-out">
                    Cancel
                </button>
                <!-- Update Button -->
                <button type="submit" onclick="showSuccessModal()"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none transition duration-200 ease-in-out">
                    Submit
                </button>
            </div>
        </div>

        {{-- Success Modal --}}
        @include('modals.registrar.partials.success-notif')

        </form>
    </div>
</div>

<script>
    // Open modal with student data
    function openEnrollStudentModal(student) {
        console.log(student); // Check the student data

        const checklistTable = document.getElementById('checklistTable');
        checklistTable.innerHTML = '';


        if (typeof student === 'string') {
            student = JSON.parse(student);
        }

        console.log('Full student object:', student);

        // Show modal
        const modal = document.getElementById('enrollModal');
        if (modal) modal.classList.remove('hidden');

        // Helper function to safely set element value
        const setElementValue = (id, value) => {
            const element = document.getElementById(id);
            if (element) element.value = value || '';
        };

        // Set form action
        const form = document.getElementById('enrollmentForm');
        if (form) form.action = `/enrollment-lists/update/${student.student_number}`;

        // Set basic info
        setElementValue('updateStudentNumber', student.student_number);
        const fullName =
            `${student.last_name}, ${student.first_name} ${student.middle_name ? student.middle_name + ' ' : ''}${student.extension_name ? student.extension_name : ''}`;
        setElementValue('fullName', fullName);
        setElementValue('updateEmail', student.user?.email);
        setElementValue('updateContactNumber', student.contact_number);

        // Set dropdowns
        console.log('Setting program_id:', student.program_id);
        console.log('Setting classification:', student.classification);
        setElementValue('updateProgram', student.program_id);
        setElementValue('updateClassification', student.classification);

        setElementValue('updateHouseNumber', student.address.house_number);
        setElementValue('updateStreet', student.address.street);
        setElementValue('updateBarangay', student.address.barangay);
        setElementValue('updateCity', student.address.city);
        setElementValue('updateProvince', student.address.province);
        setElementValue('updateZipcode', student.address.zip_code);

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

        // Close the modal when the close button is clicked
        const closeBtn = creditLimitModal.querySelector('.close-btn');
        closeBtn.addEventListener('click', function() {
            creditLimitModal.classList.add('hidden');
        });

        // Show the modal when the credit unit limit is exceeded
        function showCreditLimitModal() {
            console.log("Credit limit exceeded, showing modal.");
            creditLimitModal.classList.remove('hidden');
        }

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
                    `;

                        tbody.appendChild(row);
                    });
                }
            });
        });

        modal.classList.remove('hidden');
    }

    // Close modal
    function c() {
        document.getElementById('enrollModal').classList.add('hidden');
    }



    function togglePaymentFields() {
        var checkbox = document.getElementById('applyFreeTuition');
        var receivedMoneyDiv = document.getElementById('receivedMoneyDiv');
        var changeDiv = document.getElementById('changeDiv');

        // Toggle visibility of "Received Money" and "Change" divs based on checkbox state
        if (checkbox.checked) {
            receivedMoneyDiv.style.display = 'none';
            changeDiv.style.display = 'none';
        } else {
            receivedMoneyDiv.style.display = 'flex';
            changeDiv.style.display = 'flex';
        }
    }

    // Function to show the success modal
    function showSuccessModal() {
        document.getElementById('successModal').classList.remove('hidden');
    }

    // Function to close the success modal
    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
        document.getElementById('enrollModal').classList.add('hidden');

    }
</script>
