<?php
    include 'userController/userController.php';
    session_start();

    if(!isset($_SESSION['login']))
    {
        header('location:login.php');
    }
    
    if(isset($_POST['submit']))
    {
        $obj = new User($_POST['money']);
        $obj->addMoney();
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
        <h1>Add Balance</h1>
        <label for="email">Balance $</label>
        <input type="number" name="money" min="1" required placeholder="Amount">
        <input type="submit" name="submit" value="Add">
        <?php
            if(isset($_SESSION['coin']))
            {
                echo "<a href='../assets/show.php?name=".$_SESSION['coin']."'>Back</a>";
            }
            else
            {
                echo "<a href='../index.php'>Back</a>";
            }
        ?>
        
    </form>    
</body>
</html>