<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        nav {
            background-color:rgb(76, 116, 175);
            padding: 10px 20px;
            text-align: center;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 18px;
            margin: 0 10px;
            border-radius: 4px;
        }
        nav a:hover {
            background-color:rgb(83, 69, 160);
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80%;
        }
        .buttons {
            text-align: center;
        }
        .buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 30px;
            font-size: 18px;
            border: none;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
            width: 200px;
            transition: background-color 0.3s ease;
        }
        .buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="display_data.php">Display Data</a>
    </nav>
    <div class="content">
        <div class="buttons">
            <h1>Welcome to the Data Entry Page</h1>
            <button onclick="window.location.href='employee_form.php'">Employee Data</button><br>
            <button onclick="window.location.href='book_form.php'">Book Data</button><br>
        </div>
    </div>
</body>
</html>
