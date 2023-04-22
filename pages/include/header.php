<?php
session_start(); 

require 'conn.php';

// Märkte försent att man inte kan använda variabler utanför include i den

$user_id = $_SESSION['user_id'];
$sql = "SELECT username, profile_img FROM user_credentials WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$pfp_path = $row['profile_img'];

if(empty($pfp_path)) {
    $pfp_path = "upload/profile-img/default.png";
}

?>
<div class="navigation-bar">
    <img class="img-ball" src="/blogg/img/one_star_ball.jpg" alt="One Star Dragon Ball" width="50px" height="50px">
    <a href="/blogg/pages/index.php">Home</a>
    <a href="/blogg/pages/archive.php">Posts</a>
    <a href="/blogg/pages/contact.php">Contact</a>
    <a href="/blogg/pages/profile.php">Profile</a>
    <img class="img-profile" id="img-profile" src="/blogg/pages/<?php echo $pfp_path; ?>" alt="Profile Icon Navigation Bar" width="60px" height="60px">
    <a class="btn-right" style="color:red; margin-right: 20px" href="/blogg/pages/logout.php">Logout</a>
    <a class="btn-right" href="/blogg/pages/post.php">Create a post</a>
</div>