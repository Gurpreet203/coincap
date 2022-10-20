<?php
    session_start();
    if(!isset($_SESSION['login']))
    {
        header('location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/userStyle.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body class="details-body">
    <nav class="user-nav">
        <div>
            <img src="https://coincap.io/static/logos/black.svg" alt="logo">
        </div>
        <div class="center-element">
            <a href="wallet.php">Add Balance</a>
            <?php
               
                if(isset($_SESSION['success']))
                {
                    echo "<p class='success'>".$_SESSION['success']."</p>";
                    unset($_SESSION['success']);
                }
            ?>
        </div>
        <div>
            <a href="../index.php" class="home"><i class="bi bi-house-fill"></i></a>
            <a href="logout.php">LogOut</a>
        </div>
    </nav>
    <section>

    <?php
        include_once 'userController/userController.php';

        $obj = new User();   
        $data = $obj->details();
        if(isset($data['money']))
        {
            echo "<h2>Wallet Balance = $".number_format($data['money'],2)."</h2>";
        }
        if(empty($data[0]))
        {
            echo "<h1>No Record Found</h1>";die;
        }

        echo "<table cellspacing=0 class='user-table'>";
        echo "<tr> <th>Coin</th> <th>Number of Coins</th> <th>Price</th> </tr>";

        foreach($data as $key=>$value)
        {
            if($key=='money')
            {
                break;
            }
            echo "<tr>";

            echo "<td>".$value['coinid']."</td>";
            echo "<td>".$value['numcoin']."</td>";
            echo "<td> $".number_format($value['price'],2)."</td>";
        }
    
    ?>
    </section>
</body>
</html>
