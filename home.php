<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="Shelf of Tales" />
  <meta name="author" content="" />
  <title>Shelf of Tales</title>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

    <link rel="stylesheet" href="style1.css" />
    <style>
.search-btn{
    background: #D8BFD8 !important;  /* your brand color */
    color: #fff !important;
    font-weight: bold;
    transition: 0.3s ease;
}

.search-btn:hover{
    background: #C2A3C2 !important;  /* slightly darker on hover */
    color: #fff !important;
}

.search-form input:focus {
    border-color: #D8BFD8;
}
</style>
</head>
<body>
<header>
    <div class="navbar">
      <div class="logo">
        <img src="images/img.jpg" alt="Logo" />
      </div>

      <nav class="nav-links">
        <a href="home.php">Home</a>
        <a href="product.php">Product</a>
        <a href="contact.html">Contact</a>
        <a href="blog.html">Blog</a>
        <a href="research.html">Research</a>
      </nav>

      <div class="search-bar">
        <a href="cart.php">
          <img src="images/cart.jpg.png" alt="Cart" width="30" />
        </a>
          <form action="search.php" method="GET" class="search-form" style="max-width:460px; margin:20px auto; display:flex; align-items:center; position:relative;">
    <input type="text" id="searchInput" name="query" placeholder="Search books..." autocomplete="off" style="flex:1; padding:10px 15px; border-radius:25px 0 0 25px; border:1px solid #ccc; outline:none;">
    <button type="submit" class="btn search-btn" style="border-radius:0 25px 25px 0; margin-left:-1px; padding:10px 20px;">Search</button>
    <div id="suggestions" style="position:absolute; top:50px; left:0; right:0; background:#fff; border:1px solid #ccc; z-index:1000; max-height:300px; overflow-y:auto;"></div>
</form>
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>
<section class="offer" style="text-align: center; padding: 40px 15px; background-color: #fdf9fc;">
  <h1 style="font-size: 30px; color: #6b3c83; margin-bottom: 10px;">Flash Sale</h1>
  <h2 style="font-size: 22px; color: #9c5ab0; margin-bottom: 20px;">Sale Up To 40% Off</h2>

  <p style="max-width: 650px; margin: 0 auto 10px auto; font-size: 15px; color: #555;">
    At <strong>Shelf of Tales</strong>, we care about your love for books.
  </p>
  <p style="max-width: 650px; margin: 0 auto 30px auto; font-size: 15px; color: #555;">
    Find your next favorite read with exclusive discounts.
  </p>

  <div style="
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    max-width: 900px;
    margin: 0 auto;
  ">
    <img
      src="images/read.webp"
      alt="Reading"
      style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(156,90,176,0.2); transition: transform 0.2s;"
      onmouseover="this.style.transform='scale(1.03)'"
      onmouseout="this.style.transform='scale(1)'"
    />

    <img
      src="images/st.webp"
      alt="Books"
      style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(156,90,176,0.2); transition: transform 0.2s;"
      onmouseover="this.style.transform='scale(1.03)'"
      onmouseout="this.style.transform='scale(1)'"
    />

    <img
      src="images/bok.webp"
      alt="Stack"
      style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(156,90,176,0.2); transition: transform 0.2s;"
      onmouseover="this.style.transform='scale(1.03)'"
      onmouseout="this.style.transform='scale(1)'"
    />

    <img
      src="images/gir.webp"
      alt="Reading Girl"
      style="width: 180px; height: 120px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 10px rgba(156,90,176,0.2); transition: transform 0.2s;"
      onmouseover="this.style.transform='scale(1.03)'"
      onmouseout="this.style.transform='scale(1)'"
    />
  </div>
</section>

<!-- Books Section -->
<div class="text">
  <h3>Books</h3>
  <div class="horizontal-line"></div>
</div>

