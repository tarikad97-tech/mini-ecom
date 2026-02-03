<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Your Cart</h1>
    <nav>
      <a href="products.html">Products</a>
      <a href="checkout.html">Checkout</a>
    </nav>
  </header>

  <main>
    <table id="cart-table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody id="cart-items">
        <!-- JS will fill this -->
      </tbody>
    </table>

    <div id="cart-total" style="margin-top: 20px;"></div>

    <div style="text-align: right; margin-top: 20px;">
      <button onclick="window.location.href='checkout.html'">Go to Checkout</button>
    </div>
  </main>

  <script src="js/cart.js"></script>
</body>
</html>