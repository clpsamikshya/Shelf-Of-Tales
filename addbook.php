<?php
session_start();

if (!isset($_SESSION['UserName'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['UserName'] !== 'admin') {
    header("Location: home.php");
    exit;
}

include 'connection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $bookName = trim($_POST['book_name'] ?? '');
    $price = $_POST['price'] ?? 0;
    $image = trim($_POST['image'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $author = trim($_POST['author'] ?? '');

    if ($bookName !== '' && is_numeric($price) && $price >= 0 && $image !== '' && $description !== '') {
        $sql = "INSERT INTO books (BookName, Price, Image, Description, Genre, Author) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdssss", $bookName, $price, $image, $description, $genre, $author);

        if ($stmt->execute()) {
            $message = "✅ Book added successfully!";
        } else {
            $message = "❌ Error adding book: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } else {
        $message = "⚠️ Please fill in all required fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add New Book - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #ede9fe, #f5f3ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 20px;
        }

        form {
            background-color: #ffffff;
            padding: 35px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(91, 33, 182, 0.1);
            max-width: 480px;
            width: 100%;
        }

        h2 {
            color: #4c1d95;
            font-weight: 700;
            font-size: 1.75rem;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fafafa;
            transition: border-color 0.2s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus {
            border-color: #7c3aed;
            outline: none;
            background-color: #ffffff;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        input[type="submit"] {
            margin-top: 25px;
            background-color: #7c3aed;
            color: #ffffff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #5b21b6;
        }

        .message {
            margin-bottom: 20px;
            background-color: #eef2ff;
            padding: 12px 15px;
            border-left: 4px solid #7c3aed;
            color: #4c1d95;
            border-radius: 6px;
            font-weight: 500;
            text-align: center;
        }

        .logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #7c3aed;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
        <h2>Add a New Book</h2>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <label for="book_name">📘 Book Name:</label>
        <input type="text" id="book_name" name="book_name" required />

        <label for="price">💰 Price (NPR):</label>
        <input type="number" id="price" name="price" step="0.01" min="0" required />

        <label for="description">📝 Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="genre">🏷️ Genre (optional):</label>
        <input type="text" id="genre" name="genre" />

        <label for="author">✍️ Author (optional):</label>
        <input type="text" id="author" name="author" />

        <label for="image">📷 Book Cover Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" name="add_book" value="Add Book" />

        <a class="logout-link" href="logout.php">Logout</a>
    </form>
</body>
</html>
