<?php
require '../php/session_verify.php';

// important sql stat : "SELECT * FROM `todo` NATURAL JOIN person WHERE person.person_id = 2"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Todo App</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <link href="./todo-app.css" rel="stylesheet">
  <script src="//code.jquery.com/jquery-3.1.0.slim.min.js"></script>
  <!-- <script src="./todo-app.js"></script> -->
  <!-- =======================================================
  * Template Name: Techie - v2.2.1
  * Template URL: https://bootstrapmade.com/techie-free-skin-bootstrap-3/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script src="todo.js"></script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-xl-9 d-flex align-items-center">
          <h1 class="logo mr-auto"><img src="<?php echo $_SESSION['profile_pic'] ?>" class="mr-3" style="height: 100px; width:40px; border-radius: 20px;"><a href="../index.php"><?php echo $_SESSION['name'] ?></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.php" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <a href="logout.php" class="get-started-btn scrollto">Log Out</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Todo Dashboard</h2>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
      <div class="container">
        <div class="d-flex justify-content-center h-100">
          <div class="main-todo-input-wrap">
            <div class="main-todo-input fl-wrap">
              <form action="./add-todo.php" onsubmit="return validate()" name="todo-form" method="post">
                <div class="main-todo-input-item">
                  <input type="text" name="txt_todo" id="todo-list-item" placeholder="What will you do today?">
                </div> <button class="add-items main-search-button" type="submit">ADD</button>
              </form>
            </div>
            <!--</div>
            </div> -->
          </div>
        </div>
        <div class="container-fluid w-50 mt-5">
          <!-- <div class="col-md-12 mt-3">
                <div class="main-todo-input todo-listing"> -->

          <?php
          require '../php/dbconfig.php';

          $sr_no = 1;
          $conn = new mysqli($servername, $db_username, $db_password, $database);
          if ($conn->connect_error) {
            die("Connection failed..." . $conn->connect_error);
          }
          $person_id = $_SESSION["person_id"];
          $sql = "SELECT * FROM `todo` NATURAL JOIN person WHERE person.person_id = '$person_id'";
          $result = $conn->query($sql);
          ?>
          <?php
          $row_count = mysqli_num_rows($result);
          if (($row_count > 0) && $result) {
          ?>
            <table class="table table-bordered table-striped table-dark table-hover">
              <tr>
                <th>Sr. No</th>
                <th>Task Description</th>
                <th>Action</th>
              </tr>
              <?php
              while ($row = $result->fetch_assoc()) {
                $todo_id = $row['todo_id'];
              ?>
                <tr>
                  <td><?php echo $sr_no;
                      $sr_no++; ?></td>
                  <td><?php echo $row["todo_task"] ?></td>
                  <td class="d-flex justify-content-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mr-3" data-bs-toggle="modal" data-bs-target="<?php echo "#exampleModal" . $sr_no; ?>">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo "exampleModal" . $sr_no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Edit ToDo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="color: black;">
                            <form action="./edit-todo.php" method="post">
                              <div class="main-todo-input-item">
                                <input type="text" name="txt_todo" id="todo-list-item" value="<?php echo $row["todo_task"] ?>" required>
                                <input type="text" name="todo_id" id="todo-list-item" value="<?php echo $row["todo_id"] ?>" hidden>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="delete.php?todo-id=<?php echo $todo_id ?>"><button class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                  </td>
                </tr>
              <?php  }
            } else {
              ?>
              <div class="container">
                <div class="d-flex justify-content-center h-100">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-center">
                      <h3>No Todos Found.</h3>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            $conn->close();
            if (($row_count > 0)) {
              echo "</table>";
            }
            ?>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


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
