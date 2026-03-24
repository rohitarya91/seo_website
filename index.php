<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Harvest Fresh: Organic fruits, vegetables, and farm-fresh products delivered directly from local farmers to your table." />
  <meta name="keywords"
    content="organic produce, fresh vegetables, farm-to-table, local farming, healthy food delivery" />
  <title>🌿Harvest Fresh</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <!-- Removed login CSS tag from here -->
  <!-- Removed empty link tag: <link rel="stylesheet" href="./" -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <!-- CSS Start -->
  <style>
  /* ================= ROOT COLORS ================= */
:root {
  --bg-dark: #0f172a;
  --green: #22c55e;
  --green-dark: #16a34a;
  --glass: rgba(255,255,255,0.08);
  --text: #ffffff;
  --muted: rgba(255,255,255,0.7);
}

/* ================= RESET ================= */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  scroll-behavior: smooth;
}

/* ================= BODY ================= */
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #0f172a, #14532d);
  color: var(--text);
}

/* ================= COMMON ================= */
a {
  text-decoration: none;
  color: inherit;
}

.container {
  width: 90%;
  max-width: 1100px;
  margin: auto;
}

section {
  padding: 60px 20px;
  margin: 20px;
  border-radius: 20px;
  background: var(--glass);
  backdrop-filter: blur(10px);
}

h2 {
  text-align: center;
  margin-bottom: 40px;
  font-size: 34px;
}

/* ================= NAVBAR ================= */
/* NAVBAR */
#navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 25px;
  margin: 15px;
  
  background: rgba(255,255,255,0.08);
  backdrop-filter: blur(12px);
  border-radius: 15px;
  position: sticky;
  top: 10px;
  z-index: 1000;
  /* position: relative; */
}

/* LOGO */
#logo {
  font-size: 22px;
  font-weight: 600;
}

/* NAV LINKS */
#nav-links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 20px;
}

#nav-links a {
  font-size: 16px;
  color: #fff;
  transition: 0.3s;
}

#nav-links a:hover {
  color: #22c55e;
}

/* LOGIN BUTTON */
.nav-btn {
  background: #22c55e;
  padding: 8px 18px;
  border-radius: 20px;
}

.nav-btn:hover {
  background: #16a34a;
  color: #fff;
}

/* MENU ICON */
#menu-icon {
  display: none;
  font-size: 22px;
  cursor: pointer;
}@media (max-width: 768px) {

  #menu-icon {
    display: block;
  }

  #nav-links {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;

    flex-direction: column;
    padding: 20px;

    background: rgba(0,0,0,0.95);
    border-radius: 0 0 15px 15px;

    display: none;
  }

  #nav-links.show {
    display: flex !important;
  }

}

/* ================= MOBILE ================= */
@media (max-width: 768px) {

  #menu-icon {
    display: block;
  }

  #nav-links {
    position: absolute;
    top: 70px;
    right: 0;

    width: 220px;
    flex-direction: column;
    padding: 20px;

    background: rgba(0,0,0,0.9);
    border-radius: 10px;

    display: none;
  }

  #nav-links.show {
    display: flex;
  }

  #nav-links li {
    margin: 10px 0;
  }
}

/* ================= HERO ================= */
.hero {
  height: 90vh;
  margin: 20px;
  border-radius: 25px;

  background:
    linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
    url("https://images.unsplash.com/photo-1542838132-92c53300491e");

  background-size: cover;
  background-position: center;

  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.hero-content {
  max-width: 700px;
}

.hero-content h1 {
  font-size: 50px;
  font-weight: 700;
}

.hero-content p {
  color: var(--muted);
  margin: 15px 0;
  font-size: 18px;
}

/* ================= BUTTON ================= */
.btn {
  display: inline-block;
  padding: 12px 28px;
  background: var(--green);
  border-radius: 30px;
  color: #fff;
  transition: 0.3s;
}

.btn:hover {
  background: var(--green-dark);
  transform: scale(1.05);
}

/* ================= ABOUT ================= */
.about-content {
  display: flex;
  align-items: center;
  gap: 30px;
}

.about-content img {
  width: 45%;
  border-radius: 12px;
}

.about-content p {
  color: var(--muted);
  line-height: 1.7;
}

/* ================= CARDS ================= */
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 25px;
}

