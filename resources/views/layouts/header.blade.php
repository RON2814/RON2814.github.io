 {{-- temp hehe  --}}
 {{-- header --}}
 <div class="header-wrapper flex justify-between items-center flex-wrap bg-white p-4 py-2">
  <div class="header-title pl-3 font-semibold text-[#206A5D]">
      <h2>Hello, {{ Auth::user()->name }}</h2>
  </div>

  <div class="user-info flex items-center gap-2">
      <div class="dropdown relative inline-block">
          <button
              class="dropdown-button bg-white text-[#333] border border-[#ccc] py-2 px-3 text-sm font-medium rounded-lg flex items-center cursor-pointer"
              onclick="toggleDropdown()">
              <span id="username">{{ Auth::user()->name }}</span>
              <i class="fas fa-chevron-down ml-2"></i>
          </button>

          <div
              class="dropdown-content absolute hidden bg-white min-w-[160px] shadow-lg z-10 top-full right-0 rounded-xl py-2">
              <a href="{{ route('profile.edit') }}"
                  class="block py-2 px-3 text-sm text-[#333] hover:bg-[#f1f1f1]">Profile</a>
              <form method="POST" action="{{ route('logout') }}" id="logout-form">
                  @csrf
                  <button type="submit"
                      class="w-full py-2 px-3 text-sm text-[#333] bg-transparent border-0 text-left hover:bg-[#f1f1f1]">Log
                      Out</button>
              </form>
          </div>
      </div>
  </div>
</div>