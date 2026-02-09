<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100vh;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: linear-gradient(135deg, #0f1f17, #14281d);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e5e7eb;
        }

        .signup-card {
            width: 400px;
            background: rgba(31, 61, 43, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 14px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.6);
        }

        .signup-card h2 {
            text-align: center;
            color: #4caf50;
            margin-bottom: 8px;
            font-size: 26px;
        }

        .signup-card p {
            text-align: center;
            color: #9ca3af;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #d1d5db;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            background: #14281d;
            border: 1px solid #355e3b;
            border-radius: 10px;
            color: #e5e7eb;
            font-size: 14px;
            outline: none;
        }

        .form-group input::placeholder {
            color: #6b7280;
        }

        .form-group input:focus {
            border-color: #4caf50;
        }

        .signup-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4caf50, #43a047);
            border: none;
            border-radius: 10px;
            color: #0f1f17;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        .signup-btn:hover {
            opacity: 0.9;
        }

        .bottom-text {
            text-align: center;
            margin-top: 22px;
            font-size: 13px;
            color: #9ca3af;
        }

        .bottom-text a {
            color: #4caf50;
            text-decoration: none;
            font-weight: 500;
        }

        .bottom-text a:hover {
            text-decoration: underline;
        }
         .error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }
    </style>
</head>
<body>

    <div class="signup-card">
        <h2>Create Account</h2>
        <p>Join Code Error Explainer</p>

        <form method="POST" action="/users">
            @csrf

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>

                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" placeholder="Enter phone number" required>
                 @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter email" required>

                 @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create password" required>

                 @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button class="signup-btn" type="submit">Create Account</button>
        </form>

        <div class="bottom-text">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

</body>
</html>
