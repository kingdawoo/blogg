<?php
include 'include/header.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

require 'include/conn.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_img FROM user_credentials WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$pfp_path = $row['profile_img'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home <?php echo $user_id; ?></title>
    <link rel="stylesheet" href="/blogg/css/style.css">
</head>
<body>

  <div class="main">
    <h2>Welcome to the Dragon Blog, <?php echo $username; ?></h2>
  </div>
  <img class="img-goku" src="/blogg/img/goku.jpg" alt="Son Goku"> 

  <?php include 'include/footer.php' ?>
</body>
</html>