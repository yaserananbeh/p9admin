<?php
session_start();
include "../config/connect.php";

if (isset($_POST['deleteProduct'])) {
 $id = $_POST['deleteProduct'];
 $sql = "DELETE FROM products WHERE id='$id'";
 $conn->exec($sql);
}
if (isset($_POST['submitUpdate'])) {
 $id = $_POST['submitUpdate'];
 $newProductName = $_POST['newProductName'];
 $newProductPrice = $_POST['newProductPrice'];
 $newProductDesc = $_POST['newProductDesc'];
 $newProductImage = $_POST['newProductImage'];
 $newProductDiscount = $_POST['newProductDiscount'];
 $newProductStock = $_POST['newProductStock'];
 $newProductCategory = $_POST['newProductCategory'];
 if (strlen($newProductName) < 4) {
  echo "<script>alert('not valid product name')</script>";
 } else if ($newProductPrice <= 0) {
  echo "<script>alert('not valid product price')</script>";
 } else if (strlen($newProductDesc) < 4) {
  echo "<script>alert('not valid product description')</script>";
 } else if (strlen($newProductImage) < 4) {
  echo "<script>alert('not valid product image')</script>";
 } else if ($newProductDiscount < 0) {
  echo "<script>alert('not valid product discount')</script>";
 } else if ($newProductStock <= 0) {
  echo "<script>alert('not valid product stock quantity')</script>";
 } else if (strlen($newProductCategory) <= 0) {
  echo "<script>alert('not valid product category')</script>";
 } else {
  $sql = "UPDATE products SET 
  product_name='$newProductName',
  product_price='$newProductPrice',
  product_desc='$newProductDesc',
  product_image='$newProductImage',
  discount='$newProductDiscount',
  stock='$newProductStock',
  category_id='$newProductCategory' 
   WHERE id='$id'";
  $conn->exec($sql);
  echo "<script>alert('The Category Edited successfully')</script>";
 }
}
// count the products
$sql = "SELECT id FROM products ORDER BY ID DESC LIMIT 1";
$result = $conn->query($sql);
$last_id = $result->fetch()["id"];



