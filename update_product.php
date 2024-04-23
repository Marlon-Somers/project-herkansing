<?php
// functie: update product
// auteur: Marlon Somers

include(__DIR__ . '/crud_product/functions_product.php');


// Test of er op de wijzig-knop is gedrukt 
if (isset($_POST['btn_wzg'])) {

    // test of update gelukt is
    if (updateproduct($_POST)) {
        echo "<script>alert('product is gewijzigd')</script>";
    } else {
        echo '<script>alert("product is NIET gewijzigd")</script>';
    }
}

// Test of productid is meegegeven in de URL
if (isset($_GET['productid'])) {
    // Haal alle info van de betreffende productid $_GET['productid']
    $productid = intval($_GET['productid']); // Convert to integer for security
    $row = getproduct($productid);

    if (!$row) {
        echo "Product niet gevonden";
        exit; // Stop further execution
    }
    error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="./include/stylesinclude.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./stylesheet.css?v=<?php echo time();?>">
    <title>Wijzig product</title>
</head>
<body>
<?php include('include/nav.php');?>
    <h2>Wijzig product</h2>
    <form method="post">
        
        <input type="hidden" id="productidU" name="productid" value="<?php echo htmlspecialchars($row['productid']); ?>">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($row['name']); ?>"><br>

        <label for="author">Auteur:</label>
        <input type="text" id="author" name="author" required value="<?php echo htmlspecialchars($row['author']); ?>"><br>

        <label for="price">Prijs:</label>
        <input type="number" id="price" name="price" required value="<?php echo htmlspecialchars($row['price']); ?>"><br><br>

        <label for="image">Afbeelding URL:</label>
        <input type="text" id="image_url" name="image" value="<?php echo htmlspecialchars($row['image']); ?>"><br><br>

        <input type="submit" name="btn_wzg" value="Wijzig">
        
        <a href='index.php'>Home</a>
    </form>
    <br><br>
</body>
</html>

<?php
} else {
    echo "Geen productid opgegeven<br>";
}
?>
