<?php
include 'include/header.php';

$user_id = $_SESSION['user_id'];

if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT username, profile_img, email, reg_date FROM user_credentials WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$pfp_path = $row['profile_img'];
$email = $row['email'];
$reg_date = $row['reg_date'];

if(empty($pfp_path)) {
    $pfp_path = "upload/profile-img/default.png";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="/blogg/css/style.css">
    <link rel="stylesheet" href="/blogg/css/profile.css">
</head>
<body>
    <div class="profile">
        <div class="profile-img">
            <img src="<?php echo $pfp_path; ?>" class="main-img" alt="User Profile Picture" width="200px">
        </div>

        <div class="profile-info">
            <div class="p-container">
                <p class="username"><b>Username: </b><?php echo $username; ?></p>
                <p class="email"><b>Email: </b><?php echo $email; ?></p>
                <p class="reg-date"><b>Registration date: </b><?php echo $reg_date; ?></p>
            </div>
        </div>

        <div class="profile-form-container">
            <form class="profile-form" id="profile-form" method="post" enctype="multipart/form-data">
            <input type="file" accept="image/png, image/jpeg" id="profile-img-upload" name="profile-img-upload"><br><br>
            <input type="submit" class="btn-submit" value="Change profile picture" name="pfp-submit">
            </form>
        </div>
    </div>

    <?php
        if(isset($_POST['pfp-submit'])) {
            require 'include/conn.php';
            
            $image_info = getimagesize($_FILES["profile-img-upload"]["tmp_name"]);
            $image_width = $image_info[0];
            $image_height = $image_info[1];

            if ($image_width > 1024 || $image_height > 1024) {
                echo "<p>Error: Image dimensions should be within 1024x1024 pixels.</p>";
                exit;
            }
        
            $sql = "SELECT profile_img FROM user_credentials WHERE id='$user_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $current_filepath = $row['profile_img'];
        
            if(file_exists($current_filepath)) {
                unlink($current_filepath);
            }
        
            $target_dir = "upload/profile-img/";
            $post_filepath = $target_dir . basename($_FILES["profile-img-upload"]["name"]);
            move_uploaded_file($_FILES["profile-img-upload"]["tmp_name"], $post_filepath);
        
            $sql = "UPDATE user_credentials 
            SET profile_img='$post_filepath' 
            WHERE id='$user_id'";
        
            if (mysqli_query($conn, $sql)) {
                header("Location: profile.php");
                exit();
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        
            mysqli_close($conn);
        }
    ?>
</body>
</html>