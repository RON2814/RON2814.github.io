<!-- Add Student Modal -->
<div id="addStudentModal"
    class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="modal-container bg-white w-full sm:w-[90%] md:w-[90%] lg:w-[70%] max-w-full rounded-lg shadow-xl p-6 relative overflow-y-auto h-[90vh]">

        <!-- Close Button -->
        <button onclick="closeAddStudentModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h3 class="text-2xl font-semibold mb-2 text-gray-800 border-b ">REGISTER STUDENT</h3>

        <form id="addStudentForm"
            action="{{ auth()->user()->role_id === 4 ? route('admin.manageUsers.store-student') : route('registrar.enrollment-lists.store') }}"
            method="POST">
            @csrf

            <div class = "p-4 border border-gray-200 mt-2 shadow rounded">
                <h3 class="text-base font-semibold mb-2 text-dark-green border-b-2 border-gray-400 w-full pb-2">
                    <span class="text-green-800">Student Information</span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                    <div>
                        <label for="studentNumber" class="text-sm font-medium text-gray-700">Student Number <span
                                class="text-red-400">*</span></label>
                        <input required type="text" id="studentNumber" name="student_number"
                            value="{{ old('student_number') }}" placeholder="2025####"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('student_number') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('student_number')" class="mt-2" id="error-student_number" />
                    </div>

                    <div>
                        <label for="password" class="text-sm font-medium text-gray-700">Password <span
                                class="text-red-400">*</span></label>
                        <div class="relative">
                            <input required type="text" id="password" name="password"
                                class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('password') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                oninput="toggleIcon()">
                            <i id="generatePass"
                                class="fas fa-sync-alt absolute top-1/2 translate-y-[-40%] right-3 cursor-pointer text-blue-500"
                                onclick="generatePassword()"></i>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" id="error-password" />
                    </div>

                    <div>
                        <label for="lastName" class="text-sm font-medium text-gray-700">Last Name <span
                                class="text-red-400">*</span></label>
                        <input required type="text" id="lastName" name="last_name" value="{{ old('last_name') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('last_name') bg-gray-100 border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" id="error-last_name" />
                    </div>

                    <div>
                        <label for="firstName" class="text-sm font-medium text-gray-700">First Name <span
                                class="text-red-400">*</span></label>
                        <input required type="text" id="firstName" name="first_name" value="{{ old('first_name') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70  @error('first_name') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" id="error-first_name" />
                    </div>

                    <div>
                        <label for="middleName" class="text-sm font-medium text-gray-700">Middle Name <span
                                class="text-red-400">*</span></label>
                        <input type="text" id="middleName" name="middle_name" value="{{ old('middle_name') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('middle_name') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('middle_name')" class="mt-2" id="error-middle_name" />
                    </div>

                    <div>
                        <label for="extensionName" class="text-sm font-medium text-gray-700">Extension Name</label>
                        <input type="text" id="extensionName" name="extension_name"
                            value="{{ old('extension_name') }}" placeholder="Jr., Sr., III"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('extension_name') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('extension_name')" class="mt-2" id="error-extension_name" />
                    </div>

                    <div>
                        <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('email') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" id="error-email" />
                    </div>

                    @if (auth()->user()->role_id === 3)
                        <div>
                            <label for="contactNumber" class="text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text" id="contactNumber" name="contact_number"
                                value="{{ old('contact_number') }}"
                                class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('contact_number') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" id="error-contact_number" />
                        </div>
                    @endif
                    <div>
                        <label for="sex" class="text-sm font-medium text-gray-700">Sex</label>
                        <select required id="sex" name="sex"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('sex') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                            <option value="" disabled selected>Select Option</option>
                            <option value="male" {{ old('sex') == 1 ? 'selected' : '' }}>male</option>
                            <option value="female" {{ old('sex') == 2 ? 'selected' : '' }}>female</option>
                        </select>
                        <x-input-error :messages="$errors->get('sex')" class="mt-2" id="error-sex" />
                    </div>
                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-600 mb-1">Birth Date</label>
                        <input id="birthday" type="date" name="birthday" value="{{ old('birthday') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('email') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                        <x-input-error :messages="$errors->get('birthday')" class="mt-2" id="error-birthday" />
                    </div>

                    <!-- Program Dropdown -->
                    <div>
                        <label for="program" class="text-sm font-medium text-gray-700">Program <span
                                class="text-red-400">*</span></label>
                        <select required id="program" name="program_id"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('program_id') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="" disabled selected>Select Program</option>
                            <option value="1" {{ old('program_id') == 1 ? 'selected' : '' }}>BS - Computer
                                Science
                            </option>
                            <option value="2" {{ old('program_id') == 2 ? 'selected' : '' }}>BS - Information Technology
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('program_id')" class="mt-2" id="error-program_id" />
                    </div>

                    <!-- Classification Dropdown -->
                    <div>
                        <label for="classification" class="text-sm font-medium text-gray-700">Classification <span
                                class="text-red-400">*</span></label>
                        <select required id="classification" name="classification"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('classification') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="" disabled selected>Select Classification</option>
                            <option value="freshmen" {{ old('classification') == 'freshmen' ? 'selected' : '' }}>
                                Freshmen
                            </option>
                            <option value="regular" {{ old('classification') == 'regular' ? 'selected' : '' }}>Regular
                            </option>
                            <option value="irregular" {{ old('classification') == 'irregular' ? 'selected' : '' }}>
                                Irregular
                            </option>
                            <option value="transferee" {{ old('classification') == 'transferee' ? 'selected' : '' }}>
                                Transferee
                            </option>
                            <option value="returnee" {{ old('classification') == 'returnee' ? 'selected' : '' }}>
                                Returnee
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('classification')" class="mt-2" id="error-classification" />
                    </div>

                </div>
            </div>

            {{-- admission information  --}}
            <div id="freshmen-fields" class="hidden p-4 border border-gray-200 mt-4 shadow rounded">
                <h3 class="text-base font-semibold mb-3 mb-2 text-dark-green border-b-2 border-gray-400 w-full pb-2">
                    <span class="text-green-800">Additional Information for Freshmen</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div>
                        <label for="admissionNumber" class="text-sm font-medium text-gray-700">Admission Control
                            Number<span class="text-red-400">*</span></label></label>
                        <input type="text" id="admissionNumber" name="admissionNumber"
                            value="{{ old('admissionNumber') }}" placeholder="Enter control number"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('admissionNumber') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('admissionNumber')" class="mt-2" id="error-admissionNumber" />
                    </div>

                    <div>
                        <label for="lrn" class="text-sm font-medium text-gray-700">Learner Reference Number<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="lrn" name="lrn" value="{{ old('lrn') }}"
                            placeholder="Enter LRN"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('lrn') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('lrn')" class="mt-2" id="error-lrn" />
                    </div>

                    <div>
                        <label for="medicalStatus" class="text-sm font-medium text-gray-700">Medical Status <span
                                class="text-red-400">*</span></label>
                        <select id="medicalStatus" name="medical_status" value="{{ old('medical_status') }}"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('medical_status') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="PASSED" disabled>Select Medical Result</option>
                            <option value="PASSED">Passed</option>
                            <option value="NOT QUALIFIED">Not Qualified</option>
                        </select>
                        <x-input-error :messages="$errors->get('medical_status')" class="mt-2" id="error-medical_status" />
                    </div>

                    <div class="col-span-2">
                        <label for="previousSchool" class="text-sm font-medium text-gray-700">Previous School</label>
                        <input type="text" id="previousSchool" name="previous_school"
                            value="{{ old('previous_school') }}" placeholder="Enter Previous School"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('previous_school') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('previous_school')" class="mt-2" id="error-previous_school" />
                    </div>

                </div>


            </div>

            {{-- Address Informatio  --}}

            <div class="p-4 border border-gray-200 mt-4 shadow rounded">
                <h3 class="text-base font-semibold mb-3 mt-2 text-dark-green border-b-2 border-gray-400 w-full pb-2">
                    <span class="text-green-800">Address Information</span>
                </h3>
                {{-- @if (auth()->user()->role_id === 3) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">

                    <div>
                        <label for="houseNumber" class="text-sm font-medium text-gray-700">House Number<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="houseNumber" name="house_number"
                            value="{{ old('house_number') }}" placeholder="Enter House Number"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('house_number') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('house_number')" class="mt-2" id="error-house_number" />
                    </div>

                    <div>
                        <label for="street" class="text-sm font-medium text-gray-700">Street<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="street" name="street" value="{{ old('street') }}"
                            placeholder="Enter Street"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('street') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('street')" class="mt-2" id="error-street" />
                    </div>

                    <div>
                        <label for="barangay" class="text-sm font-medium text-gray-700">Barangay<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="barangay" name="barangay" value="{{ old('barangay') }}"
                            placeholder="Enter Barangay"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('barangay') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('barangay')" class="mt-2" id="error-barangay" />
                    </div>

                    <div>
                        <label for="city" class="text-sm font-medium text-gray-700">City<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}"
                            placeholder="Enter City"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('city') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('city')" class="mt-2" id="error-city" />
                    </div>

                    <div>
                        <label for="province" class="text-sm font-medium text-gray-700">Province<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="province" name="province" value="{{ old('province') }}"
                            placeholder="Enter Province"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('province') border-red-500 @enderror rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent capitalize">
                        <x-input-error :messages="$errors->get('province')" class="mt-2" id="error-province" />
                    </div>

                    <div>
                        <label for="zipcode" class="text-sm font-medium text-gray-700">Zip code<span
                                class="text-red-400">*</span></label></label>
                        <input type="text" id="zipcode" name="zip_code" value="{{ old('zip_code') }}"
                            placeholder="Enter Zip Code"
                            class="mt-1 px-4 py-2 border border-gray-500 border-opacity-70 @error('zip_code') border-red-500 @enderror  rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <x-input-error :messages="$errors->get('zip_code')" class="mt-2" id="error-zip_code" />
                    </div>
                    {{-- @endif --}}
                </div>
            </div>

            {{-- Billing Information  --}}
            <div id="billing-fields" class="hidden p-4 border border-gray-200 mt-4 shadow rounded">
                @include('modals.registrar.partials.billing', ['student' => $student])

            </div>

            <div class="flex justify-end">
                <button id="enrollSaveButton" type="submit"
                    class="mt-8 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <!-- Default text, can be overwritten by JavaScript -->
                    Save Student
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // Open Add Student Modal
    function openAddStudentModal() {
        document.getElementById("addStudentModal").classList.remove("hidden");
    }

    // Close Add Student Modal and clear input fields
    function closeAddStudentModal() {
        document.getElementById('addStudentModal').classList.add('hidden');
        clearInputFields();
    }

    // Reset input fields and remove error indicators
    function clearInputFields() {
        const form = document.getElementById('addStudentForm');
        form.reset();
        document.querySelectorAll('input, select').forEach(element => {
            element.value = '';
            element.classList.remove('border-red-500');
            const errorElement = document.getElementById(`error-${element.name}`);
            if (errorElement) {
                errorElement.innerHTML = '';
            }
        });
    }

    // Update button text based on classification
    function updateButtonText() {
        const classification = document.getElementById("classification").value;
        const enrollSaveButton = document.getElementById("enrollSaveButton");
        enrollSaveButton.textContent = classification === "freshmen" ? "Enroll Student" : "Save Student";
    }

    // Handle classification change and update button text
    document.addEventListener("DOMContentLoaded", function() {
        const classificationSelect = document.getElementById("classification");
        updateButtonText(); // Set button text initially
        classificationSelect.addEventListener("change", updateButtonText);
    });

    // Generate a random password and toggle the password icon visibility
    function generatePassword() {
        const length = 8;
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        let password = "";
        for (let i = 0, n = charset.length; i < length; ++i) {
            password += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("password").value = password;
        toggleIcon();
    }

    // Toggle visibility of the password generation icon
    function toggleIcon() {
        const passwordInput = document.getElementById("password");
        const generateIcon = document.getElementById("generatePass");
        generateIcon.style.display = passwordInput.value ? "none" : "block";
    }

    // Initialize icon visibility on page load
    document.addEventListener("DOMContentLoaded", function() {
        toggleIcon();
    });

    @if ($errors->any())
        openAddStudentModal();
    @endif

    // Remove error class and error messages on input change
    document.querySelectorAll('input, select').forEach(element => {
        element.addEventListener('input', function() {
            this.classList.remove('border-red-500');
            const errorElement = document.getElementById(`error-${this.name}`);
            if (errorElement) {
                errorElement.innerHTML = '';
            }
        });
    });

    // Toggle visibility of freshmen-related fields based on classification selection
    document.getElementById('classification').addEventListener('change', function() {
        const freshmenFields = document.getElementById('freshmen-fields');
        const classification = this.value;
        freshmenFields.classList.toggle('hidden', classification !== 'freshmen');
    });

    // Toggle billing information visibility based on classification and checkbox state
    const classificationSelect = document.getElementById('classification');
    const billingFields = document.getElementById('billing-fields');
    const applyFreeTuitionCheckbox = document.getElementById('applyFreeTuition');

    function toggleBillingFields() {
        const isFreshmen = classificationSelect.value === 'freshmen';
        billingFields.classList.toggle('hidden', !isFreshmen);
        applyFreeTuitionCheckbox.checked = isFreshmen;
        togglePaymentFields();
    }

    // Add event listener for changes in the classification select field
    classificationSelect.addEventListener('change', toggleBillingFields);

    // Initialize the state based on the current selected value
    toggleBillingFields();

    // Toggle visibility of payment-related fields based on the free tuition checkbox
    function togglePaymentFields() {
        const receivedMoneyDiv = document.getElementById('receivedMoneyDiv');
        const changeDiv = document.getElementById('changeDiv');
        const isFreeTuition = applyFreeTuitionCheckbox.checked;
        receivedMoneyDiv.style.display = isFreeTuition ? 'none' : 'flex';
        changeDiv.style.display = isFreeTuition ? 'none' : 'flex';
    }
</script>
