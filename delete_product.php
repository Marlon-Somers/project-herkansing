<?php
// Include the config.php file
include 'include/config.php';
include 'include/nav.php';
include(__DIR__ . '/crud_product/functions_product.php');

// Check if productid is set in GET request
if(isset($_GET['productid'])){
    // Check if delete operation is successful
    if(deleteproduct($_GET['productid'])){
        echo '<script>alert("productcode: ' . $_GET['productid'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("product is NIET verwijderd")</script>';
    }
}
?>