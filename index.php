<?php
    $conn = mysqli_connect('localhost','root','');
    mysqli_select_db($conn,'login_bd');
    $errors = array();
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
      
        if (empty($username)) {
            array_push($errors, "Username is required");
        }
        if (empty($password)) {
            array_push($errors, "Password is required");
        }
      
        if (count($errors) == 0) {
            
            $query = "SELECT * FROM login_page WHERE username='$username' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: home.php');
            }else {
                array_push($errors, "Wrong username/password combination");
            }
        }
      }
?>

<html>
<head>
    <title>Login page</title>
</head>
<body>
    <form method="post">
        <?php include('errors.php'); ?>
        <div>
            <p>Username</p>
            <input name="username" type="text" placeholder="Enter username...">
        </div>
        <div>
            <p>Password</p>
            <input name="password" type="password" placeholder="Enter password...">
        </div>
        <button type="submit" name="login_user">Login</button>
    </form>
</body>
</html>