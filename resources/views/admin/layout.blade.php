<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Layout</title>
    <link href="{{ asset('assets/vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/boxicons-2.1.4/css/boxicons.min.css') }}">
    <script src="{{ asset('assets/vendor/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <style>
        /* Định dạng tổng thể */
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Header */
        .header {
            display: none;
            align-items: center;
            width: 100%;
            padding: 15px;
            background-color: #2b2b2b;
            color: white;
        }

        .header .toggle-btn {
            background: #2b2b2b;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.5em;
            margin-right: 15px;
        }

        .header .search-container {
            position: relative;
            flex: 1;
        }

        .header .search {
            width: 100%;
            padding: 5px 10px 5px 35px;
            border: none;
            border-radius: 5px;
        }

        .header .search-icon {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 1.2em;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2b2b2b;
            color: white;
            padding-top: 55px;
            transition: all 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar h2 {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar.collapsed h2,
        .sidebar.collapsed a span {
            display: none;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
            padding-left: 23px;
        }

        .sidebar i {
            font-size: 1.5em;
            margin-right: 10px;
        }

        .sidebar.collapsed i {
            margin-right: 0;
            text-align: center;
        }

        /* Nội dung chính */
        .content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
            width: 100%;
        }

        .sidebar.collapsed~.content {
            margin-left: 60px;
        }

        /* Responsive cho mobile */
        @media (max-width: 767px) {
            body {
                flex-direction: column;
            }

            .header {
                display: flex;
            }

            .sidebar {
                left: -250px;
                width: 250px;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }

        @media (min-width: 768px) {
            .header {
                display: none;
            }

            .toggle-btn {
                display: inline-block;
            }

            .search-container {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <button class="toggle-btn" onclick="toggleSidebar()"><i class="bx bx-menu"></i></button>
        <div class="search-container">
            <i class="bx bx-search search-icon"></i>
            <input type="search" placeholder="Search..." class="search" />
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <h2>Admin Panel</h2>
        <a href="#"><i class="bx bx-home"></i><span>Dashboard</span></a>
        <a href="#"><i class="bx bx-user"></i><span>Users</span></a>
        <a href="#"><i class="bx bx-cog"></i><span>Settings</span></a>
        <a href="#"><i class="bx bx-log-out"></i><span>Logout</span></a>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            let sidebar = document.getElementById("sidebar");
            let isMobile = window.innerWidth <= 767;

            if (isMobile) {
                sidebar.classList.toggle("show");
                document.body.classList.toggle("no-scroll");

                if (sidebar.classList.contains("show")) {
                    document.body.addEventListener("click", closeSidebarOutside, true);
                } else {
                    document.body.removeEventListener("click", closeSidebarOutside, true);
                }
            } else {
                sidebar.classList.toggle("collapsed");
            }
        }

        function closeSidebarOutside(event) {
            let sidebar = document.getElementById("sidebar");
            let toggleBtn = document.querySelector(".toggle-btn");

            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove("show");
                document.body.removeEventListener("click", closeSidebarOutside, true);
            }
        }
    </script>
</body>

</html>
