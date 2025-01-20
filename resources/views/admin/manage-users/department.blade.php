<x-app-layout>
  {{-- main content  --}}
  <div class="main-content p-16 py-0 bg-[#ebe9e9]">
    <div class="bg-white mt-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <div class="flex items-center justify-between mb-5">
        <h3 class="text-2xl font-semibold text-gray-900">Department - Registration Advisers</h3>

        <!-- Search and Filter Section -->
        <div class="flex space-x-4">
          <!-- Search Bar -->
          <input type="text" placeholder="Search..." id="searchBar"
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
          <!-- Filter Dropdown -->
          <select id="programFilter"
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="all" selected disabled class="text-gray-600">Filter by Program</option>
            <option value="all">All</option>
            <option value="1">Computer Science</option>
            <option value="2">Information Technology</option>
          </select>
          <!-- Add New Button -->
          <button onclick="openAddAdviserModal()"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add New Advisers
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
              <th class="py-3 px-4 text-left font-medium">Program</th>
              <th class="py-3 px-4 text-left font-medium">Action</th>
            </tr>
          </thead>
          <tbody id="departmentTableBody" class="text-gray-700">
            @foreach ($departments as $dept)
              <tr class="hover:bg-gray-100 transition-colors duration-200">
                <td class="py-4 px-4 ">{{ $dept->department_id }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->last_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->first_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->middle_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->contact_number }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->user->email }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $dept->program->title }}</td>
                <td class="py-4 px-4 text-sm">
                  <div class="flex items-center">
                    <button onclick="openUpdateAdviserModal({{ $dept }})"
                      class="text-blue-500 hover:text-blue-700">
                      <i class="fas fa-edit"></i> <!-- Update icon -->
                    </button>
                    <button onclick="deleteDept('{{ $dept->department_id }}')"
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
  @include('modals.manage-users.add-department')
  @include('modals.manage-users.update-department')

  <script>
    // Debounce function to limit the rate of AJAX calls
    function debounce(func, delay) {
      let timeout;
      return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
      };
    }

    // Function to fetch and display departments based on search and filter
    function fetchDepartments() {
      const searchQuery = document.getElementById('searchBar').value.trim();
      const programId = document.getElementById('programFilter').value;

      let url = `{{ route('admin.manageUsers.search-department') }}?query=${encodeURIComponent(searchQuery)}`;

      if (programId && programId !== 'all') {
        url += `&program_id=${encodeURIComponent(programId)}`;
      }

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
          const tbody = document.getElementById('departmentTableBody');
          tbody.innerHTML = ''; // Clear existing table rows

          if (data.length === 0) {
            tbody.innerHTML = `
            <tr>
              <td colspan="9" class="py-4 px-4 text-center text-sm text-gray-500">No departments found.</td>
            </tr>
          `;
            return;
          }

          data.forEach(dept => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-100');

            const email = dept.user?.email || '';
            const programTitle = dept.program?.title || '';

            row.innerHTML = `
            <td class="py-4 px-4 text-sm">${dept.department_id}</td>
            <td class="py-4 px-4 text-sm">${dept.last_name}</td>
            <td class="py-4 px-4 text-sm">${dept.first_name}</td>
            <td class="py-4 px-4 text-sm">${dept.middle_name || ''}</td>
            <td class="py-4 px-4 text-sm">${dept.contact_number}</td>
            <td class="py-4 px-4 text-sm">${email}</td>
            <td class="py-4 px-4 text-sm">${programTitle}</td>
            <td class="py-4 px-4 text-sm">
              <button
                onclick='openUpdateAdviserModal(${JSON.stringify(dept).replace(/'/g, "\\'")})'
                class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="deleteDept('${dept.department_number}')"
                class="ml-4 text-red-500 hover:text-red-700">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          `;
            tbody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error fetching departments:', error);
          alert('An error occurred while fetching departments.');
        });
    }

    // Event listeners for search and filter
    document.getElementById('searchBar').addEventListener('input', debounce(fetchDepartments, 300));
    document.getElementById('programFilter').addEventListener('change', fetchDepartments);

    function toggleDropdown() {
      const dropdownContent = document.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('hidden');
    }

    function deleteDept(deptId) {
      Swal.fire({
        title: 'Are you sure?',
        html: `<span style="user-select: none;">Type "${deptId}" to confirm deletion.</span>`,
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: (input) => {
          if (input !== deptId) {
            Swal.showValidationMessage(`Input does not match.`);
            return false;
          }
          return true;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`{{ url('/admin/manage-users/department/destroy') }}/${deptId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
              },
            })
            .then(response => {
              if (!response.ok) {
                if (response.status === 404) {
                  throw new Error('Dept not found.');
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
                // Remove the dept's row from the table
                const row = document.querySelector(`button[onclick="deleteDept('${deptId}')"]`).closest(
                  'tr');
                row.remove();
                Swal.fire('Deleted!', data.message, 'success');
              } else {
                Swal.fire('Error!', 'Failed to delete dept.', 'error');
              }
            })
            .catch(error => {
              console.error('Error deleting dept:', error);
              Swal.fire('Error!', error.message || 'An error occurred while deleting the dept.', 'error');
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