.card {
  padding: 20px;
  text-align: center;
  border-radius: 20px;
  background: var(--glass);
  backdrop-filter: blur(10px);
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-10px) scale(1.03);
  box-shadow: 0 10px 40px rgba(34,197,94,0.4);
}

.card img {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  margin-bottom: 10px;
}

.card h3 {
  margin-bottom: 10px;
}

.card p {
  color: var(--muted);
  font-size: 14px;
}

/* ================= CONTACT ================= */
.contact form {
  max-width: 500px;
  margin: auto;
  display: flex;
  flex-direction: column;
}

.contact input,
.contact textarea {
  padding: 12px;
  margin-bottom: 15px;
  border-radius: 8px;
  border: 1px solid rgba(255,255,255,0.2);
  background: rgba(255,255,255,0.1);
  color: #fff;
}

.contact input::placeholder,
.contact textarea::placeholder {
  color: rgba(255,255,255,0.6);
}

.contact button {
  padding: 12px;
  background: var(--green);
  border: none;
  border-radius: 25px;
  color: #fff;
  cursor: pointer;
}

.contact button:hover {
  background: var(--green-dark);
}

/* ================= FOOTER ================= */
footer {
  background: rgba(0,0,0,0.6);
  padding: 40px 20px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {

  .about-content {
    flex-direction: column;
    text-align: center;
  }

  .about-content img {
    width: 100%;
  }

  #nav-links {
    display: none;
  }

}

/* ====================================================== */
 
/* ====================================================== */
  </style>
  <!-- css End -->
</head>

<body>
  <!-- Header -->
<nav id="navbar">
  <div id="logo">🌿Harvest Fresh</div>

  <div id="menu-icon" onclick="toggleMenu()">
    <i class="fas fa-bars"></i>
  </div>

  <ul id="nav-links">
    <li><a href="#home">Home</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#services">Shop</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="./auth/login.php" class="nav-btn">Login</a></li>
  </ul>
