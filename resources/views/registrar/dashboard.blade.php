<x-app-layout>
    <div class="main-content p-8 py-0 bg-[#ebe9e9]">
        <div class="p-2 mt-2">
            <div class="flex flex-wrap gap-4 mt-2 justify-between">
                <!-- DCS Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#074799] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Total Students</h3>
                    <p class="mt-2 text-2xl font-bold">9</p>
                </div>

                <div
                    class="p-4 rounded-xl shadow-lg bg-[#FF9D23] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Pending Enrollment</h3>
                    <p class="mt-2 text-2xl font-bold">{}</p>
                </div>

                <!-- CS Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#C62E2E] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Computer Science</h3>
                    <p class="mt-2 text-2xl font-bold">5</p>
                </div>

                <!-- IT Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#118B50] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Information Technology</h3>
                    <p class="mt-2 text-2xl font-bold">4</p>
                </div>
            </div>
        </div>

        <div class="flex gap-6 mt-2">
            <!-- Schedule Enrollment for BSCS -->
            <div class="p-6 rounded-lg shadow mt-3 bg-white w-1/2">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-green-700 border-b border-gray-300">Schedule Enrollment for
                        BSCS</h2>
                </div>

                <!-- Date Input Fields -->
                <!-- Start Date -->
                <div class="flex-1 mb-4 sm:mb-0">
                    <label for="start-date" class="block text-sm font-medium text-gray-600 mb-1">Start</label>
                    <input id="start-date" type="datetime-local"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" />
                </div>

                <!-- Divider -->
                <div class="text-center text-gray-500 font-semibold sm:mx-4">TO</div>

                <!-- End Date -->
                <div class="flex-1 mb-4 sm:mb-0">
                    <label for="end-date" class="block text-sm font-medium text-gray-600 mb-1">End</label>
                    <input id="end-date" type="datetime-local"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" />
                </div>

                <!-- Post Button -->
                <div class="mt-6">
                    <button
                        class="w-full px-8 py-3 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400">
                        OPEN ENROLLMENT DATE
                    </button>
                </div>
            </div>

            <!-- Students Per Program -->
            <div class="p-6 rounded-lg shadow mt-3 bg-white w-1/2">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-green-700 border-b border-gray-300">Student Distribution by
                        Program</h2>
                </div>
                <div class="px-4 sm:px-8 md:px-16">
                    <canvas id="programChart" class="w-full"></canvas>
                </div>

            </div>
        </div>


    </div>
</x-app-layout>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Donut Chart for Program of Students
        const classificationCtx = document.getElementById('programChart').getContext('2d');
        new Chart(classificationCtx, {
            type: 'doughnut',
            data: {
                labels: ['Computer Science', 'Information Technology'],
                datasets: [{
                    label: 'Total Students',
                    data: [150, 50],
                    backgroundColor: ['#C62E2E', '#118B50'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Ensures the chart scales responsively
                cutoutPercentage: 50,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    });
</script>
