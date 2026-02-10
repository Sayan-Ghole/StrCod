<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Error Explainer</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #14281D;
            color: #E5E7EB;
        }

        /* Navbar */
        .navbar {
            background-color: #0F1F17;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.4);
        }

        .navbar h2 {
            margin: 0;
            color: #4CAF50;
        }

        .nav-links a {
            color: #E5E7EB;
            text-decoration: none;
            margin-left: 20px;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: #4CAF50;
        }

        /* Main Container */
        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: #1F3D2B;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.5);
        }

        .container h1 {
            text-align: center;
            color: #4CAF50;
        }

        .container p {
            text-align: center;
            color: #D1D5DB;
            margin-bottom: 35px;
        }

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }

        select, textarea, button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            font-size: 14px;
            border-radius: 6px;
            border: none;
            outline: none;
        }

        select, textarea {
            background-color: #14281D;
            color: #E5E7EB;
            border: 1px solid #355E3B;
        }

        textarea {
            height: 130px;
            resize: none;
        }

        button {
            background-color: #4CAF50;
            color: #0F1F17;
            font-weight: bold;
            cursor: pointer;
            margin-top: 25px;
        }

        button:hover {
            background-color: #43A047;
        }

        /* Info Section */
        .info {
            margin-top: 45px;
            padding-top: 25px;
            border-top: 1px solid #355E3B;
        }

        .info h3 {
            color: #4CAF50;
        }

        .info ul {
            color: #D1D5DB;
            line-height: 1.8;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 15px;
            margin-top: 50px;
            color: #9CA3AF;
            font-size: 13px;
        }

        #welcome {
            margin: 20px;
            margin-bottom: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h2>StrCode</h2>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('CreateUser') }}">Sign Up</a>

            @if(Auth::check())
            <a href="{{ route('logout') }}">Logout</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            @endif
        </div>
    </div>
    <div id="welcome">
    @if (Auth::check())
        <h2>Welcome, {{ Auth::user()->name }}</h2>
    @endif
   </div>
    <!-- Main Content -->
    <div class="container">
        <h1>Understand Coding Errors Clearly</h1>
        <p>Paste your programming error and get a simple, beginner-friendly explanation.</p>

        <form method="POST" action="{{ route('errorExplainer') }}">
            @csrf
                <label>Programming Language</label>
            <select name="language">
                <option value="Python">Python</option>
                <option value="Java">Java</option>
                <option value="JavaScript">JavaScript</option>
                <option value="C++">C++</option>
                <option value="C">C</option>
                <option value="C#">C#</option>
                <option value="Go">Go</option>
                <option value="Rust">Rust</option>
                <option value="Swift">Swift</option>
                <option value="HTML">HTML</option>
                <option value="CSS">CSS</option>
                <option value="TypeScript">TypeScript</option>
                <option value="Ruby">Ruby</option>
                <option value="R">R</option>
            </select>

            <label>Error Message</label>
            <textarea 
                name="error_message" 
                placeholder="Example: TypeError: unsupported operand type(s) for +">
            </textarea>

            <button type="submit">Explain Error</button>
        </form>
        <div class="info">
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        @ StrCode, Code Error Explainer
    </div>

</body>
</html>
