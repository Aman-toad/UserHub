<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UserHub - Smart User Management Platform</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-users-cog me-2"></i>UserHub</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="auth/login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="hero-card text-center fade-in">
            <div class="mb-4">
              <i class="fas fa-users-cog" style="font-size: 4rem; color: #00d4ff;"></i>
            </div>
            <h1 class="display-4 fw-bold mb-4">
              Welcome to <span style="color: #00d4ff;">UserHub</span>
            </h1>
            <p class="lead mb-4 opacity-90">
              The most advanced user management platform designed for modern businesses. 
              Secure, scalable, and incredibly easy to use.
            </p>
            <div class="d-flex flex-column flex-md-row gap-3 justify-content-center mb-4">
              <a href="auth/register.php" class="btn btn-primary-custom btn-lg">
                <i class="fas fa-rocket me-2"></i>Get Started Free
              </a>
              <a href="auth/login.php" class="btn btn-outline-custom btn-lg">
                <i class="fas fa-sign-in-alt me-2"></i>Login
              </a>
            </div>
            <div class="row text-center mt-5">
              <div class="col-md-4">
                <i class="fas fa-shield-alt text-info mb-2" style="font-size: 2rem;"></i>
                <p class="small">Enterprise Security</p>
              </div>
              <div class="col-md-4">
                <i class="fas fa-bolt text-warning mb-2" style="font-size: 2rem;"></i>
                <p class="small">Lightning Fast</p>
              </div>
              <div class="col-md-4">
                <i class="fas fa-heart text-danger mb-2" style="font-size: 2rem;"></i>
                <p class="small">Built with Love</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats">
    <div class="container">
      <div class="row">
        <div class="col-md-3 stat-item fade-in">
          <div class="stat-number">10K+</div>
          <p class="text-muted">Active Users</p>
        </div>
        <div class="col-md-3 stat-item fade-in">
          <div class="stat-number">99.9%</div>
          <p class="text-muted">Uptime</p>
        </div>
        <div class="col-md-3 stat-item fade-in">
          <div class="stat-number">24/7</div>
          <p class="text-muted">Support</p>
        </div>
        <div class="col-md-3 stat-item fade-in">
          <div class="stat-number">150+</div>
          <p class="text-muted">Countries</p>
        </div>
      </div>
      <p class="text-center">Fake Data</p>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="display-5 fw-bold mb-4">Powerful Features</h2>
          <p class="lead opacity-90">Everything you need to manage users effectively</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-user-shield"></i>
            </div>
            <h4 class="mb-3">Advanced Security</h4>
            <p class="opacity-90">Multi-factor authentication, encryption, and advanced security protocols to keep your data safe.</p>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-chart-line"></i>
            </div>
            <h4 class="mb-3">Analytics Dashboard</h4>
            <p class="opacity-90">Real-time insights and detailed analytics to understand user behavior and engagement.</p>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-cogs"></i>
            </div>
            <h4 class="mb-3">Easy Integration</h4>
            <p class="opacity-90">Seamlessly integrate with your existing systems using our comprehensive API.</p>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <h4 class="mb-3">Mobile Ready</h4>
            <p class="opacity-90">Fully responsive design that works perfectly on all devices and screen sizes.</p>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-users"></i>
            </div>
            <h4 class="mb-3">Team Collaboration</h4>
            <p class="opacity-90">Built-in collaboration tools to help your team work together more effectively.</p>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="feature-card">
            <div class="feature-icon">
              <i class="fas fa-headset"></i>
            </div>
            <h4 class="mb-3">24/7 Support</h4>
            <p class="opacity-90">Round-the-clock customer support to help you whenever you need assistance.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Section -->
  <section class="pricing" id="pricing">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
          <h2 class="display-5 fw-bold mb-4">Fake Pricing</h2>
          <p class="lead opacity-90">Choose the plan that's right for your business</p>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-4 fade-in">
          <div class="pricing-card">
            <h4 class="mb-3">Starter</h4>
            <div class="price mb-3">$9<small class="text-muted">/month</small></div>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Up to 100 users</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Basic analytics</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Email support</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>API access</li>
            </ul>
            <a href="register.php" class="btn btn-outline-custom w-100">Get Started</a>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="pricing-card featured">
            <h4 class="mb-3">Professional</h4>
            <div class="price mb-3">$29<small class="text-muted">/month</small></div>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Up to 1,000 users</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Advanced analytics</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Priority support</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Custom integrations</li>
            </ul>
            <a href="register.php" class="btn btn-primary-custom w-100">Get Started</a>
          </div>
        </div>
        <div class="col-md-4 fade-in">
          <div class="pricing-card">
            <h4 class="mb-3">Enterprise</h4>
            <div class="price mb-3">$99<small class="text-muted">/month</small></div>
            <ul class="list-unstyled mb-4">
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Unlimited users</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Full analytics suite</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>24/7 phone support</li>
              <li class="mb-2"><i class="fas fa-check text-success me-2"></i>White-label solution</li>
            </ul>
            <a href="register.php" class="btn btn-outline-custom w-100">Contact Sales</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h5 class="mb-3"><i class="fas fa-users-cog me-2"></i>UserHub</h5>
          <p class="opacity-90">The most advanced user management platform for modern businesses.</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="mb-3">Product</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light opacity-75">Features</a></li>
            <li><a href="#" class="text-light opacity-75">Pricing</a></li>
            <li><a href="#" class="text-light opacity-75">API</a></li>
            <li><a href="#" class="text-light opacity-75">Documentation</a></li>
          </ul>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="mb-3">Company</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light opacity-75">About</a></li>
            <li><a href="#" class="text-light opacity-75">Blog</a></li>
            <li><a href="#" class="text-light opacity-75">Careers</a></li>
            <li><a href="#" class="text-light opacity-75">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="mb-3">Support</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light opacity-75">Help Center</a></li>
            <li><a href="#" class="text-light opacity-75">Community</a></li>
            <li><a href="#" class="text-light opacity-75">Status</a></li>
            <li><a href="#" class="text-light opacity-75">Security</a></li>
          </ul>
        </div>
        <div class="col-md-2 mb-4">
          <h6 class="mb-3">Legal</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light opacity-75">Privacy</a></li>
            <li><a href="#" class="text-light opacity-75">Terms</a></li>
            <li><a href="#" class="text-light opacity-75">Cookies</a></li>
            <li><a href="#" class="text-light opacity-75">GDPR</a></li>
          </ul>
        </div>
      </div>
      <hr class="my-4 border-light opacity-25">
      <div class="row align-items-center">
        <div class="col-md-6">
          <p class="small opacity-75 mb-0">&copy; <?php echo date('Y'); ?> UserHub. All rights reserved.</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p class="small opacity-75 mb-0">Built with 💙 by Aman Singh</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/script.js"></script>

</body>
</html>