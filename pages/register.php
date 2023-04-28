<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="/blogg/css/register.css">
    <script src="/blogg/js/script.js" defer></script>
</head>
<body>
    <div class="reg-form">
        <form action="#" id="reg-form" method="post" onsubmit="return validateReg()">
            <fieldset>
                <legend>Registration</legend>

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email">

                <input type="submit" value="Create account" name="register">
            </fieldset>
        </form>
    </div>
    
<?php
if(isset($_POST['register'])){
    require 'include/conn.php';

    $post_username = $_POST["username"];
    $post_password = $_POST["password"];
    $post_email = $_POST["email"];

    $sql = "INSERT INTO user_credentials (username, password, email)
    VALUES ('$post_username', '$post_password', '$post_email')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
        exit();
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<?php include 'include/footer.php' ?>
</body>
</html>