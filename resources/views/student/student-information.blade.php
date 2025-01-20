<x-app-layout>

    {{-- main content --}}
    <div class="main-content p-16 py-2 bg-[#ebe9e9]">
        {{-- Student Information Section --}}
        <div class="bg-white p-8 rounded-lg shadow-xl mt-2">
            <h2 class="text-2xl font-medium border-b border-gray-300 text-gray-800 mb-5">Student Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Student Number</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ $student->student_number }}
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Student Name</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->last_name ?? '') }}, {{ strtoupper($student->first_name ?? '') }}
                        {{ strtoupper($student->middle_name ?? '') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1"
                        for="classification">Classification</label>
                    <div id="classification"
                        class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm font-semibold">
                        {{ strtoupper($student->classification ?? 'N/A') }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Section</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                       {3-2} 
                    </div>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Program</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ $student->program ? $student->program->title : '' }}
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Major</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->major ?? 'N/A') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Year Level</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->year_level : 'No Enrollment' }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Semester</label>
                    <div class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->semester : 'No Enrollment' }}
                    </div>
                </div>


            </div>
            {{-- <div class="boder-b border-gray-300 mt-8"></div>
            <h2 class="text-2xl font-medium border-b border-gray-300 text-gray-800 mb-6">Personal Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="house_number">House Number</label>
                    <div id="house_number" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->house_number ?? 'N/A') }} 
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="street">Street</label>
                    <div id="street" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->street ?? '') }} 
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="barangay">Barangay</label>
                    <div id="barangay" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->barangay ?? '') }} 
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="municipality">Municipality</label>
                    <div id="municipality" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->city ?? '') }} 
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="province">Province</label>
                    <div id="province" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->province ?? '') }} 
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="date_of_birth">Date of
                        Birth</label>
                    <div id="date_of_birth" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper(\Carbon\Carbon::parse($student->birthday ?? '')->format('F d, Y')) }}
                    </div>

                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="sex">Sex</label>
                    <div id="sex" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->sex ?? '') }} 
                    </div>
                </div>
            </div> --}}

        </div>


        {{-- Personal Information Section --}}
        <div class="bg-white p-8 rounded-lg shadow-2xl mt-6">
            <h2 class="text-2xl font-medium border-b border-gray-300 text-gray-800 mb-6">Personal Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="house_number">House Number</label>
                    <div id="house_number" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->house_number ?? 'N/A') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="street">Street</label>
                    <div id="street" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->street ?? '') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="barangay">Barangay</label>
                    <div id="barangay" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->barangay ?? '') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="municipality">Municipality</label>
                    <div id="municipality" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->city ?? '') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="province">Province</label>
                    <div id="province" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->address->province ?? '') }}
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="date_of_birth">Date of
                        Birth</label>
                    <div id="date_of_birth" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper(\Carbon\Carbon::parse($student->birthday ?? '')->format('F d, Y')) }}
                    </div>

                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1" for="sex">Sex</label>
                    <div id="sex" class="w-full px-4 py-1 rounded-md bg-gray-100 text-gray-700 text-sm">
                        {{ strtoupper($student->sex ?? '') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
