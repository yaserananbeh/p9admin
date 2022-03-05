<?php
session_start();
include "../config/connect.php";



$id = 4;
$newCatName = "yasre";
if (strlen($newCatName) >= 4) {
    $sql = "UPDATE categories SET category_name	='$newCatName' WHERE id='$id'";
    $conn->exec($sql);
    echo "<script>alert('The Category Edited successfully')</script>";
}
