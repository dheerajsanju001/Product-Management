<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
    <style>
        /* General layout styles */
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #ddd;
            overflow-y: auto;
            z-index: 1000;
        }

        /* Navbar styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 250px; /* Offset by the sidebar width */
            width: calc(100% - 250px);
            height: 56px;
            /* background-color: #333; */
            color: white;
            z-index: 1000;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px; /* Adjust for sidebar width */
            margin-top: 56px;  /* Adjust for navbar height */
            padding: 20px;
            height: calc(100vh - 56px); /* Full height minus navbar height */
            overflow-y: auto;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .navbar {
                left: 200px;
                width: calc(100% - 200px);
            }
            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                position: absolute;
                width: 100%;
                height: auto;
                top: 56px;
            }
            .navbar {
                left: 0;
                width: 100%;
            }
            .main-content {
                margin-left: 0;
                margin-top: 112px; /* Adjust for stacked navbar and sidebar */
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        @include('layout.sidebar')
    </div>

    <!-- Navbar -->
    <div class="navbar">
        @include('layout.navbar')
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('contents')
    </div>

    @include('layout.footer')

