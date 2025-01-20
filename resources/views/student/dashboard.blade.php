<x-app-layout>
    <!-- Main Content -->
    <div class="main-content p-12 py-6 bg-gray-200">
        <div class="container bg-white p-8 rounded-lg shadow-xl">
            <!-- Student Information -->
            <div class="bg-gray-200 p-4 rounded-lg mb-6 border">
                <p class="font-bold text-xl mb-1">{{ $student->student_number }}</p>
                <p class="text-lg mb-1">{{ $student->last_name }}, {{ $student->first_name }}
                    @if ($student->middle_name)
                        {{ $student->middle_name }}
                    @endif
                    @if ($student->extension_name)
                        {{ $student->extension_name }}
                    @endif
                </p>
                <p class="text-lg">{{ $student->program->description }}</p>
            </div>

            <!-- Truth | Excellence | Service -->
            <div class="text-center text-2xl font-bold my-8 ">
                <span class="text-green-700">TRUTH</span>
                <span class="text-gray-800"> | </span>
                <span class="text-yellow-500">EXCELLENCE</span>
                <span class="text-gray-800"> | </span>
                <span class="text-blue-500">SERVICE</span>
            </div>

            <!-- Mission and Vision Section -->
            <div class="flex flex-col md:flex-row gap-6 ">
                <!-- Mission -->
                <div class="bg-gray-200 p-6 rounded-lg md:w-1/2 border">
                    <h2 class="text-xl font-bold mb-4">MISSION</h2>
                    <p class="text-base leading-relaxed">
                        The Cavite State University shall provide excellent equitable and relevant educational
                        opportunities
                        in the arts, sciences and technology through quality instruction and responsive research and
                        development activities. It shall produce professional, skilled and morally upright individuals
                        for
                        global competitiveness.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-gray-200 p-6 rounded-lg md:w-1/2 border">
                    <h2 class="text-xl font-bold mb-4">VISION</h2>
                    <p class="text-base leading-relaxed">
                        The premier University in Historic Cavite recognized for excellence in the development of
                        globally
                        competitive and morally upright individuals.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
