<x-app-layout>
    {{-- main content --}}
    <div class="main-content p-16 py-2 bg-[#ebe9e9]">
        <div class="p-2 mt-2">
            <div class="flex flex-wrap gap-4 mt-2 justify-between">
                <!-- DCS Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#074799] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Total DCS Students</h3>
                    <p class="mt-2 text-2xl font-bold">{total}</p>
                </div>


                <!-- CS Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#C62E2E] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Computer Science</h3>
                    <p class="mt-2 text-2xl font-bold">{cs}</p>
                </div>

                <!-- IT Students -->
                <div
                    class="p-4 rounded-xl shadow-lg bg-[#118B50] opacity-90 text-white flex flex-col items-center flex-1 sm:min-w-[48%] md:min-w-[23%]">
                    <h3 class="mt-2 text-lg font-semibold">Information Technology</h3>
                    <p class="mt-2 text-2xl font-bold">{it}</p>
                </div>
            </div>
        </div>

        <div class="flex gap-6 mt-2">
            <!-- Chart of Students (BSCS and IT) -->
            <div class="p-6 rounded-lg shadow mt-3 bg-white w-1/2">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-green-700 border-b border-gray-300">Bar Chart of Student </h2>
                </div>
                <div>
                <canvas id="studentsChart" width="200" height="150" class='mt-8'></canvas>
            </div>
            </div>

            <!-- Students Per Program -->
            <div class="p-6 rounded-lg shadow mt-3 bg-white w-1/2">
                <!-- Header -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-green-700 border-b border-gray-300">Student Distribution by Program</h2>
                </div>
                <div class="px-4 sm:px-8 md:px-16">
                    <canvas id="programChart" class="w-full"></canvas>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Students Chart
            const studentsCtx = document.getElementById('studentsChart').getContext('2d');
            new Chart(studentsCtx, {
                type: 'bar',
                data: {
                    labels: ['BSCS', 'IT'],
                    datasets: [{
                        label: 'Number of Students',
                        data: [120, 80], // Example data
                        backgroundColor: ['#C62E2E', '#118B50'],
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            enabled: false
                        },
                        legend: {
                            position: 'bottom'
                        },

                    }
                }
            });


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

</x-app-layout>
