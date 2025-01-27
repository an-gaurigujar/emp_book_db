<?php
$conn = new mysqli('localhost', 'root', 'root', 'my_database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $sql = "INSERT INTO books (title, author, price) VALUES ('$title', '$author', '$price')";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Book data saved successfully!"; // Success message after inserting the data
    } else {
        $success_message = "Error: " . $sql . "<br>" . $conn->error; // Display error if any
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Form</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        .back-btn:hover {
            background-color: #45a049;
        }
        .success-message {
            margin-top: 20px;
            padding: 10px;
            background-color:rgb(78, 76, 175);
            color: white;
            border-radius: 4px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Enter Book Data</h1>

        <form method="POST" action="book_form.php">
            <input type="text" name="title" placeholder="Book Title" required><br>
            <input type="text" name="author" placeholder="Author" required><br>
            <input type="text" name="price" placeholder="Price" required><br>
            <input type="submit" value="Submit">
        </form>

        <?php if ($success_message): ?>
            <div class="success-message">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        <button class="back-btn" onclick="window.location.href='index.php'">Back to Home</button>
    </div>
</body>
</html>
