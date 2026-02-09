<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            width: 350px;
            margin: 80px auto;
            background: #fff;
            padding: 20px;
            border-radius: 6px;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 10px;
        }
        button {
            background: #3490dc;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Signup</h2>

    <form method="POST" action="/update/{{ $test->id }}">
        @csrf

        <input type="text" name="name" value="{{ $test->name }}" required>

        <input type="text" name="phone" value="{{ $test->phone }}" required>

        <input type="email" name="email" value="{{ $test->email }}" required>

        <input type="password" name="password"  required>

        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
