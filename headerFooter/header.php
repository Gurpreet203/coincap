<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="nav-items">
            <ul>
                
                <?php
                  
                    if(isset($_SESSION['coin']))
                    {
                        $urlw = "../user/wallet.php";
                        $urld = "../user/userdetail.php"; 
                        $urlh = "../index.php";
                    }
                    else
                    {
                        $urlw = "user/wallet.php";
                        $urld = "user/userdetail.php";
                        $urlh = "index.php";
                    }
                    echo '<li><a href="'.$urlw.'">Wallet</a></li>
                        <li><a href="'.$urld.'">User Details</a></li>';
                ?>
            </ul>
        </div>

        <div class="nav-icon">
            <img src="https://coincap.io/static/logos/black.svg" alt="Logo">
        </div>

        <div class="nav-search">
            <form action="" method="post">
                <input type="text" id="search" name="search">
                <label for="search" class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                </label>
            </form>
            <a href=<?php echo $urlh?> class="home"><i class="bi bi-house-fill"></i></a>
            <a href="" class="btn">Refresh</a>
            <?php
                if(isset($_SESSION['login'])&&!isset($_SESSION['coin']))
                {
                    echo ' <a href="user/logout.php" class="btn">Logout</a>';
                }
                if(isset($_SESSION['coin']))
                {
                    echo ' <a href="../user/logout.php" class="btn">Logout</a>';
                }
            ?>
        </div>
    </nav>
   
</body>
</html>