<div class="books-container">
  <div class="book2" onclick="showProductModal(
    'Harry Potter and the Sorcerer’s Stone', 
    1500, 
    'images/harry.jpg', 
    'The first book in the beloved Harry Potter series. Follow Harry as he discovers his magical heritage and attends Hogwarts School of Witchcraft and Wizardry.'
  )">
    <img src="images/harry.jpg" alt="Harry Potter" />
    <p>Harry Potter and the Sorcerer’s Stone</p>
    <p>NPR.1500</p>
    <button name="add" onclick="event.stopPropagation(); addToCart('Harry Potter and the Sorcerer’s Stone', 1500)">
      Add To Cart
    </button>
  </div>

  <div class="book3" onclick="showProductModal(
    'The Tattooist of Auschwitz', 
    1800, 
    'images/3.jpg', 
    'A powerful true story of love and survival during the Holocaust, based on the life of Lale Sokolov, a prisoner who was forced to tattoo identification numbers on his fellow prisoners.'
  )">
    <img src="images/3.jpg" alt="The Tattooist of Auschwitz" />
    <p>The Tattooist of Auschwitz</p>
    <p>NPR.1800</p>
    <button name="add" onclick="event.stopPropagation(); addToCart('The Tattooist of Auschwitz', 1800)">
      Add To Cart
    </button>
  </div>

  <div class="book4" onclick="showProductModal(
    'Immortals of Meluha', 
    2100, 
    'images/11.jpg', 
    'The first book in the Shiva Trilogy by Amish Tripathi. Set in ancient India, it follows Shiva, a Tibetan immigrant, who is drawn into a war and becomes a hero.'
  )">
    <img src="images/11.jpg" alt="Immortals of Meluha" />
    <p>Immortals of Meluha</p>
    <p>NPR.2100</p>
    <button name="add" onclick="event.stopPropagation(); addToCart('Immortals of Meluha', 2100)">
      Add To Cart
    </button>
  </div>
</div>
 <!-- <div class="text">
  <h3>Books</h3>
  <div class="horizontal-line"></div>
</div>
<div class="books-container">
  <?php
  include 'connection.php'; 

  $sql = "SELECT * FROM Books";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          $bookName = htmlspecialchars($row['BookName'], ENT_QUOTES);
          $price = number_format($row['Price'], 2);
          $imageFile = htmlspecialchars($row['Image']); 
          $imagePath = "images/" . $imageFile; 
          $description = htmlspecialchars($row['Description'], ENT_QUOTES);

          echo "
          <div class='book' onclick=\"showProductModal('$bookName', $price, '$imagePath', '$description')\">
            <img src='$imagePath' alt='$bookName' />
            <p>$bookName</p>
            <p>NPR. $price</p>
            <button onclick=\"event.stopPropagation(); addToCart('$bookName', $price)\">Add To Cart</button>
          </div>
          ";
      }
  } else {
      echo "<p>No books available at the moment.</p>";
  }
  ?>
</div> -->


<!-- Modal Structure -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Product Image">
    <h2 id="modalName">Product Name</h2>
    <p id="modalDescription">Product description goes here...</p>
    <p id="modalPrice">NPR 0</p>
    <button id="modalAddToCart">Add to Cart</button>
  </div>
</div>



  <!-- Candles Section -->
  <div class="text">
    <h3>Candles</h3>
    <div class="horizontal-line"></div>
  </div>

  <div class="candles-container">
    <div class="candle1">
      <img src="images/lav.jpg" alt="Lavender Scented Candles" />
      <p>Lavender Scented Candles</p>
      <p>NPR.580</p>
      <button class="add" onclick="addToCart('Lavender Scented Candles', 580)">Add To Cart</button>
    </div>

    <div class="candle2">
      <img src="images/peach.jpg" alt="Peach Scented Candles" />
      <p>Peach Scented Candles</p>
      <p>NPR.200</p>
      <button name="add" onclick="addToCart('Peach Scented Candles', 200)">Add To Cart</button>
    </div>

    <div class="candle4">
      <img src="images/aqua.jpg" alt="Aqua Scented Candles" />
      <p>Aqua Scented Candles</p>
      <p>NPR.600</p>
      <button name="add" onclick="addToCart('Aqua Scented Candles', 600)">Add To Cart</button>
    </div>
  </div>

  <!-- Bookmarks Section -->
  <div class="text">
    <h3>Bookmarks</h3>
    <div class="horizontal-line"></div>
  </div>

  <div class="Bookmark">
    <div class="bookmark1">
      <img src="images/bm1.jpg" alt="Paper Bookmark" />
      <p>Paper BookMark</p>
      <p>NPR.80</p>
      <button name="add" onclick="addToCart('Paper BookMark', 80)">Add To Cart</button>
    </div>

    <div class="bookmark2">
      <img src="images/bm2.webp" alt="Metal Bookmark" />
      <p>Metal BookMark</p>
      <p>NPR.700</p>
      <button name="add" onclick="addToCart('Metal BookMark', 700)">Add To Cart</button>
    </div>

    <div class="bookmark3">
      <img src="images/bm.jpg" alt="Acrylic Bookmark" />
      <p>Acrylic Customizable BookMark</p>
      <p>NPR.500</p>
      <button name="add" onclick="addToCart('Acrylic Customizable BookMark', 500)">Add To Cart</button>
    </div>
  </div>

 <div class="text">
  <h3>Our Services</h3>
  <div class="horizontal-line"></div>
