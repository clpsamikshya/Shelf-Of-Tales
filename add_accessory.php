<?php
session_start();

include 'connection.php';

// Redirect if not logged in (optional)
if (!isset($_SESSION['UserName'])) {
    header("Location: admin_dashboard.php");
    exit;
}

$accessory = [
    'id' => '',
    'Name' => '',
    'Category' => '',
    'Image' => '',
    'Price' => ''
];

$isEdit = false;
$message = "";

// Handle if editing (id in GET)
if (isset($_GET['id'])) {
    $isEdit = true;
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM accessories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $accessory = $result->fetch_assoc();
    } else {
        // No accessory found, redirect back
        header("Location: admin_dashboard.php");
        exit;
    }
    $stmt->close();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $Name = trim($_POST['Name']);
    $Category = trim($_POST['Category']);
    $Price = floatval($_POST['Price']);

    // Keep old image if editing
    $imageName = $accessory['Image'] ?? '';

    // Handle image upload if a new file is provided
    if (!empty($_FILES['Image']['name'])) {
        $targetDir = "images/";
        $imageName = basename($_FILES["Image"]["name"]);

        // Validate file extension
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedTypes)) {
            if (!move_uploaded_file($_FILES["Image"]["tmp_name"], $targetDir . $imageName)) {
                $message = "❌ Error uploading image.";
            }
        } else {
            $message = "❌ Invalid image file type. Allowed: jpg, jpeg, png, gif.";
        }
    }

    if (!$message) {
        if ($id) {
            // Update existing accessory
            if ($imageName) {
                $stmt = $conn->prepare("UPDATE accessories SET Name=?, Category=?, Price=?, Image=? WHERE id=?");
                $stmt->bind_param("ssdsi", $Name, $Category, $Price, $imageName, $id);
            } else {
                $stmt = $conn->prepare("UPDATE accessories SET Name=?, Category=?, Price=? WHERE id=?");
                $stmt->bind_param("ssdi", $Name, $Category, $Price, $id);
            }
            if ($stmt->execute()) {
                $message = "✅ Accessory updated successfully.";
                header("Location: admin_dashboard.php?message=" . urlencode($message));
                exit;
            } else {
                $message = "❌ Error updating accessory: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            // Insert new accessory
            $stmt = $conn->prepare("INSERT INTO accessories (Name, Category, Price, Image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $Name, $Category, $Price, $imageName);
            if ($stmt->execute()) {
                $message = "✅ Accessory added successfully.";
                header("Location: admin_dashboard.php?message=" . urlencode($message));
                exit;
            } else {
                $message = "❌ Error adding accessory: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?= $isEdit ? "Edit Accessory" : "Add New Accessory" ?></title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f0f4ff;
    margin: 0;
    padding: 30px;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    color: #333;
  }
  .container {
    background: white;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 600px;
  }
  h1 {
    color: #987c98;
    margin-bottom: 25px;
    text-align: center;
  }
  label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #987c98;
  }
  input[type="text"],
  input[type="number"],
  textarea,
  select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 18px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    resize: vertical;
  }
  textarea {
    min-height: 100px;
  }
  input[type="file"] {
    margin-bottom: 18px;
  }
  button {
    background-color: #987c98;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: 100%;
  }
  button:hover {
    background-color: #987c98;
  }
  .message {
    padding: 12px 20px;
    margin-bottom: 20px;
    border-radius: 10px;
    font-weight: 600;
    text-align: center;
  }
  .success {
    background-color: #d1fae5;
    color: #065f46;
  }
  .error {
    background-color: #fee2e2;
    color: #b91c1c;
  }
  .back-link {
    display: inline-block;
    margin-bottom: 20px;
    color: #987c98;
    text-decoration: underline;
    font-weight: 600;
    cursor: pointer;
  }
  .current-image {
    margin-bottom: 20px;
  }
  .current-image img {
    max-width: 150px;
    border-radius: 8px;
    box-shadow: 0 3px 8px rgba(79, 70, 229, 0.3);
  }
</style>
</head>
<body>

<div class="container">
  <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a>

  <h1><?= $isEdit ? "Edit Accessory" : "Add New Accessory" ?></h1>

  <?php if ($message): ?>
    <div class="message <?= strpos($message, '✅') === 0 ? 'success' : 'error' ?>">
      <?= htmlspecialchars($message) ?>
    </div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data">

    <label for="Name">Accessory Name:</label>
    <input type="text" id="Name" name="Name" value="<?= htmlspecialchars($accessory['Name']) ?>" required />

    <label for="Category">Category:</label>
    <input type="text" id="Category" name="Category" value="<?= htmlspecialchars($accessory['Category']) ?>" />

    <label for="Price">Price (NPR):</label>
    <input type="number" step="0.01" id="Price" name="Price" value="<?= htmlspecialchars($accessory['Price']) ?>" required />

    <?php if ($isEdit && $accessory['Image'] && file_exists('images/' . $accessory['Image'])): ?>
      <div class="current-image">
        <label>Current Image:</label><br>
        <img src="images/<?= htmlspecialchars($accessory['Image']) ?>" alt="<?= htmlspecialchars($accessory['Name']) ?>" />
      </div>
    <?php endif; ?>

    <label for="Image"><?= $isEdit ? "Change Image:" : "Upload Image:" ?></label>
    <input type="file" id="Image" name="Image" accept="image/*" <?= $isEdit ? '' : 'required' ?> />

    <?php if ($isEdit): ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($accessory['id']) ?>" />
    <?php endif; ?>

    <button type="submit"><?= $isEdit ? "Update Accessory" : "Add Accessory" ?></button>
  </form>
</div>

</body>
</html>
