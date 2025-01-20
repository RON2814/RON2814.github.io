<!-- Modal -->
<div id="addInstructorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl transform transition-all duration-300 p-8 relative">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-300">+ Add Instructor</h2>
        <form id="instructorForm" action="{{ route('department.instructor.add-instructor') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800" placeholder="Enter last name" required>
                </div>
                <div>
                    <label for="firstName" class="block text-sm font-medium text-gray-600">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800" placeholder="Enter first name" required>
                </div>
                <div>
                    <label for="middleName" class="block text-sm font-medium text-gray-600">Middle Name</label>
                    <input type="text" id="middleName" name="middleName" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800" placeholder="Enter middle name">
                </div>
                <div>
                    <label for="emailAdd" class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" id="emailAdd" name="emailAdd" class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800" placeholder="Enter email address">
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition duration-300 mr-3">
                    Cancel
                </button>
                <button type="submit" onclick="validateForm()" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300">
                    Add Instructor
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const form = document.getElementById('instructorForm');
        if (form.checkValidity()) {
            openConfirmationModal();
        } else {
            form.reportValidity();
        }
    }

    function submitForm() {
        document.getElementById('instructorForm').submit();
    }

    function closeModal() {
        const modal = document.getElementById('addInstructorModal');
        modal.classList.add('hidden');
    }
</script>
