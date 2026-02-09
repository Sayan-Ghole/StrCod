<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        /* Layout */
        .wrapper {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #2d3748; /* previous dark color */
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cbd5e0;
            text-decoration: none;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #1a202c;
            color: #fff;
        }

        .sidebar a.active {
            background: #1a202c;
            color: #fff;
        }

        /* Main content */
        .main {
            flex: 1;
            padding: 30px;
        }

        /* Top bar */
        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            background: #fff;
            margin-top: 30px;
            padding: 25px;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            background: #3490dc;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background: #2779bd;
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>

        <a href="/admin" class="active">Dashboard</a>
        <a href="{{ route('AdminSignUp') }}">Add User</a>
        <a href="{{ route('UserDetails') }}">User Details</a>
         <a href="{{ route('Adminlogout') }}">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main">

        <div class="topbar">
            <h3>Dashboard</h3>

            @auth('admin')
                <span>Welcome, {{ Auth::guard('admin')->user()->name}}</span>
            @endauth
            
        </div>

        <div class="card">
            <h2>User Management</h2>
            <p>View, update and delete user information.</p>

            <a href="{{ route('UserDetails') }}" class="btn">
                View User Details
            </a>
        </div>

    </div>
</div>

</body>
</html>
