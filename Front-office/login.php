<!doctype html>
<html lang="en">
    <head>
        <title>Login - Mini E-commerce</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="assets/css/login.css">
    </head>

    <body>
        <div class="container">
            <div class="login-container">
                <div class="row g-0">
                    <!-- Left Side - Welcome Section -->
                    <div class="col-md-5 login-left">
                        <i class="bi bi-shop" style="font-size: 4rem; margin-bottom: 20px;"></i>
                        <h2>Welcome Back!</h2>
                        <p>Sign in to continue shopping and manage your account</p>
                    </div>
                    
                    <!-- Right Side - Login Form -->
                    <div class="col-md-7 login-right">
                        <h3>Sign In</h3>
                        <p>Enter your credentials to access your account</p>
                        
                        <form id="loginfrm">
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email"
                                        placeholder="Enter your email"
                                        required
                                    />
                                </div>
                            </div>
                            
                            <!-- Password Field -->
                            <div class="mb-3">
                               
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Enter your password"
                                        required
                                    />
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <a href="#" class="forgot-password">Forgot Password?</a>
                                </div>
                            </div>
                            
                        
                     
                            
                            <!-- Login Button -->
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>
                                    Sign In
                                </button>
                            </div>
                            
                            <!-- Divider -->
                            <div class="divider">
                                <span>OR</span>
                            </div>
                            
                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="mb-0">
                                    Don't have an account? 
                                    <a href="register.php" class="register-link">Sign Up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   <!-- script login -->
    <script src="assets/js/login.js"></script>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
