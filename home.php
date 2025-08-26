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
        <a href="cart.php"
          ><img src="images/cart.jpg.png" alt="Cart" width="30"
        /></a>
        <input type="text" placeholder="Search..." />
        <a href="logout.php">Logout</a>
      </div>
    </div>
  </header>

  <!-- <section class="offer">
    <h1>CHOOSE YOUR AESTHETIC</h1>
    <h2>SALE UPTO 40%</h2>
    <p style="text-align: right; max-width: 600px; margin-left: auto;">
      We care for your interest and enthusiasm about books.
    </p>
    <p>So we provide you with the best offers.</p>
    <div>
      <img
        src="images/read.webp"
        alt="Reading Image"
        id="fairy"
        style="max-width: 320px; border-radius: 10px; box-shadow: 0 6px 12px rgba(156,90,176,0.3);"
      />
      <img
        src="images/st.webp"
        alt="Books Image"
        style="max-width: 320px; border-radius: 10px; box-shadow: 0 6px 12px rgba(156,90,176,0.3);"
      />
    </div>
  </section> -->

  <section class="ser">
    <div>
      <img src="images/del.jpg" alt="Home Delivery" />
      <h5>Home Delivery</h5>
    </div>

    <div>
      <img src="images/py.jpg" alt="Payment" />
      <h5>Payment</h5>
    </div>

    <div>
      <img src="images/qu.jpg" alt="Quality Assurance" />
      <h5>Quality Assurance</h5>
    </div>

    <div>
      <img src="images/ret.jpg" alt="Guarantee Return" />
      <h5>Guarantee Return</h5>
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
      <p>NPR.1580</p>
      <button class="add" onclick="addToCart('Lavender Scented Candles', 1580)">Add To Cart</button>
    </div>

    <div class="candle2">
      <img src="images/peach.jpg" alt="Peach Scented Candles" />
      <p>Peach Scented Candles</p>
      <p>NPR.2100</p>
      <button name="add" onclick="addToCart('Peach Scented Candles', 2100)">Add To Cart</button>
    </div>

    <div class="candle4">
      <img src="images/aqua.jpg" alt="Aqua Scented Candles" />
      <p>Aqua Scented Candles</p>
      <p>NPR.4600</p>
      <button name="add" onclick="addToCart('Aqua Scented Candles', 4600)">Add To Cart</button>
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
      <p>NPR.750</p>
      <button name="add" onclick="addToCart('Acrylic Customizable BookMark', 750)">Add To Cart</button>
    </div>
  </div>
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
    function showProductModal(name, price, imgSrc, description = "This is a lovely product you'll enjoy.") {
       // Optional: sanitize productName if you expect special chars
  document.getElementById('formProductName').value = productName;
  document.getElementById('formPrice').value = price;

  document.getElementById('addToCartForm').submit();
      }
    

    function closeModal() {
      document.getElementById('productModal').style.display = 'none';
    }

    window.onclick = function (event) {
      const modal = document.getElementById('productModal');
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  </script>

  <form id="addToCartForm" action="addtocart.php" method="POST" style="display:none;">
    <input type="hidden" name="ProductName" id="formProductName" />
    <input type="hidden" name="Price" id="formPrice" />
  </form>
</body>
</html>