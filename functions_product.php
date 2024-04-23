<?php
// auteur: marlon somers
// functie: algemene functies tbv hergebruik
include "./crud_product/config.php";

if (!function_exists('connectDb')) {
    function connectDb()
    {
        $servername = SERVERNAME;
        $username = USERNAME;
        $password = PASSWORD;
        $dbname = DATABASE;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

if (!function_exists('getData')) {
    function getData($table)
    {
        $conn = connectDb();

        $sql = "SELECT * FROM $table";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        return $result;
    }
}

// Function 'printTable' print een HTML-table met data uit $result.
function printTable($result){
    // Zet de hele table in een variable $table en print hem 1 keer 
    $table = "<table>";

    // Print header table
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";
    }
    $table .= "<th>Wzg</th><th>Verwijder</th>"; // Add Wijzig and Verwijder headers here
    $table .= "</tr>";

    // Print each row of the table
    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        
        // Wijzig button
        $table .= "<td>
            <form method='post' action='update_product.php?productid={$row['productid']}' >       
                <button>Wzg</button>	 
            </form></td>";

        // Verwijder button
        $table .= "<td>
            <form method='post' action='delete_product.php?productid={$row['productid']}' >       
                <button>Verwijder</button>	 
            </form></td>";

        $table .= "</tr>";
    }
    $table .= "</table>";

    echo $table;
}



function getproduct($productid)
{
    // Connect database
    $conn = connectDb();

    // Select data from the specified table using a prepared statement
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE productid = :productid";
    $query = $conn->prepare($sql);
    $query->execute([':productid' => $productid]);
    $result = $query->fetch();

    return $result;
}


function ovzproducten()
{

    // Get all product records from the table
    $result = getData(CRUD_TABLE);

    //print table
    printTable($result);
}

function crudproducten()
{

    // Menu-item   insert
    $txt = "
    <h1></h1>
    <nav>
		<a href='insert_product.php'>Toevoegen nieuwe product</a>
    </nav><br>";
    echo $txt;

    // Get all product records from the table
    $result = getData(CRUD_TABLE);

    //print table
    printCrudproduct($result);
}

// Function 'printCrudproduct' print een HTML-table met data uit $result 
// en een wzg- en -verwijder-knop.
function printCrudproduct($result){
    echo '<div class="product-grid">';
    
    foreach ($result as $row) {
        echo '<div class="product-item">';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" class="product-image">';
        echo '<p>Price: ' . $row['price'] . '</p>';
        
        // Update button
        echo "<form method='post' action='update_product.php?productid={$row['productid']}' >       
                <button class='btn-update'>Update</button>	 
            </form>";

        // Delete button
        echo "<form method='post' action='delete_product.php?productid={$row['productid']}' >       
                <button class='btn-delete'>Delete</button>	 
            </form>";
        
        echo '</div>';
    }

    echo '</div>';
}



function updateproduct($row){

    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "UPDATE " . CRUD_TABLE .
    " SET 
        name = :name, 
        author = :author, 
        price = :price,
        image = :image
    WHERE productid = :productid
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':name' => $row['name'],
        ':author' => $row['author'],
        ':price' => $row['price'],
        ':image' => $row['image'], // Add image here
        ':productid' => $row['productid']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false;
    return $retVal;

}
function insertproduct($post)
{
    // Maak database connectie
    $conn = connectDb();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (name, author, price)
        VALUES (:name, :author, :price) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    
    // Uitvoeren
    $stmt->execute([
        ':name' => $post['name'],
        ':author' => '[author]',
        ':price' => $post['price']
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}


function deleteproduct($productid){

    // Connect to the database
    $conn = connectDb();

    // Prepare a query 
    $sql = "DELETE FROM " . CRUD_TABLE . " WHERE productid = :productid";

    // Prepare the query
    $stmt = $conn->prepare($sql);

    // Execute
    $stmt->execute([
        ':productid' => $productid
    ]);

    // Check if the database action was successful
    $retVal = ($stmt->rowCount() == 1) ? true : false;
    return $retVal;
}
