<!-- Update Student Modal -->
<div id="updateModal"
  class="fixed inset-0 z-50 hidden  bg-gray-800 bg-opacity-75 flex items-center justify-center transition-opacity duration-300 ease-in-out">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl max-h-[80vh] overflow-y-auto">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Update Student Information</h3>
    <form id="updateForm" method="POST" action="">
      @csrf
      @method('PATCH')
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div>
          <label for="updateStudentNumber" class="text-sm font-medium text-gray-700">Student Number <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateStudentNumber" name="student_number"
            value="{{ old('student_number') }}" disabled
            class="mt-1 px-4 py-2 border @error('student_number') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('student_number')" class="mt-2" id="error-student_number" />
        </div>

        <div>
          <label for="updatePassword" class="text-sm font-medium text-gray-700">Password <span
              class="text-red-400">*</span></label>
          <div class="relative">
            <input type="text" id="updatePassword" name="password"
              class="mt-1 px-4 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              oninput="toggleIcon()">
            <i id="generatePass"
              class="fas fa-sync-alt absolute top-1/2 translate-y-[-40%] right-3 cursor-pointer text-blue-500"
              onclick="generatePassword()"></i>
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-1" id="error-password" />
        </div>

        <div>
          <label for="updateLastName" class="text-sm font-medium text-gray-700">Last Name <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateLastName" name="last_name" value="{{ old('last_name') }}"
            class="mt-1 px-4 py-2 border @error('last_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('last_name')" class="mt-2" id="error-last_name" />
        </div>

        <div>
          <label for="updateFirstName" class="text-sm font-medium text-gray-700">First Name <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateFirstName" name="first_name" value="{{ old('first_name') }}"
            class="mt-1 px-4 py-2 border @error('first_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('first_name')" class="mt-2" id="error-first_name" />
        </div>

        <div>
          <label for="updateMiddleName" class="text-sm font-medium text-gray-700">Middle Name <span
              class="text-red-400">*</span></label>
          <input type="text" id="updateMiddleName" name="middle_name" value="{{ old('middle_name') }}"
            class="mt-1 px-4 py-2 border @error('middle_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('middle_name')" class="mt-2" id="error-middle_name" />
        </div>

        <div>
          <label for="updateExtensionName" class="text-sm font-medium text-gray-700">Extension Name</label>
          <input type="text" id="updateExtensionName" name="extension_name" value="{{ old('extension_name') }}"
            class="mt-1 px-4 py-2 border @error('extension_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('extension_name')" class="mt-2" id="error-extension_name" />
        </div>

        <div>
          <label for="updateSex" class="text-sm font-medium text-gray-700">Sex</label>
          <select required id="updateSex" name="sex"
            class="mt-1 px-4 py-2 border @error('sex') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="" disabled selected>Select Option</option>
            <option value="male" {{ old('sex') == 1 ? 'selected' : '' }}>male</option>
            <option value="female" {{ old('sex') == 2 ? 'selected' : '' }}>female</option>
          </select>
          <x-input-error :messages="$errors->get('sex')" class="mt-2" id="error-sex" />
        </div>

        <div>
          <label for="updateEmail" class="text-sm font-medium text-gray-700">Email</label>
          <input type="text" id="updateEmail" name="email" value="{{ old('email') }}"
            class="mt-1 px-4 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('email')" class="mt-2" id="error-email" />
        </div>

        {{-- @if (auth()->user()->role_id === 3) --}}
        <div>
          <label for="updateContactNumber" class="text-sm font-medium text-gray-700">Contact Number</label>
          <input type="text" id="updateContactNumber" name="contact_number" value="{{ old('contact_number') }}"
            class="mt-1 px-4 py-2 border @error('contact_number') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('contact_number')" class="mt-2" id="error-contact_number" />
        </div>
        {{-- @endif --}}

        <!-- Program Dropdown -->
        <div class="col-start-1">
          <label for="updateProgram" class="text-sm font-medium text-gray-700">Program <span
              class="text-red-400">*</span></label>
          <select required id="updateProgram" name="program_id"
            class="mt-1 px-4 py-2 border @error('program_id') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="" disabled selected>Select Program</option>
            <option value="1" {{ old('program_id') == 1 ? 'selected' : '' }}>BS Computer Science</option>
            <option value="2" {{ old('program_id') == 2 ? 'selected' : '' }}>BS Information Technology</option>
          </select>
          <x-input-error :messages="$errors->get('program_id')" class="mt-2" id="error-program_id" />
        </div>

        <div>
          <label for="updateBirthday" class="block text-sm font-medium text-gray-600 mb-1">Birth Date</label>
          <input id="updateBirthday" type="date" name="birthday" value="{{ old('birthday') }}"
            class="mt-1 px-4 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
          <x-input-error :messages="$errors->get('birthday')" class="mt-2" id="error-birthday" />
        </div>

        <!-- Classification Dropdown -->
        <div>
          <label for="updateClassification" class="text-sm font-medium text-gray-700">Classification <span
              class="text-red-400">*</span></label>
          <select required id="updateClassification" name="classification"
            class="mt-1 px-4 py-2 border @error('classification') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="" disabled selected>Select Classification</option>
            <option value="regular">Regular</option>
            <option value="irregular">Irregular</option>
            <option value="transferee">Transferee</option>
            <option value="returnee">Returnee</option>
          </select>
          <x-input-error :messages="$errors->get('classification')" class="mt-2" id="error-classification" />
        </div>

        {{-- registrar add student --}}
        {{-- @if (auth()->user()->role_id === 3) --}}
        <div>
          <label for="updateHouseNumber" class="text-sm font-medium text-gray-700">House Number</label>
          <input type="text" id="updateHouseNumber" name="house_number" value="{{ old('house_number') }}"
            class="mt-1 px-4 py-2 border @error('house_number') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('house_number')" class="mt-2" id="error-house_number" />
        </div>

        <div>
          <label for="updateStreet" class="text-sm font-medium text-gray-700">Street</label>
          <input type="text" id="updateStreet" name="street" value="{{ old('street') }}"
            class="mt-1 px-4 py-2 border @error('street') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('street')" class="mt-2" id="error-street" />
        </div>

        <div>
          <label for="updateBarangay" class="text-sm font-medium text-gray-700">Barangay</label>
          <input type="text" id="updateBarangay" name="barangay" value="{{ old('barangay') }}"
            class="mt-1 px-4 py-2 border @error('barangay') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('barangay')" class="mt-2" id="error-barangay" />
        </div>

        <div>
          <label for="updateCity" class="text-sm font-medium text-gray-700">City</label>
          <input type="text" id="updateCity" name="city" value="{{ old('city') }}"
            class="mt-1 px-4 py-2 border @error('city') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('city')" class="mt-2" id="error-city" />
        </div>

        <div>
          <label for="updateProvince" class="text-sm font-medium text-gray-700">Province</label>
          <input type="text" id="updateProvince" name="province" value="{{ old('province') }}"
            class="mt-1 px-4 py-2 border @error('province') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('province')" class="mt-2" id="error-province" />
        </div>

        <div>
          <label for="updateZipcode" class="text-sm font-medium text-gray-700">Zip code</label>
          <input type="text" id="updateZipcode" name="zip_code" value="{{ old('zip_code') }}"
            class="mt-1 px-4 py-2 border @error('zip_code') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('zip_code')" class="mt-2" id="error-zip_code" />
        </div>
        {{-- @endif --}}
      </div>

      <!-- Action buttons -->
      <div class="flex justify-end space-x-4 mt-6">
        <button type="button" onclick="closeUpdateStudentModal()"
          class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none transition duration-200 ease-in-out">Cancel</button>
        <button type="submit"
          class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none transition duration-200 ease-in-out">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Open modal with student data
  function openUpdateStudentModal(student) {
    if (typeof student === 'string') {
      student = JSON.parse(student);
    }

    console.log('Full student object:', student);

    // Show modal
    const modal = document.getElementById('updateModal');
    if (modal) modal.classList.remove('hidden');

    // Helper function to safely set element value
    const setElementValue = (id, value) => {
      const element = document.getElementById(id);
      if (element) element.value = value || '';
    };

    // Set form action
    const form = document.getElementById('updateForm');
    if (form) form.action = `/admin/manage-users/student/update/${student.student_number}`;

    // Set basic info
    setElementValue('updateStudentNumber', student.student_number);
    setElementValue('updateLastName', student.last_name);
    setElementValue('updateFirstName', student.first_name);
    setElementValue('updateMiddleName', student.middle_name);
    setElementValue('updateEmail', student.user?.email);
    setElementValue('updateContactNumber', student.contact_number);

    setElementValue('updateSex', student.sex);

    // Set dropdowns
    setElementValue('updateProgram', student.program_id);
    setElementValue('updateClassification', student.classification);

    setElementValue('updateHouseNumber', student.address.house_number);
    setElementValue('updateStreet', student.address.street);
    setElementValue('updateBarangay', student.address.barangay);
    setElementValue('updateCity', student.address.city);
    setElementValue('updateZipcode', student.address.zip_code);
  }

  // Close modal
  function closeUpdateStudentModal() {
    document.getElementById('updateModal').classList.add('hidden');
  }

  document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    this.submit();
    closeUpdateStudentModal();
  });

  function generatePassword() {
    const length = 8;
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let password = "";
    for (let i = 0, n = charset.length; i < length; ++i) {
      password += charset.charAt(Math.floor(Math.random() * n));
    }
    document.getElementById("password").value = password;
    toggleIcon();
  };

  document.querySelectorAll('#updateForm input, #updateForm select').forEach(element => {
    element.addEventListener('input', function() {
      this.classList.remove('border-red-500');
      const errorElement = document.getElementById(`error-${this.name}`);
      if (errorElement) {
        errorElement.innerHTML = '';
      }
    });
  });
</script>
