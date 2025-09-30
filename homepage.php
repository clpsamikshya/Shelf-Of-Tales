<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shelf of Tales</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-image: url(images/bgg.png);
      background-size: cover;
      background-repeat: no-repeat;
      font-family: 'Arial', sans-serif;
      line-height: 1.6;
      color: #555; /* Soft grey for text */
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Header */
    .header {
      background-color: #D8BFD8; /* Lavender */
      padding: 20px 0;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-size: 2.5rem;
      color: grey;
    }

    .navigation {
      text-align: right;
      margin-top: -35px;
    }

    .navigation ul {
      list-style: none;
    }

    .navigation ul li {
      display: inline-block;
      margin-left: 25px;
    }

    .navigation ul li a {
      text-decoration: none;
      color: white;
      font-size: 1.1rem;
      padding: 5px 10px;
      transition: background 0.3s ease;
      border-radius: 4px;
    }

    .navigation ul li a:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    /* Section */
    .section {
      background-color: rgba(255, 255, 255, 0.92);
      padding: 60px 0;
    }

    .section h2 {
      text-align: center;
      font-size: 2rem;
      color: #6c6c6c;
      margin-bottom: 40px;
    }

    /* Service Grid */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 30px;
    }

    .service {
      background-color: #fff;
      border: 1px solid #e0e0e0;
      padding: 25px;
      border-radius: 10px;
      transition: box-shadow 0.3s ease;
      color: #444;
    }

    .service:hover {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .service h3 {
      font-size: 1.4rem;
      color: grey;
      margin-bottom: 12px;
    }

    .service p {
      font-size: 1.05rem;
      line-height: 1.5;
      color: #666;
    }

    /* Responsive Navigation */
    @media (max-width: 768px) {
      .logo {
        text-align: center;
        margin-bottom: 10px;
      }

      .navigation {
        text-align: center;
        margin-top: 10px;
      }

      .navigation ul li {
        display: block;
        margin: 10px 0;
      }
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="container">
      <h1 class="logo">Shelf of Tales</h1>
      <nav class="navigation">
        <ul>
          <li><a href="login.php">Login</a></li>
          <li><a href="index1.php">Register</a></li>
          <li><a href="aboutus.html">About Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section id="services" class="section">
    <div class="container">
      <h2>Our Products</h2>
      <div class="services-grid">
        <div class="service">
          <h3>Wide Range of Titles</h3>
          <p>Explore a diverse collection of books spanning genres like fiction, non-fiction, children's books, and more.</p>
        </div>
        <div class="service">
          <h3>Candles</h3>
          <p>Make your reading experience more soothing and enjoyable. Enrich your connection with your favorite books.</p>
        </div>
        <div class="service">
          <h3>Bookmarks</h3>
          <p>Bookmarks are indispensable companions to books, offering both practical utility and personalization while enriching the reading experience.</p>
        </div>
        <div class="service">
          <h3>Gift Box</h3>
          <p>Surprise your loved ones with an exclusive gift box. Build your own box by selecting books and adding extras like bookmarks or snacks.</p>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
