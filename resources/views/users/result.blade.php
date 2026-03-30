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

color:#011713a8;

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

/* //for level */
.levels {
    display: flex;
    gap: 10px;
    margin: 15px 0;
}

.level {
    padding: 6px 12px;
    border-radius: 50px;
    /* font-size: 14px; */
    opacity: 0.3; /* faded */
    transition: 0.3s ease;
}

/* Individual colors */
#beginner {
    background: #4CAF50;
    color: #40b344;
}

#intermediate {
    background: #e9b311d7;
    color: #d6c07d;

}

#advanced {
    background: rgb(220, 108, 11);
    color: orange;
}

/* Active Glow */
.active {
    opacity: 1;
    transform: scale(1.1);
    box-shadow: 0 0 5px currentColor,
                0 0 5px currentColor;
}
</style>
</head>

<body>

<div class="container">

<h1>🧠 Error Explanation</h1>
<div class="levels">
    <span id="beginner" class="level"></span>
    <span id="intermediate" class="level"></span>
    <span id="advanced" class="level"></span>
</div>
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

//for levels...............
function checkdef(){
    
let answerText = document.querySelector("#answerText")
let answerbox = document.querySelector(".answer-box")
let ans = answerText.innerText.toLowerCase();

let beginner = document.querySelector("#beginner");
let intermediate = document.querySelector("#intermediate");
let advanced = document.querySelector("#advanced");

// beginner.classList.remove()
// intermediate.classList.remove()
// advanced.classList.remove()

if(ans.includes("syntax") || ans.includes("undefined")){
    beginner.classList.add("active");
    answerbox.style.borderLeft='4px solid #4ade80';
}
else if(ans.includes("type") || ans.includes("null")){
    intermediate.classList.add("active");
    answerbox.style.borderLeft='4px solid #e9b311d7';
    
}
else{
    advanced.classList.add("active");
    answerbox.style.borderLeft='4px solid orange';
    
}
   
}
checkdef()

















</script>

</body>
</html>