<!---------Auteur: BYZ---------->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
    <link rel="stylesheet" href="./include/stylesinclude.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./stylesheet.css?v=<?php echo time();?>">
    <title>Homepage</title>
</head>
<body>
    <?php 
        //include nav.php
        include('./include/nav.php'); 
        include('./crud_product/functions_product.php'); 
    ?>
        <main>
            <div class="banner-head">
            <p class="h3">Buy the newest and hottest comics<br>right here!<br>
            <span class="h4">we have action, horror, sci-fi, manga and all<br>other kinds of comics!</span>
            </p>
            <div class ="banner">

            </div>
            </div>
            </div>
            <div class="products">
            <?php
            //auteur: Marlon Somers//
            crudproducten();
            ?>
            </div>
    <?php
        //include footer.php
        include "./include/footer.php";
    ?>
<script src="./scriptinclude.js"></script>
</body>
</html>