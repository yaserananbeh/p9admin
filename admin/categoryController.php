<?php
session_start();
// include "../config/connect.php";


if (isset($_POST['deleteCat'])) {
  $id = $_POST['deleteCat'];
  $data = array();
  $data_json = json_encode($data);
  $url = "http://localhost:5000/customercategories/$id";
  $curl_handle = curl_init();
  curl_setopt($curl_handle, CURLOPT_URL, $url);
  curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
  curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data_json);
  curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
  $response  = curl_exec($curl_handle);
  curl_close($curl_handle);
}
if (isset($_POST['submitUpdate'])) {
  $id = $_POST['submitUpdate'];
  $newCatName = $_POST['categoryName'];
  if (strlen($newCatName) >= 4) {
    $data = array('name' => $newCatName);
    $data_json = json_encode($data);
    $url = "http://localhost:5000/customercategories/$id";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    curl_close($ch);
    echo "<script>alert('The Category Edited successfully')</script>";
  } else {
    echo "<script>alert('not valid category name')</script>";
  }
}
if (isset($_POST['addNewCat'])) {
  $newCatName = $_POST['newCatName'];
  if (strlen($newCatName) <= 3) {
    echo "<script>alert('not valid category name')</script>";
  } else {
    try {

      $data = array('name' => $newCatName);

      $data_json = json_encode($data);

      $url = 'http://localhost:5000/customercategories';

      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $url);

      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

      curl_setopt($ch, CURLOPT_POST, 1);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $response  = curl_exec($ch);

      curl_close($ch);

      echo "<script>alert('The Category added successfully')</script>";
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}
$api_url = 'http://localhost:5000/customercategories';

$json_data = file_get_contents($api_url);

$response_data = json_decode($json_data);

$user_data = $response_data;


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

            <li class=" has-sub">
              <a href="userController.php">
                <i class="fas fa-table"></i>Users Controller</a>
            </li>
            <li class="active has-sub">
              <a href="categoryController.php">
                <i class="fas fa-table"></i>Categories Controller</a>
            </li>
            <li class=" has-sub">
              <a href="productController.php">
                <i class="fas fa-table"></i>Products Controller</a>
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
                      <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                    </div>
                    <div class="content">
                      <a class="js-acc-btn" href="#">john doe</a>
                    </div>
                    <div class="account-dropdown js-dropdown">
                      <div class="info clearfix">
                        <div class="image">
                          <a href="#">
                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                          </a>
                        </div>
                        <div class="content">
                          <h5 class="name">
                            <a href="#">john doe</a>
                          </h5>
                          <span class="email">johndoe@example.com</span>
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
                        <div class="account-dropdown__item">
                          <a href="#">
                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                        </div>
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
                <h3 class="title-5 m-b-35">Categories Controller</h3>
                <div class="table-data__tool">
                  <div class="table-data__tool-left">

                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">Add New Category</div>
                        <div class="card-body card-block">
                          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">


                            <div class="form-group">
                              <div class="input-group">
                                <input id="newCatName" autocomplete="off" name="newCatName" class="form-control">
                                <div class="input-group-addon">
                                  <i class="fa fa-plus-square"></i>
                                </div>
                              </div>
                            </div>
                            <div class="form-actions form-group">
                              <button type="submit" class="btn btn-secondary btn-sm" name="addNewCat">Add</button>
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
                        <th>Category Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($user_data as $index => $category) {
                      ?>
                        <tr class="tr-shadow">

                          <td>
                            <?php echo $index + 1; ?>
                          </td>
                          <td>
                            <span class="block-email"> <?php echo $category->name; ?>
                            </span>
                          </td>



                          <td>

                            <div class="table-data-feature">

                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="updateCategory" value=<?php echo $category->id ?>>
                                  <i class="zmdi zmdi-edit"></i>
                                </button>
                              </form>
                              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deleteCat" value=<?php echo $category->id ?>>
                                  <i class="zmdi zmdi-delete"></i>
                                </button>
                              </form>
                            </div>

                          </td>
                        </tr>
                        <tr class="spacer"></tr>

                        <?php
                        if (isset($_POST['updateCategory']) && $category->id == $_POST["updateCategory"]) {
                          $id = $_POST['updateCategory'];
                        ?>
                          <div class="col-lg-6">
                            <div class="card">
                              <div class="card-header">Edit <?php echo $category->name ?></div>
                              <div class="card-body card-block">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">

                                  <!-- <input type="hidden" id="catId" name="catId" class="form-control" value=<?php echo $category->id ?> disabled> -->
                                  <div class="form-group">
                                    <div class="input-group">
                                      <input type="text" id="categoryName" name="categoryName" class="form-control" value=<?php echo $category->name ?>>
                                      <div class="input-group-addon">
                                        <i class="fa fa-plus-square"></i>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-actions form-group">
                                    <button type="submit" class="btn btn-secondary btn-sm" name="submitUpdate" value=<?php echo $category->id ?>>Submit</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                      <?php
                        }
                      }
                      // die;
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