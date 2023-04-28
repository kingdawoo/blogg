<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/blogg/css/login.css">
</head>
<body>

<div class="login-form">
        <form id="login-form" method="post">
            <fieldset>
                <legend>Login</legend>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <input type="submit" value="Login" name="login">

                <label for="remember" style="margin-left: 20px">Keep me logged in: </label>
                <input type="checkbox" value="1" name="remember">
            </fieldset>
        </form>

        <p>Don't have an account?   <a style="color:white;" href="register.php">Click here!</a></p>
</div>

<?php
require 'include/conn.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id FROM user_credentials WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];

        header('Location: index.php');
        exit;
    } else {
        echo '<p class="error">Invalid email or password.</p>';
    }
}
?>

<?php include 'include/footer.php' ?>
</body>
</html>