<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>

<body>
    <?php
        session_start();
        if(isset($_SESSION['coin']))
        {
            unset($_SESSION['coin']);
        }
        require_once 'headerFooter/header.php';
    ?>
    <section>
        <div class="banner">
            <p>MARKET CAP <span>$1.11T</span></p>
            <p>EXCHANGE VOL <span>$22.87B</span></p>
            <p>ASSETS <span>2,295</span></p>
            <p>EXCHANGES <span>73</span></p>
            <p>MARKETS <span>13,864</span></p>
            <p>BTC DOM INDEX <span>32.8%</span></p>
        </div>
    </section>
</body>
</html>

<?php
    include 'request/request.php';
    include 'controllers/formatControll.php';

    if(isset($_POST['search']))
    {
        header('location:assets/show.php?name='.$_POST['search']);
    }

    $obj = new ResponseAssets();
   

    if(is_string($obj->response))
    {
        echo "<h2 style='margin:200px;'>".$obj->response."</h2>";
        require_once 'html/footer.html';
        die;
    }

    echo "<div class='coin-table'><table cellspacing=0>";

    echo "<tr> 
    <th class='rank-th'>Rank <i class='bi bi-caret-up-fill arrow'></i></th>
    <th class='name'>Name</th>
    <th>Price</th>
    <th>Market Cap</th>
    <th>VWAP (24Hr)</th>
    <th>Supply</th>
    <th>Volume (24Hr)</th>
    <th>Change (24Hr)</th>
    </tr>";

    $convert = new FormatNumber();

    foreach($obj->response['data'] as $value)
    {
        echo "<tr>";

        echo "<td class='rank'>". $value['rank']."</td>";
        echo "<td class='name'> <div class='coin-name'><div><img src='https://assets.coincap.io/assets/icons/".strtolower($value['symbol'])."@2x.png' class='icon' alt='icon'></div><div class='coin-link'><a href='assets/show.php?name=".$value['id']."'>". $value['name']."<br><span>".$value['symbol']."</span></a></div></td>";
        echo "<td>$".$convert->format($value['priceUsd'])."</td>";
        echo "<td>$".$convert->format($value['marketCapUsd'])."</td>";
        echo "<td>$".$convert->format($value['vwap24Hr'])."</td>";
        echo "<td>". $convert->format($value['supply'])."</td>";
        echo "<td>$".$convert->format($value['volumeUsd24Hr'])."</td>";
        if($value['changePercent24Hr']<0)
        {
            echo "<td class='red'>";
        }
        else
        {
            echo "<td class='green'>";
        }
        echo $convert->format($value['changePercent24Hr'])."%</td>";

        echo "</tr>";
    }

    echo "</table></div>";

    require_once 'headerFooter/footer.html';

?>