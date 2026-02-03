<?php
// 1. DATABASE CONNECTION
$host = 'localhost';
$dbname = 'mini_ecommerce';
$username = 'root'; // Change if needed
$password = '';     // Change if needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// 2. FETCH PRODUCTS & CATEGORIES
// We perform a LEFT JOIN to get the category name for each product
$query = "SELECT p.*, c.name AS category_name 
          FROM products p 
          LEFT JOIN categories c ON p.category_id = c.id 
          ORDER BY p.created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products | Mini E-Com</title>
    <style>
        /* CSS STYLES */
        :root {
            --primary: #2563eb;
            --secondary: #1e293b;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text: #334155;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        body { background-color: var(--bg); color: var(--text); padding-bottom: 50px; }

        /* Navbar */
        .navbar {
            background: var(--secondary);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .nav-brand { font-size: 1.5rem; font-weight: bold; }
        .cart-icon { position: relative; cursor: pointer; }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            padding: 2px 6px;
            border-radius: 50%;
        }

        /* Container */
        .container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .page-title { margin-bottom: 2rem; text-align: center; color: var(--secondary); }

        /* Grid System */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        /* Product Card */
        .card {
            background: var(--card-bg);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }

        .card-img-container {
            height: 200px;
            overflow: hidden;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-img { width: 100%; height: 100%; object-fit: cover; }
        
        .card-body { padding: 1.5rem; flex-grow: 1; display: flex; flex-direction: column; }
        
        .category-tag {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--primary);
            font-weight: bold;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }
        
        .product-name { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--secondary); }
        
        .product-desc {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price { font-size: 1.5rem; font-weight: bold; color: var(--secondary); }
        
        .btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn:hover { background: #1d4ed8; }
        
        .btn:disabled { background: #cbd5e1; cursor: not-allowed; }

        .out-of-stock { color: var(--danger); font-weight: bold; font-size: 0.9rem; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">MiniShop</div>
        <div class="cart-icon" onclick="alert('Redirect to cart page...')">
            <span>🛒 Cart</span>
            <span class="cart-badge" id="cart-count">0</span>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Latest Products</h1>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <?php 
                    // Safety check for image
                    $imgSrc = !empty($product['image']) ? htmlspecialchars($product['image']) : 'https://via.placeholder.com/300?text=No+Image';
                    $isOutOfStock = $product['stock'] <= 0;
                ?>
                <div class="card">
                    <div class="card-img-container">
                        <img src="<?= $imgSrc ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="card-img">
                    </div>
                    <div class="card-body">
                        <div class="category-tag">
                            <?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>
                        </div>
                        <h2 class="product-name"><?= htmlspecialchars($product['name']) ?></h2>
                        <p class="product-desc"><?= htmlspecialchars($product['description']) ?></p>
                        
                        <div class="card-footer">
                            <div class="price">$<?= number_format($product['price'], 2) ?></div>
                            
                            <?php if ($isOutOfStock): ?>
                                <span class="out-of-stock">Out of Stock</span>
                            <?php else: ?>
                                <button class="btn" onclick="addToCart(
                                    <?= $product['id'] ?>, 
                                    '<?= htmlspecialchars($product['name'], ENT_QUOTES) ?>', 
                                    <?= $product['price'] ?>
                                )">
                                    Add to Cart
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if (empty($products)): ?>
            <p style="text-align:center; padding: 2rem;">No products found in the database.</p>
        <?php endif; ?>
    </div>

    <script>
        // Initialize Cart from LocalStorage
        let cart = JSON.parse(localStorage.getItem('miniShopCart')) || [];
        updateCartCount();

        function addToCart(id, name, price) {
            // Check if item exists
            const existingItem = cart.find(item => item.id === id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            // Save to LocalStorage
            localStorage.setItem('miniShopCart', JSON.stringify(cart));
            updateCartCount();
            
            // Simple visual feedback
            alert(`${name} added to cart!`);
        }

        function updateCartCount() {
            const count = cart.reduce((total, item) => total + item.quantity, 0);
            document.getElementById('cart-count').innerText = count;
        }
    </script>

</body>
</html>