</div>

<section class="ser">
  <div>
    <img src="images/del.jpg" alt="Home Delivery" />
    <h5>Home Delivery</h5>
  </div>

  <div>
    <a href="quality.html">
      <img src="images/qu.jpg" alt="Quality Assurance" />
      <h5>Quality Assurance</h5>
    </a>
  </div>

  <div>
    <img src="images/py.jpg" alt="Payment" />
    <h5>Payment</h5>
  </div>

  <div>
    <a href="return.html">
      <img src="images/ret.jpg" alt="Guarantee Return" />
      <h5>Guarantee Return</h5>
    </a>
  </div>
</section>

	<!--Starting of footer-->	
	<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h3>Customer Care</h3>
      <ul>
        <li><a href="#Help Center">Help Center</a></li>
        <li><a href="#How To Shop">How To Shop</a></li>
        <li><a href="#Gift Card">Gift Card</a></li>
        <li><a href="contact.html">Contact Us</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Learn More</h3>
      <ul>
        <li><a href="research.html">Research</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="#Terms & Conditions">Terms & Conditions</a></li>
        <li><a href="#Privacy Policy">Privacy Policy</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h3>Stay Connected</h3>
      <div class="social-icons">
        <a href="https://www.facebook.com/"><img src="images/facebook.jpg" alt="Facebook" width="30" height="30"></a>
        <a href="https://www.instagram.com/"><img src="images/insta.jpg" alt="Instagram" width="30" height="30"></a>
        <a href="https://web.whatsapp.com/"><img src="images/whatsapp.png" alt="WhatsApp" width="30" height="30"></a>
        <a href="https://twitter.com/"><img src="images/twitter.jpg" alt="Twitter" width="30" height="30"></a>
      </div>
    </div>
  </div>
</footer>

  <script>
    function addToCart(productName, price) {
      alert(productName + " added to cart for NPR " + price);

      document.getElementById('formProductName').value = productName;
      document.getElementById('formPrice').value = price;

      setTimeout(() => {
        document.getElementById('addToCartForm').submit();
      }, 100);
    }

    // Modal functions
  //   function showProductModal(name, price, imgSrc, description = "This is a lovely product you'll enjoy.") {
  //      // Optional: sanitize productName if you expect special chars
  // document.getElementById('formProductName').value = productName;
  // document.getElementById('formPrice').value = price;

  // document.getElementById('addToCartForm').submit();
  //     }
    

  //   function closeModal() {
  //     document.getElementById('productModal').style.display = 'none';
  //   }

  //   window.onclick = function (event) {
  //     const modal = document.getElementById('productModal');
  //     if (event.target == modal) {
  //       modal.style.display = "none";
  //     }
    //};
    // Show modal with product details
function showProductModal(name, price, imgSrc, description = "No description available.") {
  const modal = document.getElementById('productModal');
  document.getElementById('modalName').textContent = name;
  document.getElementById('modalPrice').textContent = "NPR " + price.toFixed(2);
  document.getElementById('modalImage').src = imgSrc;
  document.getElementById('modalImage').alt = name;
  document.getElementById('modalDescription').textContent = description;

  // Set up Add to Cart button inside modal
  const addToCartBtn = document.getElementById('modalAddToCart');
  addToCartBtn.onclick = function() {
    addToCart(name, price);
  };

  modal.style.display = 'block';
}

// Close modal
function closeModal() {
  document.getElementById('productModal').style.display = 'none';
}

// Close modal when clicking outside the modal content
window.onclick = function(event) {
  const modal = document.getElementById('productModal');
  if (event.target == modal) {
    modal.style.display = 'none';
  }
};

  </script>

  <form id="addToCartForm" action="addtocart.php" method="POST" style="display:none;">
    <input type="hidden" name="ProductName" id="formProductName" />
    <input type="hidden" name="Price" id="formPrice" />
  </form>
</body>
</html>