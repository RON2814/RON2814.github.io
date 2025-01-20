<!-- Request Grades Modal -->
<div id="request_grades" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-3xl">
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b border-gray-300">Request Missing Grades Record</h3>
        <form id="request_grades_form" method="POST" action="">
            @csrf
            <div class="gap-6">
                <div>
                    <label for="year_level" class="block text-sm font-medium text-gray-700">Year Level</label>
                    <select id="year_level" name="year_level"
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Select Year Level</option>
                        <option value="1">First Year</option>
                        <option value="2">Second Year</option>
                        <option value="3">Third Year</option>
                        <option value="4">Fourth Year</option>
                    </select>
                </div>
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                    <select id="semester" name="semester"
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="" disabled selected>Select Semester</option>
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Summer</option>
                    </select>
                </div>
                <div>
                    <label for="subject_code" class="block text-sm font-medium text-gray-700">Subject Code</label>
                    <input type="text" id="subject_code" name="subject_code" placeholder="example DCIT25" 
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label for="section" class="block text-sm font-medium text-gray-700">Section</label>
                    <input type="text" id="section" name="section" placeholder="example 3-2" 
                        class="mt-1 px-4 py-2 border border-gray-300 rounded-lg w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="flex justify-end space-x-4 mt-6">
                <button type="button" onclick="close_modal()" id="cancel"
                    class="px-6 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-sm hover:bg-gray-400 transition">
                    Cancel
                </button>

                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-lg shadow-sm hover:from-blue-600 hover:to-blue-800 transition">
                    Request for Missing Grades
                </button>

            </div>
        </form>

    </div>
</div>

<script>
    function open_request_grades() {
        document.getElementById("request_grades").classList.remove("hidden");
    }

    function close_modal() {
        document.getElementById('request_grades').classList.add('hidden');
    }
</script>