if (isset($_POST['addNewProduct'])) {
 $newProductName = $_POST['newProductName'];
 $newProductPrice = $_POST['newProductPrice'];
 $newProductDesc = $_POST['newProductDesc'];
 $newProductImage = $_POST['newProductImage'];
 $newProductDiscount = $_POST['newProductDiscount'];
 $newProductStock = $_POST['newProductStock'];
 $newProductCategory = $_POST['newProductCategory'];
 if (strlen($newProductName) < 4) {
  echo "<script>alert('not valid product name')</script>";
 } else if ($newProductPrice <= 0) {
  echo "<script>alert('not valid product price')</script>";
 } else if (strlen($newProductDesc) < 4) {
  echo "<script>alert('not valid product description')</script>";
 } else if (strlen($newProductImage) < 4) {
  echo "<script>alert('not valid product image')</script>";
 } else if ($newProductDiscount < 0) {
  echo "<script>alert('not valid product discount')</script>";
 } else if ($newProductStock <= 0) {
  echo "<script>alert('not valid product stock quantity')</script>";
 } else if (strlen($newProductCategory) <= 0) {
  echo "<script>alert('not valid product category')</script>";
 } else {
  try {
   $sql = "INSERT INTO products ( product_name,product_price,product_desc,product_image,discount,stock,category_id)
                    VALUES ('$newProductName','$newProductPrice','$newProductDesc','$newProductImage','$newProductDiscount','$newProductStock','$newProductCategory')";
   $conn->exec($sql);
   echo "<script>alert('The Product added successfully')</script>";
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
 <style>
  .productImageTd img {
   max-width: 50px;
   max-height: 50px;
  }
 </style>
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
      <li class="has-sub">
       <a href="categoryController.php">
        <i class="fas fa-table"></i>Categories Controller</a>
      </li>
      <li class="active has-sub">
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
        <h3 class="title-5 m-b-35">Products Controller</h3>
        <div class="table-data__tool">
         <div class="table-data__tool-left">

          <div class="col-lg-12">
           <div class="card">
            <div class="card-header">Add New Product</div>
            <div class="card-body card-block">
             <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
              <div class="form-group">
               <div class="input-group">
                <input type="text" id="newProductId" name="newProductId" class="form-control" value="<?php echo $last_id + 1; ?>" disabled>

                <div class="input-group-addon">
                 <i class="fa fa-sort-numeric-asc"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input id="newProductName" name="newProductName" class="form-control" placeholder="product name">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input type="number" min="0" id="newProductPrice" name="newProductPrice" class="form-control" placeholder="product price in jd">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input id="newProductDesc" name="newProductDesc" class="form-control" placeholder="product description">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input id="newProductImage" name="newProductImage" class="form-control" placeholder="product image">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input type="number" min="0" id="newProductDiscount" name="newProductDiscount" class="form-control" placeholder="product discount default 0">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <input type="number" min="1" id="newProductStock" name="newProductStock" class="form-control" placeholder="product stock quantity">
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-group">
               <div class="input-group">
                <select name="newProductCategory" id="newProductCategory">
                 <option value="" selected disabled hidden>Choose a category</option>
                 <?php
                 $sql = "SELECT * FROM categories";
                 $result = $conn->query($sql);
                 if ($result->rowCount() > 0) {
                  while ($row = $result->fetch()) {
                 ?>
                   <option value="<?php echo $row["id"] ?>"><?php echo $row["category_name"] ?></option>
                 <?php  }
                 } ?>
                </select>
                <div class="input-group-addon">
                 <i class="fa fa-plus-square"></i>
                </div>
               </div>
              </div>
              <div class="form-actions form-group">
               <button type="submit" class="btn btn-secondary btn-sm" name="addNewProduct">Add</button>
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
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Desc</th>
            <th>Product Image</th>
            <th>Product Discount</th>
            <th>Product Stock</th>
            <th>Product Category</th>
            <th></th>
           </tr>
          </thead>
          <tbody>
           <?php
           $sql = "SELECT * FROM products";
           $result = $conn->query($sql);
           if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
           ?>
             <tr class="tr-shadow">

              <td>
               <?php echo $row["id"]; ?>
              </td>
              <td>
               <span class="block-email"> <?php echo $row["product_name"]; ?>
               </span>
              </td>
              <td>
               <?php echo $row["product_price"]; ?>
              </td>
              <td>
               <?php echo $row["product_desc"]; ?>
              </td>
              <td class="productImageTd">
               <img src="<?php echo $row["product_image"]; ?>" alt="<?php echo $row["product_name"]; ?>">
              </td>
              <td>
               <?php echo $row["discount"]; ?>
              </td>
              <td>
               <?php echo $row["stock"]; ?>
              </td>
              <td>
               <?php echo $row["category_id"]; ?>
              </td>
              <td>
               <div class="table-data-feature">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                 <button class="item" data-toggle="tooltip" data-placement="top" title="Edit" name="updateProduct" value=<?php echo $row["id"] ?>>
                  <i class="zmdi zmdi-edit"></i>
                 </button>
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                 <button class="item" data-toggle="tooltip" data-placement="top" title="Delete" name="deleteProduct" value=<?php echo $row["id"] ?>>
                  <i class="zmdi zmdi-delete"></i>
                 </button>
                </form>
               </div>

              </td>
             </tr>
             <tr class="spacer"></tr>
             <?php
             if (isset($_POST['updateProduct']) && $row["id"] == $_POST["updateProduct"]) {
              $id = $_POST['updateProduct'];
             ?>
              <div class="col-lg-6">
               <div class="card">
                <div class="card-header">Update Form</div>
                <div class="card-body card-block">
                 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="">
                  <div class="form-group">
                   <div class="input-group">
                    <input type="text" id="newProductId" name="newProductId" class="form-control" value="<?php echo $row["id"]; ?>" disabled>

                    <div class="input-group-addon">
                     <i class="fa fa-sort-numeric-asc"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input id="newProductName" name="newProductName" class="form-control" value="<?php echo $row["product_name"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input type="number" min="0" id="newProductPrice" name="newProductPrice" class="form-control" value="<?php echo $row["product_price"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input id="newProductDesc" name="newProductDesc" class="form-control" value="<?php echo $row["product_desc"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input id="newProductImage" name="newProductImage" class="form-control" value="<?php echo $row["product_image"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input type="number" min="0" id="newProductDiscount" name="newProductDiscount" class="form-control" value="<?php echo $row["discount"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <input type="number" min="1" id="newProductStock" name="newProductStock" class="form-control" value="<?php echo $row["stock"]; ?>">
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
                    </div>
                   </div>
                  </div>
                  <div class="form-group">
                   <div class="input-group">
                    <select name="newProductCategory" id="newProductCategory">
                     <!-- <option value="" selected disabled hidden>Choose a category</option> -->
                     <?php
                     $query = "SELECT * FROM categories";
                     $categoryResult = $conn->query($query);
                     if ($categoryResult->rowCount() > 0) {
                      while ($catRow = $categoryResult->fetch()) {
                       if ($catRow["id"] === $row["category_id"]) {
                     ?>
                        <option selected value="<?php echo $catRow["id"] ?>"><?php echo $catRow["category_name"] ?></option>
                       <?php } else { ?>
                        <option value="<?php echo $catRow["id"] ?>"><?php echo $catRow["category_name"] ?></option><?php
                                                                                                                  }
                                                                                                                 }
                                                                                                                } ?>
                    </select>
                    <div class="input-group-addon">
                     <i class="fa fa-plus-square"></i>
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