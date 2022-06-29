<?php
session_start();
if (isset($_SESSION['username'])) {
  header('location:../todo/todo-app.php');
}

$name = $_POST['txt_name'];
$phone = $_POST['tel_phone'];
$email = $_POST['txt_email'];
$username = $_POST['txt_username'];
$password = $_POST['txt_password'];

$target_dir = "../profile_pic/";
$target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
$uploadOk = 1;
$warning = '';
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
if ($check !== false) {
  $uploadOk = 1;
} else {
  $warning = "File is not an image.";
  $uploadOk = 0;
}


// Check if file already exists
if (file_exists($target_file)) {
  $warning = "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["profile_pic"]["size"] > 500000) {
  $warning = "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  $warning = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

$db_username = "root";
$db_password = "";
$database = "todoproject";
$servername = "localhost";


$txt = $name;
$abc = explode(" ", $txt);
for ($i = 0; $i < sizeof($abc); $i++) {
  $abc[$i] = ucfirst($abc[$i]);
}
$ans = join(" ", $abc);
$name = $ans;


$conn = new mysqli($servername, $db_username, $db_password, $database);
if ($conn->connect_error) {
  die("Connection failed..." . $conn->connect_error);
}

$sql = "INSERT INTO `person`(name, email, phone, username, password, profile_pic) VALUES ('$name', '$email', '$phone', '$username', '$password', '$target_file')";

if ($uploadOk == 0) {
  $sql = $sql . '123';
}

$result = $conn->query($sql);

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $warning = "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else if ($result) {
  if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
    $warning = "The file " . htmlspecialchars(basename($_FILES["profile_pic"]["name"])) . " has been uploaded.";
  } else {
    $warning = "Sorry, there was an error uploading your file.";
  }
}

if ($result) {
  // myMail('$email');
  header("location:../email-demo/email.php?email=$email");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inner Page - Techie Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <link href="./signup.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: Techie - v2.2.1
  * Template URL: https://bootstrapmade.com/techie-free-skin-bootstrap-3/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><a href="../index.php">TODO</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.php" class="logo mr-auto"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li><a href="../index.php">Home</a></li>

            </ul>
          </nav><!-- .nav-menu -->

          <a href="../index.php" class="get-started-btn scrollto">Get Started</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Sign Up Page</h2>
          <ol>
            <li><a href="../index.php">Home</a></li>
            <li>Sign Up Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="d-flex justify-content-center h-100">
          <div class="card h-100">
            <div class="card-header">
              <h3>Sign Up Message</h3>
              <div class="d-flex justify-content-end social_icon">
                <span><i class="fab fa-facebook-square"></i></span>
                <span><i class="fab fa-google-plus-square"></i></span>
                <span><i class="fab fa-twitter-square"></i></span>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-center links">
                <?php
                if ($result && $uploadOk == 1) {
                  echo "Registered Succesfully";
                } else {
                  echo "Registration Unsuccessful";
                }
                ?>
              </div>
            </div>
            <div class="card-footer">
              <div class="d-flex justify-content-center links">
                <?php
                if ($result) {
                  echo '<a href="../login/Login.php">Login</a>';
                } else {
                  echo '<a href="./signup.php">Sign Up</a>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <?php
  require "../assets/templates/footer.php";
  ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>