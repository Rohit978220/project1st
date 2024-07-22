<?php
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    // Handle file upload
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Directory for storing uploaded files
        $upload_file = $upload_dir . basename($_FILES['image']['name']);
        
        // Debugging output
        echo "Temporary file: " . $_FILES['image']['tmp_name'] . "<br>";
        echo "Target file: " . $upload_file . "<br>";
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
            $image_path = $upload_file;
        } else {
            // echo "File upload failed. Error: " . $_FILES['image']['error'];
        }
    } else {
        // echo "No file uploaded or upload error. Error code: " . $_FILES['image']['error'];
    }

    // Insert the new post into the database
    $sql = "INSERT INTO posts (title, content, image_path) VALUES ('$title', '$content', '$image_path')";
    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
    <style>
        .addcon {
            max-width: 700px;
            margin-top: 150px;
            margin-bottom: 100px;
            background-color: var(--nav-dropdown-hover-color);
            border-radius:15px;
}
        
        .form-group img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
     
        <h1 class="sitename">RR</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
        <li><a href="index.php" class="active">Home<br></a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="service.php">Services</a></li>
          <li><a href="blog.php">Blog</a></li>
          <!-- <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a> -->
            <ul>
              <!-- <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li> -->
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
  </header>
<div class="container addcon">
    <div class="form-size" style="padding:20px 20px 20px 20px;">
        <h1 class="my-4">Add New Blog Post</h1>
        <form action="add_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" style="color:black;font-size:20px;">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content" style="color:black;font-size:20px;">Content:</label>
                <textarea id="content" name="content" class="form-control" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <label for="image"style="color:black;font-size:20px;">Image:</label>
                <input type="file" id="image" name="image" class="form-control-file" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
        <div id="popup" style="color:white; display:none;">Thanks for submitting!</div>
        <br>
        <a href="blog.php" class="btn btn-secondary">Back to Blog</a>
    </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <footer id="footer" class="footer dark-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">RR</span>
            </a>
            <div class="footer-contact pt-3">
              <p>Sahibzada Ajit Singh Nagar</p>
              <!-- <p>New York, NY 535022</p> -->
              <p class="mt-3"><strong>Phone:</strong> <span>+91 987654321</span></p>
              <p><strong>Email:</strong> <span>rrtech@gmail.com</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href="https://x.com/?lang=en"><i class="bi bi-twitter-x"></i></a>
              <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
              <a href="https://in.linkedin.com/"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Design</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Development</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Product Management</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Marketing</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#"> Graphic Design</a></li>
            </ul>
          </div>
          <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
            <form action="forms/newsletter.html" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright">
      <div class="container text-center">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">RR</strong> <span>All Rights Reserved</span></p>
        <div class="credits"> 
        </div>
      </div>
    </div>

  </footer>
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script>
  document.getElementById('contactForm').addEventListener('submit', function(event) {
      event.preventDefault(); 

      var formData = new FormData(this);

      fetch('submit.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.text())
      .then(data => {
          if (data === 'success') {
              document.getElementById('popup').style.display = 'block'; 
              setTimeout(() => {
                  document.getElementById('popup').style.display = 'none'; 
              }, 3000);
              this.reset(); 
          } else {
              alert('There was an error submitting the form.');
          }
      })
      .catch(error => console.error('Error:', error));
  });
</script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>



