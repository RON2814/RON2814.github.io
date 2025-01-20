<x-app-layout>
  {{-- main content  --}}
  <div class="main-content p-16 py-0 bg-[#ebe9e9]">
    <div class="bg-white mt-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 p-8">
      <div class="flex items-center justify-between mb-5">
        <h3 class="text-2xl font-semibold text-gray-900">Registrar Table</h3>

        <!-- Search and Filter Section -->
        <div class="flex space-x-4">
          <!-- Search Bar -->
          <input type="text" placeholder="Search..." id="searchBar"
            class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
          <!-- Add New Button -->
          <button onclick="openAddRegistrarModal()"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add New Registrars
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
          <tbody id="registrarTableBody" class="text-gray-700">
            @foreach ($registrars as $registrar)
              <tr class="hover:bg-gray-100 transition-colors duration-200">
                <td class="py-4 px-4 ">{{ $registrar->registrar_id }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $registrar->last_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $registrar->first_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $registrar->middle_name }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $registrar->contact_number }}</td>
                <td class="py-4 px-4 text-sm  max-w-xs">{{ $registrar->user->email }}</td>
                <td class="py-4 px-4 text-sm">
                  <div class="flex items-center">
                    <button onclick="openUpdateRegistrarModal({{ $registrar }})"
                      class="text-blue-500 hover:text-blue-700">
                      <i class="fas fa-edit"></i> <!-- Update icon -->
                    </button>
                    <button onclick="deleteRegistrar('{{ $registrar->registrar_id }}')"
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
  @include('modals.manage-users.add-registrar')
  @include('modals.manage-users.update-registrar')

  <script>
    // Debounce function to limit the rate of AJAX calls
    function debounce(func, delay) {
      let timeout;
      return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
      };
    }

    // Function to fetch and display registrars based on search and filter
    function fetchRegistrars() {
      const searchQuery = document.getElementById('searchBar').value.trim();

      let url = `{{ route('admin.manageUsers.search-registrar') }}?query=${encodeURIComponent(searchQuery)}`;

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
          const tbody = document.getElementById('registrarTableBody');
          tbody.innerHTML = ''; // Clear existing table rows

          if (data.length === 0) {
            tbody.innerHTML = `
            <tr>
              <td colspan="9" class="py-4 px-4 text-center text-sm text-gray-500">No registrars found.</td>
            </tr>
          `;
            return;
          }

          data.forEach(registrar => {
            const row = document.createElement('tr');
            row.classList.add('hover:bg-gray-100');

            const email = registrar.user?.email || '';

            row.innerHTML = `
            <td class="py-4 px-4 text-sm">${registrar.registrar_id}</td>
            <td class="py-4 px-4 text-sm">${registrar.last_name}</td>
            <td class="py-4 px-4 text-sm">${registrar.first_name}</td>
            <td class="py-4 px-4 text-sm">${registrar.middle_name || ''}</td>
            <td class="py-4 px-4 text-sm">${registrar.contact_number}</td>
            <td class="py-4 px-4 text-sm">${email}</td>
            <td class="py-4 px-4 text-sm">
              <button
                onclick='openUpdateRegistrarModal(${JSON.stringify(registrar).replace(/'/g, "\\'")})'
                class="text-blue-500 hover:text-blue-700">
                <i class="fas fa-edit"></i>
              </button>
              <button onclick="deleteRegistrar('${registrar.registrar_number}')"
                class="ml-4 text-red-500 hover:text-red-700">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>
          `;
            tbody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error fetching registrars:', error);
          alert('An error occurred while fetching registrars.');
        });
    }

    // Event listeners for search and filter
    document.getElementById('searchBar').addEventListener('input', debounce(fetchRegistrars, 300));

    function toggleDropdown() {
      const dropdownContent = document.querySelector('.dropdown-content');
      dropdownContent.classList.toggle('hidden');
    }

    function deleteRegistrar(registrarId) {
      Swal.fire({
        title: 'Are you sure?',
        html: `<span style="user-select: none;">Type "${registrarId}" to confirm deletion.</span>`,
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: (input) => {
          if (input !== registrarId) {
            Swal.showValidationMessage(`Input does not match.`);
            return false;
          }
          return true;
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`{{ url('/admin/manage-users/registrar/destroy') }}/${registrarId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
              },
            })
            .then(response => {
              if (!response.ok) {
                if (response.status === 404) {
                  throw new Error('Registrar not found.');
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
                // Remove the registrar's row from the table
                const row = document.querySelector(`button[onclick="deleteRegistrar('${registrarId}')"]`).closest(
                  'tr');
                row.remove();
                Swal.fire('Deleted!', data.message, 'success');
              } else {
                Swal.fire('Error!', 'Failed to delete registrar.', 'error');
              }
            })
            .catch(error => {
              console.error('Error deleting registrar:', error);
              Swal.fire('Error!', error.message || 'An error occurred while deleting the registrar.', 'error');
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
