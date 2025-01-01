<?php
$servername = "localhost";
$username = "shl"; 
$password = "123456"; 
$dbname = "shl"; 
$port = 3308;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['username'];
        $pass = $_POST['password']; 
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, first_name, last_name) 
                                VALUES (:username, :password, :email, :first_name, :last_name)");

        $stmt->bindParam(':username', $user);
        $stmt->bindParam(':password', $pass);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        if ($stmt->execute()) {
            echo "Successful registration！";
        } else {
            echo "registration failure.";
        }
    }
} catch(PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}

$conn = null;
?>