<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create post</title>
    <link rel="stylesheet" href="/blogg/css/post.css">
</head>
<body>
    <div class="post-form">
        <form action="#" id="post-form" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Create post</legend>

                <label for="title">Title: </label>
                <input type="text" id="title" name="title">

                <label for="img-upload">Select image: </label>
                <input type="file" accept="image/png, image/jpeg" id="img-upload" name="img-upload">

                <label for="main-text">Text: </label>
                <textarea type="text" id="main-text" name="main-text" rows="10" cols="50"></textarea>

                <input type="submit" value="Post" name="post">
            </fieldset>
        </form>
    </div>

<?php
    
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if(isset($_POST['post'])){
    require 'include/conn.php';

    $post_title = $_POST["title"];
    
    $target_dir = "upload/";

    $post_filepath = $target_dir . basename($_FILES["img-upload"]["name"]);

    move_uploaded_file($_FILES["img-upload"]["tmp_name"], $post_filepath);

    $post_text = $_POST["main-text"];

    $sql = "INSERT INTO blog_posts (title, img_path, text)
    VALUES ('$post_title', '$post_filepath', '$post_text')";

    if (mysqli_query($conn, $sql)) {
        header("Location: archive.php");
        exit();
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
</body>
</html>