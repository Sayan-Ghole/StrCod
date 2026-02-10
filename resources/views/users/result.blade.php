<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Explanation</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: #0f1f18;
            color: #eaeaea;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background: #14281D;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.6);
        }

        h1 {
            margin-top: 0;
            text-align: center;
            color: #9AE6B4;
            letter-spacing: 1px;
        }

        .answer-box {
            background: #1c3a2b;
            border-left: 5px solid #9AE6B4;
            padding: 20px;
            margin-top: 25px;
            white-space: pre-wrap;
            line-height: 1.7;
            color: #f1f1f1;
            font-size: 15px;
        }

        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: #4CAF50;
            color: #14281D;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #4caf4f93;
        }
    </style>
</head>
<body>
     

    <div class="container">
        <h1>🧠 Error Explanation</h1>

        <div class="answer-box">
            {{ $answer }}
        </div>
        
        <a href="{{ route('home') }}" class="back-btn">Go Back</a>
    </div>

</body>
</html>
