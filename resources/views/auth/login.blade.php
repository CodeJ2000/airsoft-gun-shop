<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Airsoft Zone - Toy Gun Shop</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Free HTML Templates" name="keywords" />
    <meta content="Free HTML Templates" name="description" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap"
      rel="stylesheet"
    />

    <!-- Icon Font Stylesheet -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
      rel="stylesheet"
    />

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- Topbar Start -->
    <div class="container-fluid px-0 d-none d-lg-block">
      <div class="row gx-0">
        <div class="col-lg-4 text-center bg-secondary py-3">
          <div class="d-inline-flex align-items-center justify-content-center">
            <i class="bi bi-envelope fs-1 text-primary me-3"></i>
            <div class="text-start">
              <h6 class="text-uppercase mb-1">Email Us</h6>
              <span>info@example.com</span>
            </div>
          </div>
        </div>
        <div class="col-lg-4 text-center bg-primary border-inner py-3">
          <div class="d-inline-flex align-items-center justify-content-center">
            <a href="index.html" class="navbar-brand">
              <h1 class="m-0 text-uppercase text-white">
                <i class="fa fa-rifle fs-1 text-dark me-3"></i>Airsoft Zone
              </h1>
            </a>
          </div>
        </div>
        <div class="col-lg-4 text-center bg-secondary py-3">
          <div class="d-inline-flex align-items-center justify-content-center">
            <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
            <div class="text-start">
              <h6 class="text-uppercase mb-1">Call Us</h6>
              <span>+012 345 6789</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <nav
      class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0"
    >
      <a href="index.html" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 text-uppercase text-white">
          <i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>CakeZone
        </h1>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarCollapse"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto mx-lg-auto py-0">
          <a href="index.html" class="nav-item nav-link active">Home</a>
          <a href="about.html" class="nav-item nav-link">About Us</a>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              >Airsoft Guns</a
            >
            <div class="dropdown-menu m-0">
              <a href="menu.html" class="dropdown-item">Airsoft Rifle</a>
              <a href="menu.html" class="dropdown-item">Airsoft Pistol</a>
              <a href="menu.html" class="dropdown-item">Airsoft Sniper</a>
              <a href="menu.html" class="dropdown-item">Airsoft Shotgun</a>
              <a href="menu.html" class="dropdown-item">Airsoft Machine gun</a>
              <a href="menu.html" class="dropdown-item"
                >Airsoft Granade luncher</a
              >
            </div>
          </div>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"
              >Accessories</a
            >
            <div class="dropdown-menu m-0">
              <a href="menu.html" class="dropdown-item">Airsoft Suppressor</a>
              <a href="menu.html" class="dropdown-item">Barrel Nut</a>
              <a href="menu.html" class="dropdown-item">Bipod</a>
              <a href="menu.html" class="dropdown-item">Buffer Tube</a>
              <a href="menu.html" class="dropdown-item">Buttstock</a>
              <a href="menu.html" class="dropdown-item">Charging Handle</a>
              <a href="menu.html" class="dropdown-item">Chronograph</a>
              <a href="menu.html" class="dropdown-item">Flashlight</a>
            </div>
          </div>

          <a href="auth/login.html" class="nav-item nav-link">Login</a>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Start -->
    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
      <div class="container py-5">
        <div class="row justify-content-start">
          <div class="col-lg-8 text-center text-lg-start">
            <h1 class="text-uppercase text-white mb-5">Customer Login</h1>
            <form class="col-md-6" action="">
              <div class="input-group mb-4">
                <input
                  type="text"
                  class="form-control border-white p-3"
                  placeholder="Your Email"
                />
              </div>
              <div class="input-group mb-4">
                <input
                  type="password"
                  class="form-control border-white p-3"
                  placeholder="Your Password"
                />
              </div>
              <div class="mb-2">
                Don't have an account?
                <a href="signup.html">Signup</a>
              </div>
              <input
                type="submit"
                value="Login"
                class="btn btn-primary border-inner py-3 px-5 me-5"
              />
            </form>
            <div
              class="d-flex align-items-center justify-content-center justify-content-lg-start pt-5"
            ></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-img text-secondary" style="margin-top: 90px">
      <div class="container">
        <div class="row gx-5">
          <div class="col-lg-4 col-md-6 mb-lg-n5">
            <div
              class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4"
            >
              <a href="index.html" class="navbar-brand">
                <h1 class="m-0 text-uppercase text-white">Airsoft Zone</h1>
              </a>
              <p class="mt-3">
                Lorem diam sit erat dolor elitr et, diam lorem justo labore amet
                clita labore stet eos magna sit. Elitr dolor eirmod duo tempor
                lorem, elitr clita ipsum sea. Nonumy rebum et takimata ea
                takimata amet gubergren, erat rebum magna lorem stet eos. Diam
                amet et kasd eos duo dolore no.
              </p>
            </div>
          </div>
          <div class="col-lg-8 col-md-6">
            <div class="row gx-5">
              <div class="col-lg-4 col-md-12 pt-5 mb-5">
                <h4 class="text-primary text-uppercase mb-4">Get In Touch</h4>
                <div class="d-flex mb-2">
                  <i class="bi bi-geo-alt text-primary me-2"></i>
                  <p class="mb-0">123 Street, New York, USA</p>
                </div>
                <div class="d-flex mb-2">
                  <i class="bi bi-envelope-open text-primary me-2"></i>
                  <p class="mb-0">info@example.com</p>
                </div>
                <div class="d-flex mb-2">
                  <i class="bi bi-telephone text-primary me-2"></i>
                  <p class="mb-0">+012 345 67890</p>
                </div>
                <div class="d-flex mt-4">
                  <a
                    class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2"
                    href="#"
                    ><i class="fab fa-twitter fw-normal"></i
                  ></a>
                  <a
                    class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2"
                    href="#"
                    ><i class="fab fa-facebook-f fw-normal"></i
                  ></a>
                  <a
                    class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2"
                    href="#"
                    ><i class="fab fa-linkedin-in fw-normal"></i
                  ></a>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                <div class="d-flex flex-column justify-content-start">
                  <a class="text-secondary mb-2" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>Home</a
                  >
                  <a class="text-secondary mb-2" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>About
                    Us</a
                  >
                  <a class="text-secondary mb-2" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>Our
                    Services</a
                  >
                  <a class="text-secondary mb-2" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>Meet The
                    Team</a
                  >
                  <a class="text-secondary mb-2" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>Latest
                    Blog</a
                  >
                  <a class="text-secondary" href="#"
                    ><i class="bi bi-arrow-right text-primary me-2"></i>Contact
                    Us</a
                  >
                </div>
              </div>
              <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                <h4 class="text-primary text-uppercase mb-4">Newsletter</h4>
                <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                <form action="">
                  <div class="input-group">
                    <input
                      type="text"
                      class="form-control border-white p-3"
                      placeholder="Your Email"
                    />
                    <button class="btn btn-primary">Sign Up</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="container-fluid text-secondary py-4"
      style="background: #111111"
    >
      <div class="container text-center">
        <p class="mb-0">
          &copy;
          <a class="text-white border-bottom" href="#">AirsoftZone</a>. All
          Rights Reserved. Designed by
          <a class="text-white border-bottom" href="https://htmlcodex.com"
            >HTML Codex</a
          >
        </p>
      </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"
      ><i class="bi bi-arrow-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </body>
</html>
