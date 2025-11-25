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
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
}
$conn = mysqli_connect("localhost", "root", "", "taus_data");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "</div>");
}
$sql = "SELECT * FROM tbl_student WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "div class='message'>";
    echo "<h2>Student match found:br>";
    echo $row[firstname] . " " . $row[lastname] . "<br>";
    echo "Email'];
    echo "</div>";
} else {
    echo "<div class='message'>Email not found.</div>";
}
    mysqli_close($conn);
?>
<a href="index.php">Return to form</a>
</body>
</html>