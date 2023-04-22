<?php
include 'include/header.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

require 'include/conn.php';

$sql = "SELECT title, text, img_path, upload_date FROM blog_posts";
$result = mysqli_query($conn, $sql);

$content = '<div class="content">';

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $content .= $row["title"] . " " . $row["text"] . "<img width=200 src=".$row["img_path"].">" . $row["upload_date"] . "<br>";
  }
} else {
  echo "0 results";
}

$content .= '</div>';
echo $content;

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive</title>
    <link rel="stylesheet" href="/blogg/css/style.css">
    <link rel="stylesheet" href="/blogg/css/archive.css">
</head>
<body>

</body>
</html>