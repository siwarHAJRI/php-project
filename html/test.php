<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tst.css">
    <title>Movies List</title>
</head>
<body>
    <div class="movies-list">
    <?php
// Step 1: Connect to the database using PDO
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = "";     // default password for XAMPP
$dbname = "Movie"; // Change this to your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Step 2: Fetch movie details from the database
$idM = 7; // You can change this to the ID of the movie you want to display
$sql = "SELECT * FROM movies WHERE idM = :idM";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':idM', $idM);
$stmt->execute();
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

// Step 3: Display the movie details
if ($movie) {
    echo '<div class="movie-card">';
    echo '<iframe src="' . $movie["pic"] . '" frameborder="0"></iframe>';
    echo '<div class="movie-card-content">';
    echo '<h2 class="movie-card-title">' . $movie["Name"] . '</h2>';
    echo '<p class="movie-card-description">' . $movie["Desc"] . '</p>';
    echo '</div></div>';
} else {
    echo "Movie not found";
}

// Close the connection
$conn = null;
?>

    </div>
</body>
</html>
