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
$conn = mysqli_connect("localhost", "root", "", "taus_data");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$stmt = $conn->prepare("SELECT * FROM tbl_student WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<div class='message'>";
    echo "<h2>Student match found:</h2><br>";
    echo $row['firstname'] . " " . $row['lastname'] . "<br>";
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