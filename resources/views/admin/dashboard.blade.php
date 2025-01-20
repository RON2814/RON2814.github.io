<x-app-layout>
  <!-- main-content -->
  <div class="main-content p-12 py-0 bg-[#ebe9e9]">

    <div class="card-container bg-white p-8 rounded-xl mt-4 shadow-md">
      <div class="card-wrapper grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Card 1: No. of Students -->
        <div
          class="item-card bg-[#fce2fe] rounded-lg p-6 flex flex-col justify-between h-[150px] shadow-md transition-all ease-in-out hover:transform hover:translate-y-[-4px]">
          <div class="card-header flex justify-between items-center mb-5">
            <div class="total flex flex-col">
              <span class="title text-sm font-light text-[#333]">No. of Students</span>
              <span class="total-value text-3xl font-semibold">{{ $users->where('role_id', 1)->count() }}</span>
            </div>
            <i class="fa-regular fa-user text-white bg-[#8b0000] p-4 h-16 w-16 text-center rounded-full text-xl"></i>
          </div>
          <span class="card-detail text-sm">Active students</span>
        </div>

        <!-- Card 2: No. of Registrars -->
        <div
          class="item-card bg-[#ccffe0] rounded-lg p-6 flex flex-col justify-between h-[150px] shadow-md transition-all ease-in-out hover:transform hover:translate-y-[-4px]">
          <div class="card-header flex justify-between items-center mb-5">
            <div class="total flex flex-col">
              <span class="title text-sm font-light text-[#333]">No. of Registrars</span>
              <span class="total-value text-3xl font-semibold">{{ $users->where('role_id', 3)->count() }}</span>
            </div>
            <i class="fa-regular fa-user text-white bg-[#006400] p-4 h-16 w-16 text-center rounded-full text-xl"></i>
          </div>
          <span class="card-detail text-sm">Active registrars</span>
        </div>

        <!-- Card 3: No. of Registration Advisers -->
        <div
          class="item-card bg-[#add8e6] rounded-lg p-6 flex flex-col justify-between h-[150px] shadow-md transition-all ease-in-out hover:transform hover:translate-y-[-4px]">
          <div class="card-header flex justify-between items-center mb-5">
            <div class="total flex flex-col">
              <span class="title text-sm font-light text-[#333]">No. of Registration Advisers</span>
              <span class="total-value text-3xl font-semibold">{{ $users->where('role_id', 2)->count() }}</span>
            </div>
            <i class="fa-regular fa-user text-white bg-[#00008b] p-4 h-16 w-16 text-center rounded-full text-xl"></i>
          </div>
          <span class="card-detail text-sm">Active department faculty advisers</span>
        </div>
      </div>
    </div>

    <div class="bg-white mt-5 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-2xl font-semibold text-gray-900 border-b border-gray-200">Active Users</h3>
        <!-- Search Bar -->
        <input type="text" placeholder="Search..."
          class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />

      </div>

      <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-auto border-separate border-spacing-0">
          <thead class="bg-[#0A6847] text-white text-sm uppercase tracking-wide">
            <tr>
              <th class="py-3 px-6 text-left font-medium">Name</th>
              <th class="py-3 px-6 text-left font-medium">Email</th>
              <th class="py-3 px-6 text-left font-medium">Role</th>
              <th class="py-3 px-6 text-left font-medium">Created At</th>

            </tr>
          </thead>
          <tbody class="text-gray-700 divide-y divide-gray-200">
            @foreach ($users as $user)
              <tr class="hover:bg-gray-100 transition-colors duration-200">
                <td class="py-4 px-6 text-sm truncate max-w-xs">{{ $user->name }}</td>
                <td class="py-4 px-6 text-sm truncate max-w-xs">{{ $user->email }}</td>
                <td class="py-4 px-6 text-sm truncate max-w-xs">{{ $user->role->title }}</td>
                <td class="py-4 px-6 text-sm truncate max-w-xs">{{ $user->created_at->format('Y-m-d') }}
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
  <script>
    function toggleDropdown() {
      const dropdownContent = document.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('hidden');
    }
  </script>
</x-app-layout>
