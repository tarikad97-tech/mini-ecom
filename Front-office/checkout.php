<!doctype html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <form id="checkout-form">
         
            <input type="text" class="form-control mb-3" id="name" placeholder="Full Name" required>
            <input type="text" class="form-control mb-3" id="phone" placeholder="Phone" required>
            <input type="text" class="form-control mb-3" id="address" placeholder="Address" required>
            <input type="text" class="form-control mb-3" id="city" placeholder="City" required>

            
            <div class="card p-3 mb-3">
                <h5 class="mb-3">Payment Details</h5>
                <input type="text" class="form-control mb-3" id="card-number" placeholder="Card Number" required>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="expiry" placeholder="MM/YY" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100">
                Confirm Order
            </button>
        </form>
    </div>
    
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Account / Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="register-form">
          <input type="text" class="form-control mb-3" id="reg-name" placeholder="Full Name" required>
          <input type="email" class="form-control mb-3" id="reg-email" placeholder="Email" required>
          <input type="password" class="form-control mb-3" id="reg-password" placeholder="Password" required>
          <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <hr>
        <form id="login-form">
          <input type="email" class="form-control mb-3" id="login-email" placeholder="Email" required>
          <input type="password" class="form-control mb-3" id="login-password" placeholder="Password" required>
          <button type="submit" class="btn btn-success w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <script src="js/checkout.js"></script>
</body>
</html>