<div id="successModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-50">
  <div class="bg-white p-6 rounded-lg w-96 shadow-lg">
      <div class="flex justify-center">
          <div class="animate-bounce">
              <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
          </div>
      </div>
      <h3 class="text-2xl font-semibold text-center text-green-600 mt-4">Successfully Enrolled</h3>
      <p class="text-center text-gray-600 mt-2">The student has been successfully enrolled.</p>
      <div class="flex justify-center mt-6">
          <button onclick="closeSuccessModal()" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
              Close
          </button>
      </div>
  </div>
</div>

