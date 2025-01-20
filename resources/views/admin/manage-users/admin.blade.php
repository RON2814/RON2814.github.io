<x-app-layout>
  {{-- main content  --}}
  <div class="main-content p-16 py-0 bg-[#ebe9e9]">
    <div class="bg-white mt-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <div class="flex items-center justify-between mb-5">
        <h3 class="text-2xl font-semibold text-gray-900">Admin Table</h3>

        <!-- Search and Filter Section -->
        <div class="flex space-x-4">
          <!-- Search Bar -->
          <input type="text" placeholder="Search..." id="searchBar"
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
          <!-- Add New Button -->
          <button onclick="openAddAdminModal()"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add New Admins
          </button>
        </div>


      </div>
      <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-fixed border-separate border-spacing-0">
          <thead class="bg-[#0A6847] text-white text-sm">
            <tr>
              <th class="py-3 px-4 text-left font-medium">UserID</th>
              <th class="py-3 px-4 text-left font-medium">Last Name</th>
              <th class="py-3 px-4 text-left font-medium">First Name</th>
              <th class="py-3 px-4 text-left font-medium">Middle Name</th>
              <th class="py-3 px-4 text-left font-medium">Contact #</th>
              <th class="py-3 px-4 text-left font-medium">Email</th>
              <th class="py-3 px-4 text-left font-medium">Action</th>
            </tr>
          </thead>
          <tbody id="adminTableBody" class="text-gray-700">
            @foreach ($admins as $admin)
              <tr class="hover:bg-gray-100 transition-colors duration-200">
                <td class="py-4 px-4 ">{{ $admin->admin_id }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $admin->last_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $admin->first_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $admin->middle_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $admin->contact_number }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $admin->user->email }}</td>
                <td class="py-4 px-4 text-sm">
                  <div class="flex items-center">
                    <button onclick="openUpdateAdminModal({{ $admin }})"
                      class="text-blue-500 hover:text-blue-700">
                      <i class="fas fa-edit"></i> <!-- Update icon -->
                    </button>
                    <button onclick="deleteAdmin('{{ $admin->admin_id }}')"
                      class="ml-4 text-red-500 hover:text-red-700">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Include modals -->
  @include('modals.manage-users.add-admin')
  @include('modals.manage-users.update-admin')

  <script>
    // Debounce function to limit the rate of AJAX calls
    function debounce(func, delay) {
      let timeout;
      return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
      };
    }

    // Function to fetch and display admins based on search and filter
    function fetchAdmins() {
      const searchQuery = document.getElementById('searchBar').value.trim();

      let url = `{{ route('admin.manageUsers.search-admin') }}?query=${encodeURIComponent(searchQuery)}`;

      fetch(url, {
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }

          const contentType = response.headers.get('content-type');
          if (!contentType || !contentType.includes('application/json')) {
            throw new TypeError("Expected JSON, got " + contentType);
          }

          return response.json();
        })
        .then(data => {
          const tbody = document.getElementById('adminTableBody');
          tbody.innerHTML = ''; // Clear existing table rows

          if (data.length === 0) {
            tbody.innerHTML = `
            <tr>
              <td colspan="9" class="py-4 px-4 text-center text-sm text-gray-500">No admins found.</td>
            </tr>
          `;
            return;
          }

          data.forEach(admin => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-100');

            const email = admin.user?.email || '';

            row.innerHTML = `
            <td class="py-4 px-4 text-sm">${admin.admin_id}</td>
            <td class="py-4 px-4 text-sm">${admin.last_name}</td>
            <td class="py-4 px-4 text-sm">${admin.first_name}</td>
            <td class="py-4 px-4 text-sm">${admin.middle_name || ''}</td>
            <td class="py-4 px-4 text-sm">${admin.contact_number}</td>
            <td class="py-4 px-4 text-sm">${email}</td>
            <td class="py-4 px-4 text-sm">
              <button
                onclick='openUpdateAdminModal(${JSON.stringify(admin).replace(/'/g, "\\'")})'
                class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="deleteAdmin('${admin.admin_number}')"
                class="ml-4 text-red-500 hover:text-red-700">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          `;
            tbody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error fetching admins:', error);
          alert('An error occurred while fetching admins.');
        });
    }

    // Event listeners for search and filter
    document.getElementById('searchBar').addEventListener('input', debounce(fetchAdmins, 300));

    function toggleDropdown() {
      const dropdownContent = document.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('hidden');
    }

    function deleteAdmin(adminId) {
      Swal.fire({
        title: 'Are you sure?',
        html: `<span style="user-select: none;">Type "${adminId}" to confirm deletion.</span>`,
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: (input) => {
          if (input !== adminId) {
            Swal.showValidationMessage(`Input does not match.`);
            return false;
          }
          return true;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`{{ url('/admin/manage-users/admin/destroy') }}/${adminId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
              },
            })
            .then(response => {
              if (!response.ok) {
                if (response.status === 404) {
                  throw new Error('Admin not found.');
                }
                throw new Error('Network response was not ok');
              }

              const contentType = response.headers.get('content-type');
              if (!contentType || !contentType.includes('application/json')) {
                throw new TypeError("Expected JSON, got " + contentType);
              }

              return response.json();
            })
            .then(data => {
              if (data.success) {
                // Remove the admin's row from the table
                const row = document.querySelector(`button[onclick="deleteAdmin('${adminId}')"]`).closest(
                  'tr');
                row.remove();
                Swal.fire('Deleted!', data.message, 'success');
              } else {
                Swal.fire('Error!', 'Failed to delete admin.', 'error');
              }
            })
            .catch(error => {
              console.error('Error deleting admin:', error);
              Swal.fire('Error!', error.message || 'An error occurred while deleting the admin.', 'error');
            });
        }
      });
    }

    function toggleDropdown() {
      const dropdownContent = document.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('hidden');
    }
  </script>
</x-app-layout>
