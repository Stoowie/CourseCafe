<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="..\css\exsearch.css">
</head>
<body>

<nav class="navbar">
  <ul>
    <li><a href="#">Home</a></li>
  </ul>
</nav>

<?php


// Database connection settings
$dsn = "mysql:host=localhost;dbname=ccdb";
$username = "root"; // your MySQL username
$password = ""; // your MySQL password

$database = "ccdb"; // your database name


if (isset($_GET['query'])) {
    $query = $_GET['query'];

    try {
    // Establish database connection using PDO
    $conn = new PDO($dsn, $username, $password);
    // Set PDO to throw exceptions on error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Construct a dynamic SQL query to search through all attributes
        $sql = "SELECT * FROM school WHERE ";
        $columns = array('schoolID','schoolName', 'schoolCourse', 'schoolLocation'); // Add all your table columns here
        $conditions = array();
        foreach ($columns as $column) {
            $conditions[] = "$column LIKE '%$query%'";
        }
        $sql .= implode(' OR ', $conditions);

        // Execute the query
        $stmt = $conn->query($sql);

        // Display search results
        if ($stmt->rowCount() > 0) {
            echo "<h2>Search Results</h2>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Display search results as per your requirement
                echo "<p>{$row['schoolName']} - {$row['schoolCourse']} <br> {$row['schoolDescription']} <br> <br> </p>";
            }
        } else {
            echo "No results found.";
        }
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
    
</body>
</html>

