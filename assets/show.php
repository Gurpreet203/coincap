<!DOCTYPE html>
<html>
<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/showPage.css">
   
</head>
</html>

<?php
    session_start();
    $_SESSION['coin'] = $_GET['name'];
    require_once '../headerFooter/header.php';
    include '../request/request.php';
    include '../controllers/formatControll.php';

    if(isset($_POST['search']))
    {
        header('location:show.php?name='.$_POST['search']);
        
    }

    $convert = new FormatNumber();
   
    $obj=new ResponseAssets($_GET['name']);

    if(!empty($obj->response['error']) || empty($_GET['name']))
    {
        header('location:../index.php');
    }

    $_SESSION['coin'] = $obj->response['data']['id'];

    $date = new DateTime("now",new DateTimeZone("Asia/Kolkata"));

    $date = $date->format('j F Y');

    if(is_string($obj->response))
    {
        echo "<h2 style='margin:200px;'>".$obj->response."</h2>";
        require_once '../html/footer.html';
        die;
    }

 
    echo '
    
        <section class="banner-show">

        <div class="outter-rank">
            <div class="rank">
            <div class="design"></div>
            <div class="banner-rank">
                <p>'.$obj->response['data']['rank'].'</p><span>Rank</span>
            </div>
            </div>
            <h1 class="asset-head">'.$obj->response['data']['name'].' ('.$obj->response['data']['symbol'].')
                <span class="assetPrice">$'.$convert->format($obj->response['data']['priceUsd']).'';


                if($obj->response['data']['changePercent24Hr']>0)
                {
                    echo '<span class="green">'.$convert->format($obj->response['data']['changePercent24Hr']).'% <i class="bi bi-caret-up-fill"></i></span></span>';
                }
                else
                {
                    echo '<span class="red">'.$convert->format($obj->response['data']['changePercent24Hr']).'% <i class="bi bi-caret-down-fill"></i></span></span>';
                }
    echo "</div> ";     
    echo '</h1>
            <p class="banner-data">MARKET CAP <span>$'.$convert->format($obj->response['data']['marketCapUsd']).'</span>
            <a href="../index.php" class="btn">Website</a>
            </p>
           
            <p class="banner-data">Volume (24Hr) <span>'.$convert->format($obj->response['data']['volumeUsd24Hr']).'</span>
            <a href="'.$obj->response['data']['explorer'].'" class="btn" target="_blank">Explore</a>
            </p>
            <p class="banner-data">Supply <span>'.$convert->format($obj->response['data']['supply']).' '.$obj->response['data']['symbol'].'</span></p>
    </section>';


    echo '
        <section class="chart-section">
        <div class="detail-section">
                <div class="assetName-right">
                    <div>
                        <img src="https://assets.coincap.io/assets/icons/'.strtolower($obj->response['data']['symbol']).'@2x.png" alt="icon">
                    </div>
                    <div>
                        <p>'.$obj->response['data']['name'].' ('.$obj->response['data']['symbol'].')
                        <span>'.$date.'</span></p>
                    </div>
                </div>
                <div class="assetsAllRates">
                    <div>
                        <h3>HIGH</h3><p>$19,685.33</p>
                    </div>
                    <div>
                        <h3>AVERAGE</h3><p>$19,685.33</p>
                    </div>
                    <div>
                        <h3>LOW</h3><p>$19,685.33</p>
                    </div>
                    <div>
                        <h3>CHANGE</h3>'
                    ;
                    if($obj->response['data']['changePercent24Hr']>0)
                    {
                        echo '<p class="green">'.$convert->format($obj->response['data']['changePercent24Hr']).'% <i class="bi bi-caret-up-fill"></i></p>';
                    }
                    else
                    {
                        echo '<p class="red">'.$convert->format($obj->response['data']['changePercent24Hr']).'% <i class="bi bi-caret-down-fill"></i></p>';
                    }
                echo '</div>
                </div>
                </div>
        </section>
        ';

    echo '
        <section class="chartAndForm">
            <div class="chartImage">
                ';

        if($obj->response['data']['changePercent24Hr']>0)
        {
            echo '<img src="../images/positive.png">';
        }
        else
        {
            echo '<img src="../images/negative.png">';
        }

    echo '</div>';
    

    include_once 'form.php'; 

    echo '</section>';

    require_once '../headerFooter/footer.html';
 
?>

