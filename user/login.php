<?php
    include 'userController/userController.php';
    
    if(isset($_POST['submit']))
    {
        $obj = new User($_POST);
        $obj->login();
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
   
    <form action="" method="post" class="login">
    <?php
        if(isset($error['login']))
        {
            echo "<p class='error error-login'>".$error['login']."</p>";
        }
    ?>
        <h1>LogIn</h1>
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
        <input type="submit" name="submit" value="LogIn">
        <a href="signup.php">Don't have a account ?? SignUp</a>

        <?php
            if(isset($_SESSION['coin']))
            {
                echo "<a href='../assets/show.php?name=".$_SESSION['coin']."'>Back</a>";
            }
            else
            {
                echo "<a href='../index.php' style='margin-top:5px;'>Back</a>";
            }
        ?>
        
    </form>    
</body>
</html>