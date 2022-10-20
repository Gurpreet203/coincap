<?php
    include 'userController/userController.php';
    
    if(isset($_POST['submit']))
    {
        $obj = new User($_POST);
        $obj->signup();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/userStyle.css">
    <title>Document</title>
</head>
<body class="body">
    <form action="" method="post" class="signup">
        <h1>SignUp</h1>
        <label for="fname">First Name</label>
        <input type="text" placeholder="First Name" name="fname">
            <?php
                if(isset($error['fname']))
                {
                    echo "<p class='error'>".$error['fname']."</p>";
                }
            ?>
        <label for="lname">Last Name</label>
        <input type="text" placeholder="Last Name" name="lname">
            <?php
                if(isset($error['lname']))
                {
                    echo "<p class='error'>".$error['lname']."</p>";
                }
            ?>
        <label for="email">Email</label>
        <input type="email" placeholder="Email" name="email">
            <?php
                if(isset($error['email']))
                {
                    echo "<p class='error'>".$error['email']."</p>";
                }
            ?>
        <label for="pass">Password</label>
        <input type="password" placeholder="password" name="pass">
            <?php
                if(isset($error['pass']))
                {
                    echo "<p class='error'>".$error['pass']."</p>";
                }
            ?>
        <input type="submit" name="submit" value="SignUp">
        <a href="login.php">Already have a account ?? LogIn</a>
    </form>    
</body>
</html>