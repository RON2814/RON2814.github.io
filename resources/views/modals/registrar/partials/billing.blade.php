<h3 class="text-base font-semibold mt-2 mb-4 border-b border-gray-300">Billing Information:</h3>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Left Column -->
    <div>
        <!-- Laboratory Fees Section -->
        <div class="bg-white p-4 mb-4 rounded-lg shadow-md text-sm border border-gray-300">
            <!-- Smaller padding and text size -->
            <h2 class="text-base font-semibold text-gray-700 mb-3 border-b border-gray-300 bg-gray-200">
                Laboratory Fees
            </h2>
            <!-- Smaller heading -->
            <div class="space-y-2">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">ComLab:</span>
                    <span>₱800.00</span>
                </div>
            </div>
        </div>

        <!-- Other Fees Section -->
        <div class="bg-white p-4 mb-4 rounded-lg shadow-md text-sm border border-gray-300">
            <h2 class="text-base font-semibold text-gray-700 mb-3 border-b border-gray-300 bg-gray-200">
                Other Fees</h2>
            <div class="space-y-2">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">NSTP:</span>
                    <span>...</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Reg. Fee:</span>
                    <span>₱55.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">ID:</span>
                    <span>...</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Late Reg.:</span>
                    <span>...</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Insurance:</span>
                    <span>₱25.00</span>
                </div>
            </div>
        </div>

        <!-- Total Summary Section (unchanged) -->
        <div class="bg-white p-4 mb-4 rounded-lg shadow-md text-sm border border-gray-300">
            <h2 class="text-base font-semibold text-gray-700 mb-4 border-b border-gray-300 bg-gray-200">
                Total Summary</h2>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600">Total Units:</span>
                    <span>{total units}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600">Total Hours:</span>
                    <span>{total hours}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600">Total Amount:</span>
                    <span>₱8,290.00</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div>
        <!-- Assessment Section -->
        <div class="bg-white p-4 mb-4 rounded-lg shadow-md text-sm border border-gray-300">
            <h2 class="text-base font-semibold text-gray-700 mb-3 border-b border-gray-300 bg-gray-200">
                Assessment</h2>
            <div class="space-y-2">
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Tuition Fee:</span>
                    <span>₱3,200.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">SFDF:</span>
                    <span>₱1,500.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">SRF:</span>
                    <span>₱2,025.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Misc.:</span>
                    <span>₱435.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Athletics:</span>
                    <span>₱100.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">SCUAA:</span>
                    <span>₱100.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Library Fee:</span>
                    <span>₱50.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Lab Fees:</span>
                    <span>₱800.00</span>
                </div>
                <div class="flex justify-between border-b pb-1">
                    <span class="font-medium text-gray-600">Other Fees:</span>
                    <span>₱80.00</span>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="bg-white p-4 mb-4 rounded-lg shadow-md text-sm border border-gray-300">
            <h2 class="text-base font-semibold text-gray-700 mb-4 border-b border-gray-300 bg-gray-200">
                Payment</h2>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600">Total Amount:</span>
                    <span>₱8,290.00</span>
                </div>

                <!-- Received Money Section -->
                <div id="receivedMoneyDiv" class="flex justify-between border-b pb-2">
                    <label for="receivedMoney" class="font-semibold text-gray-600">Received Money:</label>
                    <input type="number" id="receivedMoney" name="receivedMoney"
                        class="border border-gray-300 rounded px-2 py-2 text-gray-600" placeholder="Enter amount">
                </div>

                <!-- Change Section -->
                <div id="changeDiv" class="flex justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600">Change:</span>
                    <span>0</span>
                </div>

                <div class="mt-4 bg-green-300 p-2">
                    <label>
                        <input type="checkbox" class="mr-2" id="applyFreeTuition" onclick="togglePaymentFields()">
                        Apply CHED FREE TUITION and Misc FEE
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
