<?php
// Include the functions_product.php file
include(__DIR__ . '/crud_product/functions_product.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['name']) && !empty($_POST['author']) && !empty($_POST['price'])) {
        // Prepare data
        $data = [
            'name' => $_POST['name'],
            'author' => $_POST['author'],
            'price' => $_POST['price']
        ];

        // Insert product
        if (insertproduct($data)) {
            echo "<script>alert('Product is toegevoegd.')</script>";
        } else {
            echo "<script>alert('Er is een fout opgetreden bij het toevoegen van het product.')</script>";
        }
    } else {
        echo "<script>alert('Alle velden zijn verplicht.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
    <link rel="stylesheet" href="./include/stylesinclude.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./stylesheet.css?v=<?php echo time();?>">
    <title>Insert product</title>
</head>
<body>
    <?php include("./include/nav.php"); ?>
    <h1>Insert product</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="nameI" name="name" required><br>

        <label for="author">Author:</label>
        <input type="text" id="authorI" name="author" required><br>

        <label for="price">Price:</label>
        <input type="number" id="priceI" name="price" required><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_urlI" name="image_url" required><br><br>

        <input type="submit" name="btn_insert" value="Insert">
    </form>
    
    <?php include("./include/footer.php"); ?>
</body>
</html>
    