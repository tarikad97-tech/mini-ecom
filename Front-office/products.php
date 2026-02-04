<?php
// 1. Database Connection
$host = '127.0.0.1';
$db   = 'mini_ecommerce'; // From your SQL file
$user = 'root';
$pass = ''; // Default XAMPP password is empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Connection failed: " . $e->getMessage());
}

// 2. Fetch Categories for the sidebar
$catStmt = $pdo->query("SELECT * FROM categories");
$categories = $catStmt->fetchAll();

// 3. Fetch Products with their category names
$query = "SELECT p.*, c.name as category_name 
          FROM products p 
          JOIN categories c ON p.category_id = c.id";
$prodStmt = $pdo->query($query);
$products = $prodStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits - Mini E-com</title>
    <style>
        /* --- RESET & VARIABLES --- */
        :root {
            --primary: #2563eb;       /* Blue for actions */
            --secondary: #1e293b;     /* Dark for text/headings */
            --accent: #f59e0b;        /* Orange for accents/stars */
            --bg-light: #f8fafc;
            --white: #ffffff;
            --gray: #94a3b8;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--secondary);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HEADER & NAVIGATION --- */
        header {
            background-color: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--secondary);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }

        .cart-icon {
            position: relative;
        }

        .badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background: var(--primary);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50%;
        }

        /* --- MAIN LAYOUT --- */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
            display: grid;
            grid-template-columns: 250px 1fr; /* Sidebar | Content */
            gap: 2rem;
            flex: 1;
        }

        /* --- SIDEBAR FILTERS --- */
        .filters {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            height: fit-content;
            box-shadow: var(--shadow);
        }

        .filter-group {
            margin-bottom: 2rem;
        }

        .filter-title {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--bg-light);
        }

        .category-list {
            list-style: none;
        }

        .category-list li {
            margin-bottom: 0.8rem;
        }

        .category-list label {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #64748b;
        }

        .category-list input {
            margin-right: 10px;
            accent-color: var(--primary);
        }

        /* --- PRODUCT GRID --- */
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .sort-select {
            padding: 0.5rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--secondary);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 2rem;
        }

        /* --- PRODUCT CARD --- */
        .card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .card-img-container {
            height: 200px;
            background: #f1f5f9;
            overflow: hidden;
            position: relative;
        }

        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensures image covers area without stretching */
        }

        .card-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.9);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
        }

        .card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-category {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--secondary);
        }

        .card-desc {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.4;
            /* Limit to 2 lines */
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

        .price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        .btn-add {
            background-color: var(--secondary);
            color: var(--white);
            border: none;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        .btn-add:hover {
            background-color: var(--primary);
        }

        /* --- FOOTER --- */
        footer {
            background: var(--secondary);
            color: white;
            padding: 2rem;
            text-align: center;
            margin-top: auto;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            .filters {
                display: none; /* In a real app, maybe make this a toggle drawer */
            }
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="index.html" class="logo">Mini-Ecom</a>
            <ul class="nav-links">
                <li><a href="index.html">Accueil</a></li>
                <li><a href="products.html" class="active">Produits</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#" class="cart-icon">Panier <span class="badge">2</span></a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        
        <aside class="filters">
            <div class="filter-group">
                <h3 class="filter-title">Catégories</h3>
                <ul class="category-list">
                    <li>
                        <label>
                            <input type="checkbox" checked> Tout voir
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox"> Accessoires (3)
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox"> Cuisine (2)
                        </label>
                    </li>
                    <li>
                        <label>
                            <input type="checkbox"> Sport (1)
                        </label>
                    </li>
                </ul>
            </div>

            <div class="filter-group">
                <h3 class="filter-title">Prix</h3>
                <input type="range" min="0" max="500" style="width: 100%">
                <div style="display:flex; justify-content:space-between; font-size:0.9rem; margin-top:5px; color:gray;">
                    <span>0 Dhs</span>
                    <span>500 Dhs</span>
                </div>
            </div>
        </aside>

        <section class="products-area">
            <div class="products-header">
                <h2>Tous les produits</h2>
                <select class="sort-select">
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Nouveautés</option>
                </select>
            </div>

            <div class="grid">
                
                <article class="card">
                    <div class="card-img-container">
                        <img src="https://placehold.co/400x300/2563eb/white?text=Sac+à+dos" alt="Sac à dos" class="card-img">
                        <span class="card-badge">Accessoires</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Sac à dos</h3>
                        <p class="card-desc">Sac à dos pratique pour la ville.</p>
                        <div class="card-footer">
                            <span class="price">199.90 Dhs</span>
                            <button class="btn-add">Ajouter</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <div class="card-img-container">
                        <img src="https://placehold.co/400x300/f59e0b/white?text=Casquette" alt="Casquette" class="card-img">
                        <span class="card-badge">Accessoires</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Casquette</h3>
                        <p class="card-desc">Casquette simple et légère.</p>
                        <div class="card-footer">
                            <span class="price">59.00 Dhs</span>
                            <button class="btn-add">Ajouter</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <div class="card-img-container">
                        <img src="https://placehold.co/400x300/475569/white?text=Poêle" alt="Poêle" class="card-img">
                        <span class="card-badge">Cuisine</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Poêle 24cm</h3>
                        <p class="card-desc">Poêle antiadhésive de haute qualité.</p>
                        <div class="card-footer">
                            <span class="price">149.50 Dhs</span>
                            <button class="btn-add">Ajouter</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <div class="card-img-container">
                        <img src="https://placehold.co/400x300/475569/white?text=Couteau" alt="Couteau" class="card-img">
                        <span class="card-badge">Cuisine</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Couteau chef</h3>
                        <p class="card-desc">Couteau inox de cuisine.</p>
                        <div class="card-footer">
                            <span class="price">89.90 Dhs</span>
                            <button class="btn-add">Ajouter</button>
                        </div>
                    </div>
                </article>

                <article class="card">
                    <div class="card-img-container">
                        <img src="https://placehold.co/400x300/10b981/white?text=Gourde" alt="Gourde" class="card-img">
                        <span class="card-badge">Sport</span>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Gourde</h3>
                        <p class="card-desc">Gourde 1L réutilisable et écologique.</p>
                        <div class="card-footer">
                            <span class="price">39.90 Dhs</span>
                            <button class="btn-add">Ajouter</button>
                        </div>
                    </div>
                </article>

            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Mini-Ecom. Tous droits réservés.</p>
    </footer>

</body>
</html>