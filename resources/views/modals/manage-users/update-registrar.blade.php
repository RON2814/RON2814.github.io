<!-- Update Registrar/Department Modal -->
<div id="updateRegistrarModal"
  class="hidden flex fixed inset-0 bg-gray-800 bg-opacity-75 justify-center items-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl max-h-[80vh] overflow-y-auto">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Update Registrar</h3>
    <form id="updateRegistrarForm" action="" method="POST">
      @csrf
      @method('PATCH')
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div>
          <label for="updateDepartmentId" class="text-sm font-medium text-gray-700">Department ID <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateDepartmentId" name="registrar_id" value="{{ old('asd') }}"
            disabled
            class="mt-1 px-4 py-2 border @error('registrar_id') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('registrar_id')" class="mt-2" id="updateError-registrar_id" />
        </div>

        <div>
          <label for="updatePassword" class="text-sm font-medium text-gray-700">Password <span
              class="text-red-400">*</span></label>
          <div class="relative">
            <input type="text" id="updatePassword" name="password"
              class="mt-1 px-4 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              oninput="toggleIcon()">
            <i id="updateGeneratePass"
              class="fas fa-sync-alt absolute top-1/2 translate-y-[-40%] right-3 cursor-pointer text-blue-500"
              onclick="generatePassword()"></i>
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-1" id="updateError-password" />
        </div>

        <div>
          <label for="updateLastName" class="text-sm font-medium text-gray-700">Last Name <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateLastName" name="last_name" value="{{ old('last_name') }}"
            class="mt-1 px-4 py-2 border @error('last_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('last_name')" class="mt-2" id="updateError-last_name" />
        </div>

        <div>
          <label for="updateFirstName" class="text-sm font-medium text-gray-700">First Name <span
              class="text-red-400">*</span></label>
          <input required type="text" id="updateFirstName" name="first_name" value="{{ old('first_name') }}"
            class="mt-1 px-4 py-2 border @error('first_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('first_name')" class="mt-2" id="updateError-first_name" />
        </div>

        <div>
          <label for="updateMiddleName" class="text-sm font-medium text-gray-700">Middle Name <span
              class="text-red-400">*</span></label>
          <input type="text" id="updateMiddleName" name="middle_name" value="{{ old('middle_name') }}"
            class="mt-1 px-4 py-2 border @error('middle_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('middle_name')" class="mt-2" id="updateError-middle_name" />
        </div>

        <div>
          <label for="updateExtensionName" class="text-sm font-medium text-gray-700">Extension Name</label>
          <input type="text" id="updateExtensionName" name="extension_name" value="{{ old('extension_name') }}"
            class="mt-1 px-4 py-2 border @error('extension_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('extension_name')" class="mt-2" id="updateError-extension_name" />
        </div>

        <div>
          <label for="updateEmail" class="text-sm font-medium text-gray-700">Email</label>
          <input type="text" id="updateEmail" name="email" value="{{ old('email') }}"
            class="mt-1 px-4 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('email')" class="mt-2" id="updateError-email" />
        </div>

        <div>
          <label for="updateContactNumber" class="text-sm font-medium text-gray-700">Contact Number</label>
          <input type="text" id="updateContactNumber" name="contact_number" value="{{ old('contact_number') }}"
            class="mt-1 px-4 py-2 border @error('contact_number') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('contact_number')" class="mt-2" id="updateError-contact_number" />
        </div>
      </div>

      <!-- Modal Actions -->
      <div class="flex justify-end space-x-4 mt-6">
        <button type="button" onclick="closeUpdateRegistrarModal()" id="updateCancel"
          class="px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-sm hover:bg-gray-400 transition">
          Cancel
        </button>

        <button type="submit"
          class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 transition">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Open update modal with registrar data
  function openUpdateRegistrarModal(registrar) {
    if (typeof registrar === 'string') {
      registrar = JSON.parse(registrar);
    }

    console.log('Full registrar object:', registrar);

    // Show modal
    const modal = document.getElementById('updateRegistrarModal');
    if (modal) modal.classList.remove('hidden');

    // Helper function to safely set element value
    const setElementValue = (id, value) => {
      const element = document.getElementById(id);
      if (element) element.value = value || '';
    };

    // Set form action
    const form = document.getElementById('updateRegistrarForm');
    if (form) form.action = `/admin/manage-users/registrar/update/${registrar.registrar_id}`;

    // Set basic info
    setElementValue('updateDepartmentId', registrar.registrar_id);
    setElementValue('updateLastName', registrar.last_name);
    setElementValue('updateFirstName', registrar.first_name);
    setElementValue('updateMiddleName', registrar.middle_name);
    setElementValue('updateExtensionName', registrar.extension_name);
    setElementValue('updateEmail', registrar.user?.email);
    setElementValue('updateContactNumber', registrar.contact_number);
  }

  // Close modal
  function closeUpdateRegistrarModal() {
    document.getElementById('updateRegistrarModal').classList.add('hidden');
    clearInputFields();
  }

  document.getElementById('updateRegistrarForm').addEventListener('submit', function(e) {
    e.preventDefault();
    this.submit();
    closeUpdateStudentModal();
  });

  function clearInputFields() {
    const form = document.getElementById('updateRegistrarForm');
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

  function toggleIcon() {
    const passwordInput = document.getElementById("password");
    const generateIcon = document.getElementById("generatePass");
    if (passwordInput.value) {
      generateIcon.style.display = "none";
    } else {
      generateIcon.style.display = "block";
    }
  }

  // Initialize icon visibility on page load
  document.addEventListener("DOMContentLoaded", function() {
    toggleIcon();
  });

  @if ($errors->any())
    openUpdateRegistrarModal();
  @endif

  // Remove error class on input change
  document.querySelectorAll('input, select').forEach(element => {
    element.addEventListener('input', function() {
      this.classList.remove('border-red-500');
      const errorElement = document.getElementById(`error-${this.name}`);
      if (errorElement) {
        errorElement.innerHTML = '';
      }
    });
  });
</script>
