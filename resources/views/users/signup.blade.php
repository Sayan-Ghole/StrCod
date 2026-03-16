<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Account - StrCode</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
box-sizing:border-box;
margin:0;
padding:0;
}

body{

height:100vh;
font-family:'Poppins',sans-serif;

background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);

display:flex;
align-items:center;
justify-content:center;

color:white;
overflow:hidden;

}

/* background glow */

body::before{

content:"";
position:absolute;

width:600px;
height:600px;

background:#22c55e;
filter:blur(200px);
opacity:0.2;

top:-150px;
left:-150px;

}

body::after{

content:"";
position:absolute;

width:600px;
height:600px;

background:#4ade80;
filter:blur(200px);
opacity:0.15;

bottom:-150px;
right:-150px;

}

/* card */

.signup-card{

width:420px;
padding:40px;

background:rgba(255,255,255,0.05);

backdrop-filter:blur(15px);

border-radius:18px;

border:1px solid rgba(255,255,255,0.1);

box-shadow:0 25px 60px rgba(0,0,0,0.5);

animation:float 6s ease-in-out infinite;

}

/* title */

.signup-card h2{

text-align:center;

color:#4ade80;

margin-bottom:5px;

font-size:28px;

}

.signup-card p{

text-align:center;

color:#cbd5e1;

margin-bottom:30px;

font-size:14px;

}

/* form */

.form-group{

margin-bottom:18px;

}

.form-group label{

display:block;

font-size:13px;

margin-bottom:6px;

color:#d1d5db;

}

.form-group input{

width:100%;

padding:12px 14px;

border-radius:10px;

border:1px solid rgba(255,255,255,0.15);

background:rgba(0,0,0,0.2);

color:white;

font-size:14px;

outline:none;

transition:0.3s;

}

.form-group input::placeholder{

color:#9ca3af;

}

.form-group input:focus{

border-color:#4ade80;

box-shadow:0 0 8px #4ade8070;

}

/* password wrapper */

.password-wrapper{

position:relative;

}

.toggle-pass{

position:absolute;

right:12px;

top:50%;

transform:translateY(-50%);

cursor:pointer;

font-size:13px;

color:#9ca3af;

}

/* button */

.signup-btn{

width:100%;

padding:13px;

margin-top:10px;

background:linear-gradient(45deg,#22c55e,#4ade80);

border:none;

border-radius:12px;

color:#022c22;

font-size:15px;

font-weight:600;

cursor:pointer;

transition:0.3s;

}

.signup-btn:hover{

transform:translateY(-2px);

box-shadow:0 10px 20px rgba(0,0,0,0.4);

}

/* bottom text */

.bottom-text{

text-align:center;

margin-top:22px;

font-size:13px;

color:#9ca3af;

}

.bottom-text a{

color:#4ade80;

text-decoration:none;

font-weight:500;

}

.bottom-text a:hover{

text-decoration:underline;

}

/* error */

.error{

color:#fca5a5;

font-size:12px;

margin-top:6px;

}

/* animation */

@keyframes float{

0%{transform:translateY(0)}
50%{transform:translateY(-8px)}
100%{transform:translateY(0)}

}

</style>
</head>

<body>

<div class="signup-card">

<h2>Create Account</h2>
<p>Join StrCode Error Explainer</p>

<form method="POST" action="{{ route('CreateUsers') }}" id="signupForm">

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

<div class="password-wrapper">

<input type="password" name="password" id="password" placeholder="Create password" required>

<span class="toggle-pass" onclick="togglePassword()">Show</span>

</div>

@error('password')
<div class="error">{{ $message }}</div>
@enderror

</div>

<button class="signup-btn" type="submit" id="signupBtn">
Create Account
</button>

</form>

<div class="bottom-text">

Already have an account?

<a href="{{ route('login') }}">Login</a>

</div>

</div>

<script>

/* show hide password */

function togglePassword(){

let pass=document.getElementById("password");
let btn=document.querySelector(".toggle-pass");

if(pass.type==="password"){

pass.type="text";
btn.innerText="Hide";

}else{

pass.type="password";
btn.innerText="Show";

}

}

/* loading animation */

const form=document.querySelector("#signupForm");
const btn=document.querySelector("#signupBtn");

form.addEventListener("submit",function(){

btn.innerText="Creating Account...";
btn.style.opacity="0.7";

});

</script>

</body>
</html>