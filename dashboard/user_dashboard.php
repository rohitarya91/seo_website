<?php
require_once __DIR__ . '/../config/store.php';

require_login();

if (is_admin()) {
  redirect_to('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';
  $productId = (int) ($_POST['product_id'] ?? 0);
  $redirectSection = $_POST['redirect_section'] ?? 'shop';

  if ($action === 'add_to_cart' && $productId > 0) {
    add_to_cart($productId, 1);
    set_flash('success', 'Product added to cart.');
    redirect_to('user_dashboard.php?section=' . urlencode($redirectSection));
  }
}

$flash = get_flash();
$section = $_GET['section'] ?? 'home';
$search = trim($_GET['search'] ?? '');
$products = fetch_all_products($conn, $search);
$homeProducts = array_slice(fetch_all_products($conn), 0, 10);
$orders = fetch_user_orders($conn, (int) $_SESSION['user_id']);
$cart = get_cart_totals($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harvest Fresh</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard.css">
  <style>
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
    }

    #logo {
      font-size: 22px;
      font-weight: 600;
    }

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
      text-decoration: none;
    }

    #nav-links a:hover {
      color: #22c55e;
    }

    #menu-icon {
      display: none;
      font-size: 22px;
      cursor: pointer;
    }

    .section-page {
      display: none;
    }

    .section-page.active {
      display: block;
    }

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
        display: flex !important;
      }

      #nav-links li {
        margin: 10px 0;
      }
    }
  </style>
</head>

