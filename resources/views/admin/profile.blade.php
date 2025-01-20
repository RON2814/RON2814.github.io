<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        border: none;
        outline: none;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        display: flex;
        height: 100vh;
        background: #ebe9e9;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 20%;
        height: 100%;
        padding: 1.7rem;
        color: #fff;
        background: #0A6847;
        overflow: hidden;
        transition: all 0.3s linear;
    }

    .logo {
        height: 80px;
        padding: 16px;
        text-align: center;
    }

    .menu {
        height: 88%;
        position: relative;
        list-style: none;
        padding: 0;
    }

    .menu li {
        padding: 1rem;
        margin: 8px 0;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .menu li:hover,
    .active {
        background: rgba(224, 224, 224, 0.35);
    }

    .menu li a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;

    }

    .menu li a i {
        margin-right: 10px;
    }

    .menu li a:hover {
        text-decoration: underline;
    }


    .menu a {
        color: #fff;
        font-size: 14px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 1.5rem;


    }

    .menu a span {
        overflow: hidden;
        font-size: 0.8rem;
        display: flex;
        /* Ensure the span is part of the flexbox layout */
        align-items: center;
        /* Vertically align the text */
    }

    .menu a i {
        font-size: 1.2rem;
    }


    .logout {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
    }



    .submenu {
        position: relative;
    }

    .submenu .submenu-list {
        display: none;
        padding-left: 20px;
        /* Indent the submenu items */
        list-style: none;
    }

    .submenu.open .submenu-list {
        display: block;
    }

    .submenu-list li {
        padding: 1rem;
        margin: 8px 0;

        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .submenu-list li:hover {
        background: rgba(224, 224, 224, 0.35);
    }

    .submenu .submenu-icon {
        margin-left: auto;
        transition: transform 0.1s;
    }

    .submenu.open .submenu-icon {
        transform: rotate(180deg);
    }


    /* main body section */
    .main-content {
        margin-left: 20%;
        padding: 1rem;
        width: 80%;
        background: #ebe9e9;
    }

    .header-wrapper img {
        width: 50px;
        height: px;
        cursor: pointer;
        border-radius: 50%;

    }

    .header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        background: #fff;
        border-radius: 10px;
        padding: 10px 2rem;
        margin-bottom: 1rem;
    }

    .header-title {
        color: rgb(39, 152, 75);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1;
    }

    .search-box {
        background: rgb(237, 237, 237);
        border-radius: 15px;
        color: rgba(113, 99, 186, 255);
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
    }

    .search-box input {
        background: transparent;
        padding: 10px;
    }

    .search-box i {
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.5s ease-out;
    }

    .search-box i:hover {
        transform: scale(1.2);
    }

    /* card container  */
    .card-container {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-wrapper {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1rem;
    }

    .main-title {
        color: rgba(113, 99, 186, 255);
        padding-bottom: 10px;
        font-size: 18px;
        font-weight: bold;
    }

    .item-card {
        background: rgba(229, 223, 223);
        border-radius: 10px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 160px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .item-card:hover {
        transform: translateY(-4px);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-detail {
        padding-bottom: 10px;
    }

    .total {
        display: flex;
        flex-direction: column;
    }

    .title {
        font-size: 14px;
        font-weight: 300;
        color: rgba(0, 0, 0, 0.7);
    }

    .total-value {
        font-size: 26px;
        font-family: 'Poppins', monospace;
        font-weight: 600;
    }

    .icon {
        color: #fff;
        padding: 1.2rem;
        height: 60px;
        width: 60px;
        text-align: center;
        border-radius: 50%;
        font-size: 1.6rem;
        background: red;
    }

    /* color css */
    .light-red {
        background: rgb(254, 226, 254);
    }

    .light-purple {
        background: rgb(230, 204, 255);
    }

    .light-green {
        background: rgb(204, 255, 204);
    }

    .light-blue {
        background: rgb(173, 216, 230);
    }

    .dark-red {
        background: rgb(139, 0, 0);
    }

    .dark-purple {
        background: rgb(128, 0, 128);
    }

    .dark-green {
        background: rgb(0, 100, 0);
    }

    .dark-blue {
        background: rgb(0, 0, 139);
    }

    /* Dropdown styles */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-button {
        background-color: #fff;
        color: #333;
        border: 1px solid #ccc;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 5px;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .dropdown-button i {
        margin-left: 8px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
        top: 100%;
        right: 0;
        border-radius: 8px;
        padding: 10px 0;
    }

    .dropdown-content a,
    .dropdown-content button {
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        color: #333;
        font-size: 14px;
        background-color: transparent;
        border: none;
        text-align: left;
        width: 100%;
    }

    .dropdown-content a:hover,
    .dropdown-content button:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropdown-button {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo">
            <h2>CvSU-B</h2>
        </div>
        <ul class="menu">
            <li class="active"><a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li><a href="#">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="submenu">
                <a href="#" id="manage-users-toggle">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                    <i class="fas fa-chevron-down submenu-icon"></i>
                </a>
                <ul class="submenu-list">
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i><span>Student</span></a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i><span>Registrar</span></a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i><span>Department</span></a></li>
                    <li><a href="#"><i class="fa-solid fa-chevron-right"></i><span>Admin</span></a></li>
                </ul>
            </li>

            <li class="logout">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>


    <!-- main-content -->
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <span>Primary</span>
                <h2>Dashboard</h2>
            </div>

            <div class="user-info">
                <div class="dropdown">
                    <button class="dropdown-button">
                        <span id="username">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>

                    <div class="dropdown-content">
                        <a href="{{ route('profile.edit') }}">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-link">Log Out</button>
                        </form>
                    </div>
                </div>
                {{-- <img src="./rai.png" alt="User Image" class="user-img"> --}}
            </div>

        </div>

        <div class="card-container">
            {{-- <h3 class="main-title">Admin Data</h3> --}}
            
        </div>

        <div class="bg-white mt-6 rounded-lg shadow-md p-8">
            {{-- <h3 class="text-2xl font-bold text-gray-800 mb-4">Active Users</h3> --}}
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto border-collapse border border-gray-200 rounded-lg">
                    <thead class="bg-[#0A6847] q text-white text-sm uppercase tracking-wide">
                        <tr>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-left">Role</th>
                            <th class="py-3 px-6 text-left">Created At</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 divide-y divide-gray-200">
                  
                            <tr class="hover:bg-gray-100 transition-colors">
                                <td class="py-4 px-6 text-sm"></td>
                                <td class="py-4 px-6 text-sm"></td>
                                <td class="py-4 px-6 text-sm"></td>
                                <td class="py-4 px-6 text-sm"></td>
                            </tr>
              
                    </tbody>
                </table>
            </div>
        </div>
        

        </div>



    </div>


</body>
<script>
   document.addEventListener('DOMContentLoaded', () => {
    // Handle submenu toggle
    document.getElementById('manage-users-toggle').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent default behavior of anchor
        const parentLi = this.closest('.submenu'); // Find the parent <li> element
        parentLi.classList.toggle('open'); // Toggle the class to show or hide the submenu
    });

    // Manage the 'active' class for sidebar items
    const menuItems = document.querySelectorAll('.menu li'); // Select all menu items

    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            // Remove the 'active' class from all menu items
            menuItems.forEach(menuItem => menuItem.classList.remove('active'));

            // Add the 'active' class to the clicked item
            this.classList.add('active');
        });
    });
});
</script>

</html>
