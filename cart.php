<?php
session_start();
include 'connection.php';

// Use session_id() as UserName to identify the cart owner (guest users)
$userName = session_id();

// Fetch cart items for this user
$sql = "SELECT ProductName, Price, Quantity FROM cartt WHERE UserName = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $userName);
$stmt->execute();
$result = $stmt->get_result();

$productImages = [
    "Harry Potter and the Sorcerer’s Stone" => "images/harry.jpg",
    "The Tattooist of Auschwitz" => "images/3.jpg",
    "Immortals of Meluha" => "images/11.jpg",
    "Lavender Scented Candles" => "images/lav.jpg",
    "Peach Scented Candles" => "images/peach.jpg",
    "Aqua Scented Candles" => "images/aqua.jpg",
    "Paper BookMark" => "images/bm1.jpg",
    "Metal BookMark" => "images/bm2.webp",
    "Acrylic Customizable BookMark" => "images/bm.jpg",
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Your Cart - Shelf of Tales</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #fafafa;
      margin: 0; padding: 20px;
      color: #333;
    }
    h1 {
      text-align: center;
      color: #987c98; /* purple */
      margin-bottom: 30px;
    }
    .cart-container {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 8px 16px rgb(124 58 237 / 0.2);
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      text-align: left;
      padding: 15px 10px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle;
    }
    th {
      background: #987c98;
      color: white;
      font-weight: 600;
    }
    img.product-img {
      width: 80px;
      border-radius: 6px;
      box-shadow: 0 4px 8px rgb(124 58 237 / 0.15);
    }
    input.qty-input {
      width: 50px;
      padding: 5px 8px;
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      text-align: center;
    }
    button.remove-btn {
      background: #ef4444; /* red-500 */
      border: none;
      color: white;
      padding: 6px 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button.remove-btn:hover {
      background: #b91c1c; /* red-700 */
    }
    .total-section {
      margin-top: 25px;
      text-align: right;
      font-size: 1.2rem;
      font-weight: 700;
      color: #987c98;
    }
    .empty-cart {
      text-align: center;
      font-size: 1.3rem;
      margin-top: 50px;
      color: #999;
    }
    .update-btn {
      background: #987c98;
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      margin-left: 10px;
      transition: background 0.3s ease;
    }
    .update-btn:hover {
      background: #5b21b6;
    }
  </style>
</head>
<body>

<h1>Your Cart</h1>

<div class="cart-container">

<?php if ($result->num_rows > 0): ?>

  <form action="updatecart.php" method="POST">
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Name</th>
        <th>Price (NPR)</th>
        <th>Quantity</th>
        <th>Subtotal (NPR)</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $total = 0;
        while ($row = $result->fetch_assoc()):
          $name = htmlspecialchars($row['ProductName']);
          $price = $row['Price'];
          $qty = $row['Quantity'];
          $img = isset($productImages[$name]) ? $productImages[$name] : "images/default.png";
          $subtotal = $price * $qty;
          $total += $subtotal;
      ?>
      <tr>
        <td><img src="<?= $img ?>" alt="<?= $name ?>" class="product-img" /></td>
        <td><?= $name ?></td>
        <td><?= number_format($price, 2) ?></td>
        <td>
          <input
            type="number"
            name="quantities[<?= $name ?>]"
            value="<?= $qty ?>"
            min="1"
            class="qty-input"
            required
          />
        </td>
        <td><?= number_format($subtotal, 2) ?></td>
        <td>
          <button type="submit" name="remove" value="<?= $name ?>" class="remove-btn" title="Remove Item">
            <i class="fa-solid fa-trash"></i>
          </button>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="total-section">
    Total: NPR <?= number_format($total, 2) ?>
  </div>

  <div style="text-align: right; margin-top: 15px;">
    <button type="submit" name="update" class="update-btn">Update Cart</button>
  </div>
  </form>

<?php else: ?>

  <p class="empty-cart">Your cart is empty.</p>

<?php endif; ?>

</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
