<!-- Add Admin Modal -->
<div id="addAdminModal" class="hidden flex fixed inset-0 bg-gray-800 bg-opacity-75 justify-center items-center z-50">
  <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl max-h-[80vh] overflow-y-auto">
    <h3 class="text-2xl font-semibold mb-6 text-gray-800">Add New Admin</h3>
    <form id="addAdminForm" action="{{ route('admin.manageUsers.store-admin') }}" method="POST">
      @csrf
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div>
          <label for="adminId" class="text-sm font-medium text-gray-700">Admin ID <span
              class="text-red-400">*</span></label>
          <input required type="text" id="adminId" name="admin_id" value="{{ old('admin_id') }}"
            class="mt-1 px-4 py-2 border @error('admin_id') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('admin_id')" class="mt-2" id="error-admin_id" />
        </div>

        <div>
          <label for="password" class="text-sm font-medium text-gray-700">Password <span
              class="text-red-400">*</span></label>
          <div class="relative">
            <input required type="text" id="password" name="password"
              class="mt-1 px-4 py-2 border @error('password') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
            class="mt-1 px-4 py-2 border @error('last_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('last_name')" class="mt-2" id="error-last_name" />
        </div>

        <div>
          <label for="firstName" class="text-sm font-medium text-gray-700">First Name <span
              class="text-red-400">*</span></label>
          <input required type="text" id="firstName" name="first_name" value="{{ old('first_name') }}"
            class="mt-1 px-4 py-2 border @error('first_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('first_name')" class="mt-2" id="error-first_name" />
        </div>

        <div>
          <label for="middleName" class="text-sm font-medium text-gray-700">Middle Name <span
              class="text-red-400">*</span></label>
          <input type="text" id="middleName" name="middle_name" value="{{ old('middle_name') }}"
            class="mt-1 px-4 py-2 border @error('middle_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('middle_name')" class="mt-2" id="error-middle_name" />
        </div>

        <div>
          <label for="extensionName" class="text-sm font-medium text-gray-700">Extension Name</label>
          <input type="text" id="extensionName" name="extension_name" value="{{ old('extension_name') }}"
            class="mt-1 px-4 py-2 border @error('extension_name') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('extension_name')" class="mt-2" id="error-extension_name" />
        </div>

        <div>
          <label for="email" class="text-sm font-medium text-gray-700">Email</label>
          <input type="text" id="email" name="email" value="{{ old('email') }}"
            class="mt-1 px-4 py-2 border @error('email') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('email')" class="mt-2" id="error-email" />
        </div>

        <div>
          <label for="contactNumber" class="text-sm font-medium text-gray-700">Contact Number</label>
          <input type="text" id="contactNumber" name="contact_number" value="{{ old('contact_number') }}"
            class="mt-1 px-4 py-2 border @error('contact_number') border-red-500 @enderror border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
          <x-input-error :messages="$errors->get('contact_number')" class="mt-2" id="error-contact_number" />
        </div>

      </div>

      <!-- Modal Actions -->
      <div class="flex justify-end space-x-4 mt-6">
        <button type="button" onclick="closeAddAdminModal()" id="cancel"
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
  // Open Add Admin Modal
  function openAddAdminModal() {
    document.getElementById("addAdminModal").classList.remove("hidden");
  }

  // Close modal
  function closeAddAdminModal() {
    document.getElementById('addAdminModal').classList.add('hidden');
    clearInputFields();
  }

  function clearInputFields() {
    const form = document.getElementById('addAdminForm');
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
    openAddAdminModal();
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
