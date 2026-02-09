<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

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
            background: #2d3748;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cbd5e0;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1a202c;
            color: #fff;
        }

        /* Main */
        .main {
            flex: 1;
            padding: 30px;
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Table */
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #edf2f7;
        }

        tr:hover {
            background: #f7fafc;
        }

        .btn {
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
            font-size: 13px;
        }

        .btn-edit {
            background: #38a169;
        }

        .btn-delete {
            background: #e53e3e;
        }

        .btn-delete:hover {
            background: #c53030;
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="/admin">Dashboard</a>
        <a href="{{ route('AdminSignUp') }}">Add User</a>
        <a href="{{ route('UserDetails') }}" class="active">User Details</a>
        <a href="{{ route('Adminlogout') }}">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main">

        <div class="topbar">
            <h3>User Details</h3>
            <span>Admin</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($userDetails as $userDetail)
                <tr>
                    <td>{{ $userDetail->id }}</td>
                    <td>{{ $userDetail->name }}</td>
                    <td>{{ $userDetail->email }}</td>
                    <td>{{ $userDetail->created_at }}</td>
                    <td>{{ $userDetail->updated_at }}</td>
                    <td>
                        <a href="{{ route('updateUser', ['id' => $userDetail->id]) }}" class="btn btn-edit">
                            Edit
                        </a>

                        <a href="{{ route('deleteUser', ['id' => $userDetail->id]) }}"
                           class="btn btn-delete"
                           onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
