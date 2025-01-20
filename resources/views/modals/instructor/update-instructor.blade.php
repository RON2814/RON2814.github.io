<!-- Update Instructor Modal -->
<div id="updateInstructorModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-2xl transform transition-all duration-300 p-8 relative">
        <!-- Close Button -->
        <button onclick="closeUpdateModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-300">Update Instructor</h2>
        <!-- Form for updating instructor -->
        <form id="updateForms" method="POST" action="{{ route('department.instructor.update-instructor', ['id' => $instructor->id]) }}">
            @csrf
            @method('PATCH') <!-- PATCH METHOD -->

            <!-- Input Fields -->
            <div class="space-y-4">
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-600">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="mt-1 p-3 w-full border rounded-lg shadow-sm bg-gray-100 focus:ring-blue-500 focus:border-blue-500 text-gray-800" required>
                </div>
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-600">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="mt-1 p-3 w-full border rounded-lg shadow-sm bg-gray-100 focus:ring-blue-500 focus:border-blue-500 text-gray-800" required>
                </div>
                <div>
                    <label for="middle_name" class="block text-sm font-medium text-gray-600">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="mt-1 p-3 w-full border rounded-lg shadow-sm bg-gray-100 focus:ring-blue-500 focus:border-blue-500 text-gray-800">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" id="email" name="email" class="mt-1 p-3 w-full border rounded-lg shadow-sm bg-gray-100 focus:ring-blue-500 focus:border-blue-500 text-gray-800" required>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end mt-6">
                <button type="button" onclick="closeUpdateModal()" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition duration-300 mr-3">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeUpdateModal() {
        document.getElementById('updateInstructorModal').classList.add('hidden');
    }
</script>
