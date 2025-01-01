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
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
            $hashedPassword = $row['password'];
            if (password_verify($pass, $hashedPassword)) {
                echo "Login Successful！";
            } else {
                echo "incorrect password！";
            }
        } else {
            echo "The user does not exist！";
        }
    }
} catch(PDOException $e) {
    echo "Database connection failure: " . $e->getMessage();
}
$conn = null;
?>