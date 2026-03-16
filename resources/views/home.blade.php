<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>StrCode - Error Explainer</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins',sans-serif;
    min-height:100vh;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    color:white;
}

/* Navbar */

.navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 40px;

    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(10px);
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.navbar h2{
    color:#4ade80;
    letter-spacing:1px;
}

.nav-links a{
    text-decoration:none;
    color:white;
    margin-left:25px;
    font-size:14px;
    transition:0.3s;
}

.nav-links a:hover{
    color:#4ade80;
}

/* Welcome */

#welcome{
    text-align:center;
    margin-top:30px;
}

/* Main container */

.container{
    max-width:850px;
    margin:40px auto;
    padding:40px;

    background:rgba(255,255,255,0.05);
    border-radius:20px;

    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,0.1);

    box-shadow:0 10px 40px rgba(0,0,0,0.4);
}

/* Title */

.container h1{
    text-align:center;
    color:#4ade80;
}

.container p{
    text-align:center;
    margin-top:10px;
    margin-bottom:35px;
    color:#cbd5e1;
}

/* Form */

label{
    margin-top:15px;
    display:block;
    font-weight:500;
}

select,textarea{

    width:100%;
    margin-top:10px;
    padding:12px;

    border-radius:10px;
    border:1px solid rgba(255,255,255,0.1);

    background:rgba(255,255,255,0.05);
    color:white;

    transition:0.3s;
}

/* Focus animation */

select:focus,
textarea:focus{

    border-color:#4ade80;
    box-shadow:0 0 10px #4ade8070;
}

textarea{
    height:130px;
    resize:none;
}

/* Button */

button{

    width:100%;
    margin-top:25px;
    padding:13px;

    border:none;
    border-radius:12px;

    font-size:15px;
    font-weight:600;

    background:linear-gradient(45deg,#22c55e,#4ade80);
    color:#022c22;

    cursor:pointer;
    transition:0.3s;
}

button:hover{

    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(0,0,0,0.4);
}

/* Footer */

.footer{
    text-align:center;
    padding:20px;
    margin-top:40px;
    color:#94a3b8;
    font-size:13px;
}

/* floating animation */

.container{
    animation:float 6s ease-in-out infinite;
}

@keyframes float{

0%{transform:translateY(0px)}
50%{transform:translateY(-8px)}
100%{transform:translateY(0px)}

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

<!-- Main Container -->

<div class="container">

<h1>Understand Coding Errors Clearly</h1>

<p>Paste your programming error and get a simple explanation.</p>

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
placeholder="Example: TypeError: unsupported operand type(s) for +"
></textarea>

<button type="submit">Explain Error</button>

</form>

</div>

<div class="footer">
© StrCode • Code Error Explainer
</div>

<script>

/* textarea auto expand */

let textarea = document.querySelector("textarea");

textarea.addEventListener("input",  function(){

textarea.style.height="auto";
textarea.style.height=textarea.scrollHeight+"px";

});

/* button loading effect */

const form = document.querySelector("form");
const btn = document.querySelector("button");

form.addEventListener("submit",function(){

btn.innerText="Analyzing...";
btn.style.opacity="0.7";

});

</script>

</body>
</html>