<body class="page">
  <div class="page-shell">
    <aside class="glass-panel side-panel">
      <div class="brand">
        <h2>Harvest Fresh</h2>
      </div>

      <ul class="nav-list">
        <li><a href="#" onclick="showSection('home', event)" class="<?php echo $section === 'home' ? 'active' : ''; ?>"><i class="fa-solid fa-home"></i> Home</a></li>
        <li><a href="#" onclick="showSection('shop', event)" class="<?php echo $section === 'shop' ? 'active' : ''; ?>"><i class="fa-solid fa-store"></i> Shop</a></li>
        <li><a href="#" onclick="showSection('orders', event)" class="<?php echo $section === 'orders' ? 'active' : ''; ?>"><i class="fa-solid fa-bag-shopping"></i> My Orders</a></li>
        <li><a href="#" onclick="showSection('profile', event)" class="<?php echo $section === 'profile' ? 'active' : ''; ?>"><i class="fa-solid fa-user"></i> Account</a></li>
      </ul>

      <div class="profile-card bottom-profile">
        <div class="profile-avatar"><?php echo e(get_avatar_letter(current_user_name())); ?></div>
        <h3><?php echo e(current_user_name()); ?></h3>
        <a href="../auth/logout.php" class="logout-btn">
          <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
      </div>
    </aside>

    <main class="glass-panel main-panel">
      <nav id="navbar">
        <div id="logo">Harvest Fresh</div>

        <div id="menu-icon" onclick="toggleMenu()">
          <i class="fas fa-bars"></i>
        </div>

        <ul id="nav-links">
          <li><a href="#home" onclick="showSection('home', event)">Home</a></li>
          <li>
            <form method="GET" class="panel-actions">
              <input type="hidden" name="section" value="shop">
              <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Search products..." class="search-bar">
            </form>
          </li>
          <li><a href="cart.php" class="btn-primary cart-link"><i class="fa-solid fa-cart-shopping"></i> View Cart (<?php echo e((string) $cart['total_items']); ?>)</a></li>
        </ul>
      </nav>

      <div class="panel-header">
        <div class="panel-title">
          <h1>Welcome, <?php echo e(current_user_name()); ?></h1>
          <p class="muted">Explore fresh products and track your orders.</p>
        </div>
      </div>

      <?php if ($flash): ?>
        <div class="content-card message-card <?php echo $flash['type'] === 'success' ? 'success-card' : 'error-card'; ?>">
          <p><?php echo e($flash['message']); ?></p>
        </div>
      <?php endif; ?>

      <section id="home-section" class="section-page <?php echo $section === 'home' ? 'active' : ''; ?>">
        <div class="home-hero">
          <div class="home-hero-overlay"></div>
          <div class="home-hero-content">
            <span class="hero-badge">Fresh Grocery Delivery</span>
            <h2>Fresh &amp; Organic Products</h2>
            <p>Farm-fresh fruits, vegetables, dairy, and daily essentials delivered in 25-40 minutes with the same trusted quality.</p>
            <div class="hero-actions">
              <button type="button" class="btn-primary" onclick="openSection('shop')">Shop Now</button>
              <a href="cart.php" class="btn-ghost">View Cart</a>
            </div>
          </div>
        </div>

        <div class="content-card home-section-card">
          <div class="section-head">
            <div>
              <h2>Shop by Category</h2>
              <p class="muted">Quickly explore your everyday essentials.</p>
            </div>
          </div>

          <div class="category-strip">
            <div class="category-chip">
              <span><i class="fa-solid fa-carrot"></i></span>
              <h4>Vegetables</h4>
            </div>
            <div class="category-chip">
              <span><i class="fa-solid fa-apple-whole"></i></span>
              <h4>Fruits</h4>
            </div>
            <div class="category-chip">
              <span><i class="fa-solid fa-bottle-water"></i></span>
              <h4>Dairy</h4>
            </div>
            <div class="category-chip">
              <span><i class="fa-solid fa-bread-slice"></i></span>
              <h4>Bakery</h4>
            </div>
            <div class="category-chip">
              <span><i class="fa-solid fa-bag-shopping"></i></span>
              <h4>Daily Needs</h4>
            </div>
          </div>
        </div>

        <div class="content-card home-section-card">
          <div class="section-head">
            <div>
              <h2>Popular Products</h2>
              <p class="muted">Top fresh picks from your store.</p>
            </div>
            <button type="button" class="btn-ghost" onclick="openSection('shop')">Browse All</button>
          </div>

          <div class="home-product-grid">
            <?php if (empty($homeProducts)): ?>
              <div class="product-card">
                <h4>No products available</h4>
                <p>Add products from the admin panel to show them here.</p>
              </div>
            <?php endif; ?>

            <?php foreach ($homeProducts as $product): ?>
              <div class="product-card home-product-card shop-product-card wide-product-card">
                <div class="shop-product-image home-product-image">
                  <img src="<?php echo e(product_image_src($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
                </div>
                <div class="home-product-body">
                  <h4><?php echo e($product['name']); ?></h4>
                  <p class="price">Rs <?php echo e((string) $product['price']); ?></p>
                  <p class="product-desc"><?php echo e(product_short_description($product['description'], 90)); ?></p>
                </div>
                <form method="POST" class="home-cart-form">
                  <input type="hidden" name="action" value="add_to_cart">
                  <input type="hidden" name="product_id" value="<?php echo e((string) $product['id']); ?>">
                  <input type="hidden" name="redirect_section" value="home">
                  <button type="submit" class="btn-primary full-btn">Add to Cart</button>
                </form>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section id="shop-section" class="section-page <?php echo $section === 'shop' ? 'active' : ''; ?>">
        <div class="stats-grid">
          <div class="stat-card">
            <h3>My Orders</h3>
            <strong><?php echo e((string) count($orders)); ?></strong>
          </div>

          <div class="stat-card">
            <h3>Products</h3>
            <strong><?php echo e((string) count($products)); ?></strong>
          </div>

          <div class="stat-card">
            <h3>Cart Items</h3>
            <strong><?php echo e((string) $cart['total_items']); ?></strong>
          </div>
        </div>

        <div class="content-card">
          <h2>Shop Fresh Products</h2>

          <div class="product-grid shop-grid-wide">
            <?php if (empty($products)): ?>
              <div class="product-card">
                <h4>No products found</h4>
                <p>Try another search term.</p>
              </div>
            <?php endif; ?>

            <?php foreach ($products as $product): ?>
              <div class="product-card shop-product-card wide-product-card">
                <div class="shop-product-image">
                  <img src="<?php echo e(product_image_src($product['image'])); ?>" alt="<?php echo e($product['name']); ?>">
                </div>
                <div class="shop-product-body">
                  <h4><?php echo e($product['name']); ?></h4>
                  <p class="price">Rs <?php echo e((string) $product['price']); ?></p>
                  <p class="product-desc"><?php echo e(product_short_description($product['description'], 100)); ?></p>
                </div>
                <form method="POST" class="shop-cart-form">
                  <input type="hidden" name="action" value="add_to_cart">
                  <input type="hidden" name="product_id" value="<?php echo e((string) $product['id']); ?>">
                  <input type="hidden" name="redirect_section" value="shop">
                  <button type="submit" class="btn-primary full-btn">Add to Cart</button>
                </form>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <section id="orders-section" class="section-page <?php echo $section === 'orders' ? 'active' : ''; ?>">
        <div class="content-card">
          <h2>Recent Orders</h2>

          <?php if (empty($orders)): ?>
            <p class="muted">You have not placed any orders yet.</p>
          <?php else: ?>
            <?php foreach ($orders as $order): ?>
              <div class="order-item">
                <p>Order #<?php echo e((string) $order['id']); ?> - <?php echo e($order['status']); ?> - Rs <?php echo e((string) $order['total_amount']); ?></p>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </section>

      <section id="profile-section" class="section-page <?php echo $section === 'profile' ? 'active' : ''; ?>">
        <div class="content-card">
          <h2>My Profile</h2>

          <div class="data-row">
            <span>Name</span>
            <strong><?php echo e(current_user_name()); ?></strong>
          </div>

          <div class="data-row">
            <span>Email</span>
            <strong><?php echo e(current_user_email()); ?></strong>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>

</html>
<script>
  function activateSection(section) {
    document.querySelectorAll('.section-page').forEach(sec => {
      sec.classList.remove('active');
    });

    document.getElementById(section + '-section').classList.add('active');

    document.querySelectorAll('.nav-list a').forEach(link => {
      link.classList.remove('active');
    });

    const activeLink = document.querySelector(`.nav-list a[onclick*="'${section}'"]`);
    if (activeLink) {
      activeLink.classList.add('active');
    }
  }

  function showSection(section, event) {
    event.preventDefault();
    activateSection(section);

    if (event.currentTarget) {
      event.currentTarget.classList.add('active');
    }
  }

  function openSection(section) {
    activateSection(section);
  }

  function toggleMenu() {
    document.getElementById("nav-links").classList.toggle("show");
  }
</script>
