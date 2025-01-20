<!-- Section Modal -->
<div id="sectionModal"
    class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div class="modal-container bg-white w-full sm:w-[80%] md:w-[80%] lg:w-[50%] max-w-full rounded-lg shadow-xl p-8 relative overflow-y-auto">
        <!-- Close Button -->
        <button onclick="closeSectionModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <h3 class="text-2xl font-semibold mb-2 text-gray-800 border-b border-gray-300">
            Set Section Capacity
        </h3>

        <p class="text-gray-600 mb-6">Specify the details below to manage the maximum number of students per section.</p>

        <!-- Form -->
        <form action="#" method="POST">
            <!-- Program Dropdown -->
            <div class="mb-4">
                <label for="program" class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                <select id="program" name="program" class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1">BS - Computer Science</option>
                    <option value="2">BS - Information Technology</option>
                </select>
            </div>

            <!-- Year Level Dropdown -->
            <div class="mb-4">
                <label for="yearLevel" class="block text-sm font-medium text-gray-700 mb-2">Year Level</label>
                <select id="yearLevel" name="yearLevel" class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1st">1st Year</option>
                    <option value="2nd">2nd Year</option>
                    <option value="3rd">3rd Year</option>
                    <option value="4th">4th Year</option>
                </select>
            </div>

            <!-- Maximum Capacity Input -->
            <div class="mb-4">
                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Set Maximum Capacity</label>
                <input id="capacity" name="capacity" type="number" min="1" placeholder="Enter capacity"
                    class="w-full px-4 py-2 bg-gray-100 text-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Save Capacity
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Open Section Modal
    function openSectionModal() {
        document.getElementById('sectionModal').classList.remove('hidden');
    }

    // Close Section Modal
    function closeSectionModal() {
        document.getElementById('sectionModal').classList.add('hidden');
    }
</script>
