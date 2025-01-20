<!-- COR Modal -->
<div id="corModal"
    class="hidden fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center z-50 transition-opacity duration-300 ease-in-out">
    <div
        class="modal-container bg-white w-full sm:w-[80%] md:w-[80%] lg:w-[80%] max-w-full h-[92vh] max-h-[92vh] rounded-lg shadow-2xl p-12 py-8 relative overflow-y-auto">

        <!-- Close Button -->
        <button onclick=closeUpdateStudentModal() class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>


        {{-- Page 1  --}}
        <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b border-gray-300">Certificate of Registration</h3>

        <div class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="overflow-hidden bg-white p-16 rounded-lg shadow-2xl mt-2 border border-gray-300"
                style="width: 210mm; height: 297mm; overflow: hidden;">
                <div class="flex items-center justify-center mb-5">
                    <img src="{{ Vite::asset('resources/assets/cvsulogo.png') }}" alt="University Logo"
                        class="h-10 mr-4">
                    <div class="flex flex-col h-auto">
                        <p class="m-0 p-0 text-center">Cavite State University</p>
                        <p class="text-center text-sm">Bacoor City Campus</p>
                        <p class="text-center text-base font-semibold">REGISTRATION FORM</p>
                    </div>
                </div>
                <div class="border-b border-gray-200"></div>
                <table class="w-full border-collapse mb-0 border-none text-xs">
                    <tr>
                        <td class="border-none p-2">Student Number:<span class="font-medium" id="updatedStudentNumber">
                                {{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->student_number : '' }}</span>
                        </td>
                        <td class="border-none p-2">Semester: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->semester : '' }}</span>
                        </td>
                        <td class="border-none p-2">School Year: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->school_year_start : '' }}</span>
                        </td>
                        <td class="border-none p-2">Date: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->updated_at->format('F j, Y') : '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-none p-2">Name: <span class="font-medium">
                                {{ $student->last_name ? $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name : '' }}
                            </span></td>


                        <td class="border-none p-2">Year: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->year_level : '' }}</span>
                        </td>
                        <td class="border-none p-2">Program: <span
                                class="font-medium">{{ $student->program ? $student->program->title : '' }}</span></td>

                        <td class="border-none p-2">Major: <span
                                class="font-medium">{{ $student->program->major ?? 'N/A' }}</span></td>
                    </tr>
                    <tr>
                        <td class="border-none p-2">Address: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->updated_at->format('F j, Y') : '' }}</span>
                        </td>
                        <td class="border-none p-2">Section: <span class="font-medium">{BSCS 3-2}</span></td>
                        <td class="border-none p-2">Encoder: <span
                                class="font-medium">{{ $student->enrollment()->latest()->first() ? $student->enrollment()->latest()->first()->registrar_encoder_id : '' }}</span>
                        </td>
                    </tr>
                </table>

                <table class="w-full border-collapse mt-4">
                    <thead>
                        <tr class="bg-gray-200 text-xs">
                            <th class="border border-gray-400 p-2">Course Code</th>
                            <th class="border border-gray-400 p-2">Course Title</th>
                            <th class="border border-gray-400 p-2">Units</th>
                            <th class="border border-gray-400 p-2">Time</th>
                            <th class="border border-gray-400 p-2">Day</th>
                            <th class="border border-gray-400 p-2">Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student->checklist as $checklistItem)
                            <tr class="text-xs">
                                <td class="border border-gray-400 p-2">
                                    {{ $checklistItem->course_code ?? 'N/A' }}
                                </td>
                                <td class="border border-gray-400 p-2">
                                    {{ $checklistItem->course->course_title ?? 'N/A' }}
                                </td>



                                <td class="border border-gray-400 p-2">
                                    {{-- {{ $student->course->credit_unit_lecture ?? 'N/A' }} +
                                {{ $student->course->credit_unit_laboratory ?? 'N/A' }} --}}
                                </td>

                                <td class="border border-gray-400 p-2">TBA</td>
                                <td class="border border-gray-400 p-2">TBA</td>
                                <td class="border border-gray-400 p-2">TBA</td>
                        @endforeach

                        </tr>
                    </tbody>
                </table>

                <table class="w-full border-collapse mt-6 text-xs">
                    <tr class="bg-gray-200 text-xs">
                        <th class="border border-gray-400 p-2">Laboratory Fees</th>
                        <th class="border border-gray-400 p-2">Other Fees</th>
                        <th class="border border-gray-400 p-2">Assessment</th>
                        <th class="border border-gray-400 p-2">Totals<br></th>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2">
                            Com. Lab: <span class="font-medium text-right">&#8369; ---</span>
                        </td>
                        <td class="border border-gray-400 p-2">
                            NSTP: <span class="font-medium text-right">&#8369; -</span><br>
                            Reg Fee: <span class="font-medium text-right">&#8369; 55.00</span><br>
                            ID: <span class="font-medium text-right">&#8369; -</span><br>
                            Late Reg.: <span class="font-medium text-right"> -</span><br>
                            Insurance: <span class="font-medium text-right">&#8369; 25.00</span><br>
                        </td>
                        <td class="border border-gray-400 p-2">
                            Tuition Fee: <span class="font-medium text-right">&#8369; 5000.00</span><br>
                            SFDF: <span class="font-medium text-right">&#8369; 1500.00</span><br>
                            SRF: <span class="font-medium text-right">&#8369; 2025.00</span><br>
                            Misc.: <span class="font-medium text-right">&#8369; 435.00</span><br>
                            Athletics: <span class="font-medium text-right">&#8369; 100.00</span><br>
                            SCUAA: <span class="font-medium text-right">&#8369; 100.00</span><br>
                            Library Fee: <span class="font-medium text-right">&#8369; 50.00</span><br>
                            Lab Fees: <span class="font-medium text-right">&#8369; 800.00</span><br>
                            Other Fees: <span class="font-medium text-right">&#8369; 80.00</span>
                        </td>
                        <td class="border border-gray-400 p-2">
                            Total Units: <span class="font-medium text-right"></span><br>
                            <hr>
                            Total Hours: <span class="font-medium text-right"></span><br>
                            <hr>
                            <span class="font-medium text-right">TOTAL AMOUNT: &#8369; 10,090.00</span><br><br>
                            Scholarship: <span class="font-medium text-right">CHED Free Tuition and Misc. Fee</span><br>
                            <hr>
                            Terms of Payment:<br>
                            <div class="pl-2">
                                First: <span class="font-medium text-right">&#8369; 10,090.00</span><br>
                                Second: <span class="font-medium text-right">-</span><br>
                                Third: <span class="font-medium text-right">-</span>
                            </div>
                        </td>
                    </tr>
                </table>

                <p class="text-sm mt-2 italic"><span class="font-medium">NOTE:</span> Your slots on the above subjects
                    will be
                    confirmed only upon payment.</p>

                <div class="mt-8 text-left pb-4 text-sm">
                    Registration Status: <span class="font-medium">{{ $student->classification }}</span><br>
                    Date of Birth: <span class="font-medium">{{ $student->birthday->format('F j, Y') }}</span><br>
                    Sex: <span class="font-medium">{{ ucfirst($student->sex) }}</span><br>
                    Contact Number: <span class="font-medium">{{ $student->contact_number }}</span><br>
                    E-mail Address: <span class="font-medium">{{ $student->user->email }}</span><br>
                    <p>Student's Signature: __________________________</p>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Function to open the COR modal
        function openCORMOdal() {
            const corModal = document.getElementById('corModal');
            corModal.classList.remove('hidden'); // Show the COR modal
        }

        // Function to close the COR modal
        function closeUpdateStudentModal() {
            const corModal = document.getElementById('corModal');
            corModal.classList.add('hidden'); // Hide the COR modal
        }
    </script>
