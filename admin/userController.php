<?php
session_start();
include "../config/connect.php";

if (isset($_POST['deleteUser'])) {
  $id = $_POST['deleteUser'];
  $sql = "DELETE FROM users WHERE id='$id'";
  $conn->exec($sql);
}
if (isset($_POST['submitUpdate'])) {
  $id = $_POST['submitUpdate'];
  $newPass = $_POST['userNewPassword'];
  $prevPass = $_POST['prevPass'];
  if (strlen($newPass) >= 8) {
    $sql = "UPDATE users SET password=$newPass WHERE id='$id'";
    $conn->exec($sql);
  }
}
// count the users
$sql = "SELECT id FROM users ORDER BY ID DESC LIMIT 1";
$result = $conn->query($sql);
$last_id = $result->fetch()["id"];

function passwordGenerator($passLength)
{
  $passChars = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYXabcdefghijklmnopqrstuvwxyz!@";
  $arrOfChars = str_split($passChars);
  $passwordArr = [];
  for ($i = 0; $i < $passLength; $i++) {
    shuffle($arrOfChars);
    array_push($passwordArr, $arrOfChars[0]);
  }
  $password = join("", $passwordArr);
  return $password;
}

if (isset($_POST['addNewUser'])) {
  $newUserEmail = $_POST['newUserEmail'];
  $newUserRandomPass = $_POST['newUserRandomPass'];
  if (!filter_var($newUserEmail, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('not valid email')</script>";
  } elseif (strlen($newUserRandomPass) < 8) {
    echo "<script>alert('not valid password')</script>";
  } else {
    try {
      $sql = "INSERT INTO users ( email,password)
                    VALUES ('$newUserEmail','$newUserRandomPass')";
      $conn->exec($sql);
      echo "<script>alert('The user added successfully')</script>";
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="au theme template">
  <meta name="author" content="Hau Nguyen">
  <meta name="keywords" content="au theme template">

  <!-- Title Page-->
  <title>Dashboard</title>

  <!-- Fontfaces CSS-->
  <link href="css/font-face.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

  <!-- Bootstrap CSS-->
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
  <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
  <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
  <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
  <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

  <!-- Main CSS-->
  <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
  <div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
        <div class="container-fluid">
          <div class="header-mobile-inner">
            <a class="logo" href="index.html">
              <img src="images/icon/logo.png" alt="CoolAdmin" />
            </a>
            <button class="hamburger hamburger--slider" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
          </div>
        </div>
      </div>
      <nav class="navbar-mobile">
        <div class="container-fluid">
          <ul class="navbar-mobile__list list-unstyled">
            <li class="has-sub">
              <a class="js-arrow" href="#">
                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li>
              <a href="chart.html">
                <i class="fas fa-chart-bar"></i>Charts</a>
            </li>

          </ul>
        </div>
      </nav>
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
      <div class="logo">
        <a href="#">
          <img src="images/icon/logo.png" alt="Cool Admin" />
        </a>
      </div>
      <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
          <ul class="list-unstyled navbar__list">
            <li>
              <a class="js-arrow" href="index.php">
                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

            </li>

            <!-- <li class="active has-sub">
              <a href="userController.php">
                <i class="fas fa-table"></i>Users Controller</a>
            </li> -->
            <li class="has-sub">
              <a href="categoryController.php">
                <i class="fas fa-table"></i>Categories Controller</a>
            </li>
            <li class=" has-sub">
              <a href="eventController.php">
                <i class="fas fa-table"></i>Events Controller</a>
            </li>



          </ul>
        </nav>
      </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">
      <!-- HEADER DESKTOP-->
      <header class="header-desktop">
        <div class="section__content section__content--p30">
          <div class="container-fluid">
            <div class="header-wrap">
              <form class="form-header" action="" method="POST">
                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                <button class="au-btn--submit" type="submit">
                  <i class="zmdi zmdi-search"></i>
                </button>
              </form>
              <div class="header-button">

                <div class="account-wrap">
                  <div class="account-item clearfix js-item-menu">
                    <div class="image">
                      <img src="images/icon/avatar-01.jpg" alt="admin" />
                    </div>
                    <div class="content">
                      <a class="js-acc-btn" href="#">admin</a>
                    </div>
                    <div class="account-dropdown js-dropdown">
                      <div class="info clearfix">
                        <div class="image">
                          <a href="#">
                            <img src="images/icon/avatar-01.jpg" alt="admin" />
                          </a>
                        </div>
                        <div class="content">
                          <h5 class="name">
                            <a href="#">admin</a>
                          </h5>
                          <span class="email">admin@admin.com</span>
                        </div>
                      </div>
                      <div class="account-dropdown__body">
                        <div class="account-dropdown__item">
                          <a href="#">
                            <i class="zmdi zmdi-account"></i>Account</a>
                        </div>
                        <div class="account-dropdown__item">
                          <a href="#">
                            <i class="zmdi zmdi-settings"></i>Setting</a>
                        </div>
                        <!-- <div class="account-dropdown__item">
                          <a href="#">
                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                        </div> -->
                      </div>
                      <div class="account-dropdown__footer">
                        <a href="#">
                          <i class="zmdi zmdi-power"></i>Logout</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- HEADER DESKTOP-->

      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="section__content section__content--p30">
          <div class="container-fluid">

            <div class="row">
              <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-5 m-b-35">User Controller</h3>
                <div class="table-data__tool">
                  <div class="table-data__tool-left">

                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">Add New User Form</div>
                        <div class="card-body card-block">
                          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
                            <div class="form-group">
                              <div class="input-group">
                                <input type="text" id="newUserId" name="newUserId" class="form-control" value="<?php echo $last_id + 1; ?>" disabled>

                                <div class="input-group-addon">
                                  <i class="fa fa-user"></i>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <input type="email" id="newUserEmail" name="newUserEmail" class="form-control">
                                <div class="input-group-addon">
                                  <i class="fa fa-envelope"></i>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="input-group">
                                <input id="newUserRandomPass" autocomplete="off" name="newUserRandomPass" class="form-control" value="<?php echo passwordGenerator(14); ?>">
                                <div class="input-group-addon">
                                  <i class="fa fa-asterisk"></i>
                                </div>
                              </div>
                            </div>
                            <div class="form-actions form-group">
                              <button type="submit" class="btn btn-secondary btn-sm" name="addNewUser">Add</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>


                  </div>

                </div>
                <div class="table-responsive table-responsive-data2">
                  <table class="table table-data2">
                    <thead>
                      <tr>

                        <th>id</th>
                        <th>email</th>
                        <th>password</th>
                        <th>created date</th>
                        <th>last login</th>
                        <th>user role</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM users";
                      $result = $conn->query($sql);
                      if ($result->rowCount() > 0) {
                        while ($row = $result->fetch()) {
                      ?>
                          <tr class="tr-shadow">

                            <td>
                              <?php echo $row["id"]; ?>
                            </td>
                            <td>
                              <span class="block-email"> <?php echo $row["email"]; ?>
                              </span>
                            </td>
                            <td class="desc">
                              <?php for ($i = 0; $i < strlen($row['password']); $i++) {
                                echo "*";
                              }
                              ?>
                            </td>
                            <td><?php echo $row["createdDAte"]; ?></td>
                            <td>
                              <span class="status--process"><?php echo $row["lastLoginDate"]; ?></span>
                            </td>
                            <td>
                              <?php echo $row["userRole"] ? "user" : "admin"; ?>
                            </td>
                            <td>
                              <?php if ($row["userRole"]) {
                              ?>
                                <div class="table-data-feature">

                                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="updateUser" value=<?php echo $row["id"] ?>>
                                      <i class="zmdi zmdi-edit"></i>
                                    </button>
                                  </form>
                                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deleteUser" value=<?php echo $row["id"] ?>>
                                      <i class="zmdi zmdi-delete"></i>
                                    </button>
                                  </form>
                                </div>
                              <?php
                              } ?>
                            </td>
                          </tr>
                          <tr class="spacer"></tr>
                          <?php
                          if (isset($_POST['updateUser']) && $row["id"] == $_POST["updateUser"]) {
                            $id = $_POST['updateUser'];
                          ?>
                            <div class="col-lg-6">
                              <div class="card">
                                <div class="card-header">Update Form</div>
                                <div class="card-body card-block">
                                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input type="text" id="userId" name="userId" class="form-control" value=<?php echo $row["id"] ?> disabled>
                                        <div class="input-group-addon">
                                          <i class="fa fa-user"></i>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input type="email" id="email2" name="email2" class="form-control" value=<?php echo $row["email"] ?> disabled>
                                        <div class="input-group-addon">
                                          <i class="fa fa-envelope"></i>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input id="userNewPassword" autocomplete="off" name="userNewPassword" class="form-control" placeholder=<?php
                                                                                                                                                for ($i = 0; $i < strlen($row['password']); $i++) {
                                                                                                                                                  echo "*";
                                                                                                                                                }
                                                                                                                                                ?>>
                                        <input type="hidden" name="prevPass" value="<?php echo $row["password"]; ?>">
                                        <div class="input-group-addon">
                                          <i class="fa fa-asterisk"></i>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-actions form-group">
                                      <button type="submit" class="btn btn-secondary btn-sm" name="submitUpdate" value=<?php echo $row["id"] ?>>Submit</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                      <?php
                          }
                        }
                      }
                      ?>


                    </tbody>
                  </table>
                </div>
                <!-- END DATA TABLE -->
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- END MAIN CONTENT-->
      <!-- END PAGE CONTAINER-->
    </div>

  </div>

  <!-- Jquery JS-->
  <script src="vendor/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap JS-->
  <script src="vendor/bootstrap-4.1/popper.min.js"></script>
  <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!-- Vendor JS       -->
  <script src="vendor/slick/slick.min.js">
  </script>
  <script src="vendor/wow/wow.min.js"></script>
  <script src="vendor/animsition/animsition.min.js"></script>
  <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
  </script>
  <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
  <script src="vendor/counter-up/jquery.counterup.min.js">
  </script>
  <script src="vendor/circle-progress/circle-progress.min.js"></script>
  <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="vendor/chartjs/Chart.bundle.min.js"></script>
  <script src="vendor/select2/select2.min.js">
  </script>

  <!-- Main JS-->
  <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->