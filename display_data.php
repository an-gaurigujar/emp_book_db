<?php
$conn = new mysqli('localhost', 'root', 'root', 'my_database');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_employee_id'])) {
    $employee_id = $_GET['delete_employee_id'];
    $delete_sql = "DELETE FROM employees WHERE id = $employee_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Employee deleted successfully!";
        header("Location: display_data.php");
        exit();
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
}

if (isset($_GET['delete_book_id'])) {
    $book_id = $_GET['delete_book_id'];
    $delete_sql = "DELETE FROM books WHERE id = $book_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Book deleted successfully!";
        header("Location: display_data.php");
        exit();
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}

if (isset($_POST['edit_employee_id'])) {
    $id = $_POST['edit_employee_id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $update_sql = "UPDATE employees SET name='$name', position='$position', salary='$salary' WHERE id=$id";
    if ($conn->query($update_sql) === TRUE) {
        echo "Employee record updated successfully!";
        header("Location: display_data.php");
        exit();
    } else {
        echo "Error updating employee record: " . $conn->error;
    }
}

if (isset($_POST['edit_book_id'])) {
    $id = $_POST['edit_book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $update_sql = "UPDATE books SET title='$title', author='$author', price='$price' WHERE id=$id";
    if ($conn->query($update_sql) === TRUE) {
        echo "Book record updated successfully!";
        header("Location: display_data.php");
        exit();
    } else {
        echo "Error updating book record: " . $conn->error;
    }
}

$employee_sql = "SELECT * FROM employees";
$employee_result = $conn->query($employee_sql);

$book_sql = "SELECT * FROM books";
$book_result = $conn->query($book_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            overflow-x: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            font-size: 14px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }
        .edit-btn {
            background-color: #4CAF50;
        }
        .edit-btn:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #e53935;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
            display: block;
            margin: 20px auto;
        }
        .back-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Data</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
            <?php if ($employee_result->num_rows > 0): ?>
                <?php while($row = $employee_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td>
                        
                            <button onclick="editEmployee(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['position']; ?>', <?php echo $row['salary']; ?>)" class="btn edit-btn">Edit</button>
                      
                            <a href="?delete_employee_id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No employee data found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <h1>Book Data</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php if ($book_result->num_rows > 0): ?>
                <?php while($row = $book_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>                       
                            <button onclick="editBook(<?php echo $row['id']; ?>, '<?php echo $row['title']; ?>', '<?php echo $row['author']; ?>', <?php echo $row['price']; ?>)" class="btn edit-btn">Edit</button>
                          
                            <a href="?delete_book_id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No book data found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <button class="back-btn" onclick="window.location.href='index.php'">Back to Home</button>
    </div>
    <div id="editFormContainer" style="display:none;">
        <h2>Edit Entry</h2>
        <form id="editForm" method="POST">
            <input type="hidden" name="edit_employee_id" id="editEmployeeId">
            <input type="hidden" name="edit_book_id" id="editBookId">
            <label>Name / Title: </label>
            <input type="text" name="name" id="name" required><br>
            <label>Position / Author: </label>
            <input type="text" name="position" id="position" required><br>
            <label>Salary / Price: </label>
            <input type="number" name="salary" id="salary" required><br>
            <input type="submit" value="Save Changes">
        </form>
    </div>
    <script>
        function editEmployee(id, name, position, salary) {
            document.getElementById('editFormContainer').style.display = 'block';
            document.getElementById('editEmployeeId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('position').value = position;
            document.getElementById('salary').value = salary;
            document.getElementById('editBookId').value = '';
        }
        function editBook(id, title, author, price) {
            document.getElementById('editFormContainer').style.display = 'block';
            document.getElementById('editBookId').value = id;
            document.getElementById('name').value = title;
            document.getElementById('position').value = author;
            document.getElementById('salary').value = price;
            document.getElementById('editEmployeeId').value = '';
        }
    </script>
</body>
</html>
