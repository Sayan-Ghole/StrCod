<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Error Explanation</title>

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

display:flex;
justify-content:center;
align-items:center;

padding:30px;

}

/* Container */

.container{

max-width:900px;
width:100%;

padding:40px;

background:rgba(255,255,255,0.05);
border-radius:20px;

backdrop-filter:blur(15px);

border:1px solid rgba(255,255,255,0.1);

box-shadow:0 20px 50px rgba(0,0,0,0.5);

animation:float 6s ease-in-out infinite;

}

/* Title */

h1{

text-align:center;
color:#4ade80;
margin-bottom:25px;

}

/* Answer Box */

.answer-box{

background:rgba(0,0,0,0.25);

border-left:4px solid #4ade80;

padding:25px;

border-radius:10px;

line-height:1.7;

white-space:pre-wrap;

font-size:15px;

color:#e2e8f0;

margin-bottom:30px;

}

/* Buttons */

.button-area{

display:flex;
gap:15px;
justify-content:center;

}

/* Back Button */

.back-btn{

padding:12px 25px;

background:linear-gradient(45deg,#22c55e,#4ade80);

color:#022c22;

text-decoration:none;

border-radius:10px;

font-weight:600;

transition:0.3s;

}

.back-btn:hover{

transform:translateY(-2px);
box-shadow:0 10px 20px rgba(0,0,0,0.4);

}

/* Copy Button */

.copy-btn{

padding:12px 25px;

border:none;

background:rgba(255,255,255,0.08);

color:white;

border-radius:10px;

cursor:pointer;

font-weight:500;

transition:0.3s;

}

.copy-btn:hover{

background:rgba(255,255,255,0.2);

}

/* floating animation */

@keyframes float{

0%{transform:translateY(0px)}
50%{transform:translateY(-8px)}
100%{transform:translateY(0px)}

}

</style>
</head>

<body>

<div class="container">

<h1>🧠 Error Explanation</h1>

<div class="answer-box" id="answerText">
{{ $answer }}
</div>

<div class="button-area">

<button class="copy-btn" id="copyed" onclick="copyText()">📋 Copy</button>

<a href="{{ route('home') }}" class="back-btn">Analyze Another Error</a>

</div>

</div>

<script>

function copyText(){

let text=document.querySelector("#answerText").innerText;
let copyed = document.querySelector("#copyed");

navigator.clipboard.writeText(text);
copyed.innerText="📋 Copied"


alert("Explanation copied!");


}

</script>

</body>
</html>