</nav>

  <!-- Hero Section -->
  <section id="home" class="hero">
    <div class="hero-content">
      <h1 id="mainText">Fresh From Farm to Your Table</h1>
      <p>
        Organic fruits, vegetables, and farm-fresh products delivered with
        care.
      </p>
      <a href="./auth/login.php" class="btn">Shop Fresh</a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="about">
    <div class="container">
      <h2>About Harvest Fresh</h2>
      <div class="about-content">
        <img
          src="https://imgs.search.brave.com/jNhXjk55Vd-TRGcd_4LeotpvSoQLE3MVA9gEsDJfpcU/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly90My5m/dGNkbi5uZXQvanBn/LzAwLzg2LzEzLzc2/LzM2MF9GXzg2MTM3/NjQ3X29vVVJFSW85/YTluRDNaQVhjdXpr/aThoUExoSHZOT2Mx/LmpwZw"
          alt="Fresh farm produce including various fruits and vegetables" />
        <p>
          Harvest Fresh is committed to delivering organic fruits, vegetables,
          and farm products directly from local farmers to your home. We
          believe in healthy living, sustainable farming, and fresh food you
          can trust.
        </p>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="services">
    <div class="container">
      <h2>What We Offer</h2>

      <div class="cards">
        <a href="./auth/login.php">
          <div class="card">
            <img
              src="https://imgs.search.brave.com/GVZKzl3BWeHTlYKbf4IjloTo0BSmQaLs-nP1y9xKl5A/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMudmVjdGVlenku/Y29tL3N5c3RlbS9y/ZXNvdXJjZXMvdGh1/bWJuYWlscy8wNTUv/MDMwLzU0Ny9zbWFs/bC9hLWJhc2tldC1v/Zi12ZWdldGFibGVz/LXBuZy5wbmc"
              alt="Basket of fresh vegetables including potatoes, tomatoes, and onions" />
            <h3>Fresh Vegetables</h3>
            <p>
              Handpicked seasonal vegetables grown using natural and organic
              farming methods.
            </p>
          </div>
        </a>

        <a href="./auth/login.php">
          <div class="card">
            <img
              src="https://imgs.search.brave.com/FlxMF05-1rH248VBIZmwV82CcO95weY6cNshZrvQbeE/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMudmVjdGVlenku/Y29tL3N5c3RlbS9y/ZXNvdXJjZXMvdGh1/bWJuYWlscy8wMjcv/NzkzLzY3My9zbWFs/bC9mcmVzaC1mcnVp/dHMtZmFsbGluZy1p/bi13YXRlci1zcGxh/c2gtYWktZ2VuZXJl/dGl2ZS1mcmVlLXBo/b3RvLmpwZw"
              alt="Basket full of fresh fruits including bananas, apples, and grapes" />
            <h3>Organic Fruits</h3>
            <p>
              Juicy, chemical-free fruits sourced directly from trusted local
              farms.
            </p>
          </div>
        </a>

        <div class="card">
          <img
            src="https://imgs.search.brave.com/9OCRlzxkc_wr6-1fu0xIIYFHGOJ1k3xYyRZLM54_DUo/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9zdGF0/aWMudmVjdGVlenku/Y29tL3N5c3RlbS9y/ZXNvdXJjZXMvdGh1/bWJuYWlscy8wNTAv/NDM3Lzc5Ny9zbWFs/bC9mcmVzaC1mcnVp/dC1kZWxpdmVyeS1z/ZXJ2aWNlLXRydWNr/LWlsbHVzdHJhdGlv/bi12ZWN0b3IuanBn"
            alt="Illustration of a truck delivering fresh fruit" />
          <h3>Fast Delivery</h3>
          <p>
            Quick and safe delivery ensuring freshness from farm to your
            doorstep.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact">
    <div class="container">
      <h2>Get In Touch</h2>
      <form id="contactForm" onsubmit="handleSubmit(event)">
        <input type="text" placeholder="Your Name" required />
        <input type="email" placeholder="Your Email" required />
        <textarea placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
      </form>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="bg-dark text-white mt-5 p-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Harvest Fresh</h5>
          <p>Farm to table freshness.</p>
        </div>

        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a class="text-white" href="#home">Home</a></li>
            <li><a class="text-white" href="#services">Shop</a></li>
            <li><a class="text-white" href="#contact">Contact</a></li>
          </ul>
        </div>

        <div class="col-md-4">
          <h5>Follow Us</h5>
          <ul class="list-unstyled">
            <li>
              <a class="text-white" href="#" aria-label="Facebook">
                <i>Facebook</i>
              </a>
            </li>
            <li>
              <a class="text-white" href="#" aria-label="Instagram"><i>Instagram</i></a>
            </li>
            <li>
              <a class="text-white" href="#" aria-label="Twitter"><i>Twitter</i></a>
            </li>
          </ul>
        </div>
      </div>

      <hr />
      <p class="text-center mb-0">&copy; 2024 Harvest Fresh</p>
    </div>
  </footer>
  <!-- ================= FOOTER END ================= -->

  <script>
    function toggleMenu() {
      document.getElementById("nav-links").classList.toggle("show");
    }

    function handleSubmit(event) {
      event.preventDefault(); // Prevent actual form submission
      alert("Thank you for your message! We'll get back to you soon.");
      // In a real app, you'd send this data to a server via AJAX or similar
    }
  </script>
</body>

</html>
<script>
  function toggleMenu() {
  document.getElementById("nav-links").classList.toggle("show");
}
</script>