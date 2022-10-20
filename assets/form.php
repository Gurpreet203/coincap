<?php
    include '../controllers/buySell.php';

    $obj = new BuySell();

    if(isset($_POST['sellbtn']))
    {
        $obj->sellCoins($_POST['sell']);
    }

    elseif(isset($_POST['buybtn']))
    {
        $obj->buyCoins($_POST['buy']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <form action="" method="post" class="sellbuy">
        
        <h1>Buy Sell</h1>
        <?php
        
            
        ?>
        <label for="sell">Sell</label>
        <input type="number" name="sell" placeholder="Number of coins" min="1">
            <?php
              if(!empty($error['sell']))
                {
                    echo "<p class='error'>".$error['sell']."</p>";
                }
            ?>
        <input type="submit" name="sellbtn" value="SELL" id="proceed">
        <label for="buy">Buy</label>
        <input type="number" name="buy" placeholder="Number of coins" min="1">
            <?php
                if(!empty($error['buy']))
                {
                    echo "<p class='error'>".$error['buy']."</p>";
                }
            ?>
        <input type="submit" name="buybtn" value="BUY" id="proceed">
    </form>
</body>
</html>