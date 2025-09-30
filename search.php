<?php
include 'connection.php';

$search = $_GET['query'] ?? '';
$results = [];

if($search){
    $safe = mysqli_real_escape_string($conn, $search);
    $res = mysqli_query($conn, "SELECT * FROM books WHERE BookName LIKE '%$safe%' OR Author LIKE '%$safe%' OR Genre LIKE '%$safe%'");
    if($res){
        while($row = mysqli_fetch_assoc($res)){
            $row['Image'] = !empty($row['Image']) ? 'images/' . $row['Image'] : 'images/default.jpg';
            $row['Price'] = number_format($row['Price'], 2);
            $results[] = $row;
        }
    }
}
?>

<h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>

<div style="display:flex; flex-wrap:wrap; gap:20px;">
<?php foreach($results as $b): ?>
    <div style="border:1px solid #ccc; padding:10px; width:200px; text-align:center; border-radius:6px;">
        <img src="<?php echo $b['Image']; ?>" width="150" style="margin-bottom:10px;">
        <p><?php echo $b['BookName']; ?></p>
        <p>NPR <?php echo $b['Price']; ?></p>
        <button>Add to Cart</button>
    </div>
<?php endforeach; ?>
<?php if(empty($results)) echo "<p>No books found.</p>"; ?>
</div>
