//Elijah Hilfiker
//11/24/2025
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<?php
$email = "";
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
}
$conn = new mysqli("localhost", "root", "mysql", "taus_data");
if ($conn->connect_error) {
    die("<div class='message'>Connection failed: " . $conn->connect_error . "</div>");
}
$stmt = $conn->prepare("SELECT * FROM tbl_student WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='message'>";
    echo "<h2>Student match found:</h2><br>";
    echo $row['firstName'] . " " . $row['lastName'] . "<br>";
    echo $row['email'];
    echo "</div>";  
} else {
    echo "<div class='message'>Email not found.</div>";
}
$stmt->close();
mysqli_close($conn);
?>
<a href="index.php">Return to form</a>
</body>
</html>