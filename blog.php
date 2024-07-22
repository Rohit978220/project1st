<?php
include 'db.php'; // Include database connection

// Define the number of posts per page
$posts_per_page = 9; // To simplify, show 9 posts per page

// Get the current page number from the URL, default to 1 if not set
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $posts_per_page;

// Query to get posts with pagination
$sql = "SELECT id, title, content, image_path, created FROM posts ORDER BY created DESC LIMIT $offset, $posts_per_page";
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Query to get total number of posts for pagination
$total_posts_result = $conn->query("SELECT COUNT(*) AS total FROM posts");
$total_posts_row = $total_posts_result->fetch_assoc();
$total_posts = $total_posts_row['total'];
$total_pages = ceil($total_posts / $posts_per_page);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
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
       
        .post {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .pagination {
            justify-content: center;
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
          <li><a href="index.php" >Home<br></a></li>
          <li><a href="about.php" >About</a></li>
          <li><a href="service.php">Services</a></li>
          <li><a href="blog.php" class="active">Blog</a></li>
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

  <?php
include 'db.php'; // Include database connection

// Define the number of posts per page
$posts_per_page = 9; // To simplify, show 9 posts per page

// Get the current page number from the URL, default to 1 if not set
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $posts_per_page;

// Query to get posts with pagination
$sql = "SELECT id, title, content, image_path, created FROM posts ORDER BY created DESC LIMIT $offset, $posts_per_page";
$result = $conn->query($sql);

if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Query to get total number of posts for pagination
$total_posts_result = $conn->query("SELECT COUNT(*) AS total FROM posts");
$total_posts_row = $total_posts_result->fetch_assoc();
$total_posts = $total_posts_row['total'];
$total_pages = ceil($total_posts / $posts_per_page);
?>

<div class="container" style="margin-top:100px;">
    <h1 class="my-4 text-center">Blog Posts</h1>
    <a href="add_post.php" class="btn btn-primary mb-4" style=" justify-content: center;
  align-items: center;
}">Add New Post</a>

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">';
                echo '<div class="post">';
                if ($row['image_path']) {
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Blog Image" style="height:300px;width:100%;">';
                }
                echo '<h2 class="h4">' . htmlspecialchars($row['title']) . '</h2>';
                echo '<p>' . nl2br(htmlspecialchars($row['content'])) . '</p>';
               
                echo '<small class="text-muted">Posted on ' . $row['created'] . '</small>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="col-12"><p>No blog posts found.</p></div>';
        }
        ?>
    </div>

    <nav>
        <ul class="pagination">
            <?php
            // Display pagination links
            if ($page > 1) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
            }

            for ($i = 1; $i <= $total_pages; $i++) {
                $active = ($i == $page) ? ' active' : '';
                echo '<li class="page-item' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
            }

            if ($page < $total_pages) {
                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
            }
            ?>
        </ul>
    </nav>
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

<?php
$conn->close();
?>
