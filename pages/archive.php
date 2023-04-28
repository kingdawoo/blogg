<?php
include 'include/header.php';

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

require 'include/conn.php';

$sql = "SELECT bp.title, bp.text, bp.img_path, bp.upload_date, uc.username, uc.profile_img
        FROM blog_posts bp
        INNER JOIN user_credentials uc ON bp.uploader_id = uc.id";
$result = mysqli_query($conn, $sql);  

if (!$result) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}

$content = '<div class="content">';

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $content .= "<div class='content-item'>" .
    "<div class='title'>" . $row["title"] . "</div>" . // Titel
    "<div class='upload-date'>". // Datum
    "<div class='popup'>Uploaded ".$row["upload_date"]. " By <a href='#' onclick='return false' class='username'>".$row["username"]. // Användarnamn
    "<span><img width='100px' alt='User Has No Profile Image ):' src=".$row["profile_img"]."></span></a></div>" . "</div>" .  // Profil bild
    "<div class='image'>" . "<img width=700px src=".$row["img_path"].">" . "</div>" . //Bild
    "<div class='text'>" . $row["text"] . "</div>" . // Text

    "<div class='user-box'><a href='#' onclick='return false' class='like'><img width='30px' src='/blogg/img/like.png' alt='Like Icon'></a>•
    <a href='#' onclick='return false' class='comment'><img width='30px' src='/blogg/img/chat.png' alt='Chat Icon'> 
    </a></div>" . // Like
    "</div>"; 
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
<?php include 'include/footer.php' ?>
</body>
</html>