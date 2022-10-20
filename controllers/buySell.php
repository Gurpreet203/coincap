<?php
    include '../validation/validation.php';
    include '../request/database.php';
    include_once '../request/request.php';

    $error = array();
    
    class BuySell extends Validate
    {
     
        private $Conn;

        function __construct()
        {
            $conn = new DataBase();
            $this->Conn = $conn->config();
            if(is_string($this->Conn))
            {
                echo $this->Conn;
                die;
            }
        }

        function buyCoins($coin)
        {
            global $error;

            $error = $this->coinValidate($coin,'buy');
            
            if(empty($error))
            {
                $obj=new ResponseAssets($_SESSION['coin']);

                $uid = $_SESSION['uid'];
                $coinid = $obj->response['data']['id'];

                $udata = $this->Conn->query("SELECT * FROM coins INNER JOIN wallet on coins.uid=wallet.uid WHERE coinid='$coinid' AND coins.uid='$uid'");
                $udata = $udata->fetch(PDO::FETCH_ASSOC);

                $price = $obj->response['data']['priceUsd'];
                $price = $price * $coin;
                
                if($udata)
                {
                    if($price < $udata['money'] && $udata['money']>0)
                    {
                        $previous = $this->Conn->query("SELECT numcoin,price from coins where uid='$uid'");
                        $previous = $previous->fetch(PDO::FETCH_ASSOC);
                        $money = $udata['money'] - $price;
                        $coin = $coin + $previous['numcoin'];

                        $price = $previous['price'] + $price;

                        try
                        {
                            $this->Conn->exec("UPDATE coins INNER JOIN wallet on coins.uid=wallet.uid SET numcoin='$coin' ,price='$price',money='$money' WHERE coins.coinid='$coinid' AND coins.uid='$uid'");
                        }
                        catch(Exception $e)
                        {
                            $error['buy'] = "Something went wrong in connection";
                        }
                    }
                    else
                    {
                        $error['buy'] = "Insufficient Balance";
                    }
                }
                else
                {
                    $wdata = array();
                    $wdata = $this->Conn->query("SELECT money FROM wallet WHERE uid='$uid'");
                    $wdata = $wdata->fetch(PDO::FETCH_ASSOC);

                    if(empty($wdata) || $wdata ==null)
                    {
                        $wdata['money'] = (int)0;
                    }

                    if($price < $wdata['money'] && $wdata['money']>0)
                    {
                        $money = $wdata['money'] - $price;
                        try
                        {
                            
                            $this->Conn->exec("INSERT INTO coins (uid,coinid,numcoin,price) VALUES ('$uid','$coinid','$coin','$price')");
                            $this->Conn->exec("UPDATE wallet SET money='$money' WHERE uid='$uid'");
                        }
                        catch(Exception $e)
                        {
                            $error['buy'] = "Something went wrong in connection";
                        }

                    }
                    else
                    {
                        $error['buy'] = "Insufficient Balance";
                    }
                   
                }
            
                if(empty($error))
                {
                    // $_SESSION['success'] = "Sucessfully Bought";
                    header('location:../user/userdetail.php');
                }
            }
        }

        function sellCoins($coin)
        {
            global $error;

            $error = $this->coinValidate($coin,'sell');
            if(empty($error))
            {
                $obj=new ResponseAssets($_SESSION['coin']);

                $uid = $_SESSION['uid'];
                $coinid = $obj->response['data']['id'];
    
                $udata = $this->Conn->query("SELECT * FROM coins INNER JOIN wallet on coins.uid=wallet.uid WHERE coinid='$coinid' AND coins.uid='$uid'");
                $udata = $udata->fetch(PDO::FETCH_ASSOC);
    
                $price = $obj->response['data']['priceUsd'];
                $price = $price * $coin;
    
                if($udata!=null && $udata['numcoin']>=$coin) 
                {
                    $previous = $this->Conn->query("SELECT coinid,numcoin,price,wallet.money FROM coins INNER JOIN wallet on coins.uid=wallet.uid WHERE coins.uid='$uid'");
                    $previous = $previous->fetch(PDO::FETCH_ASSOC);
    
                    $money = $udata['money'] + $price;
                    
                    $coin = $previous['numcoin'] - $coin;
                    $price = $previous['price'] - $price;
    
                    if($coin == 0)
                    {
                        $this->Conn->exec("DELETE FROM coins WHERE uid='$uid' AND coinid='$coinid'");
                        $this->Conn->exec("UPDATE wallet SET money='$money' WHERE uid='$uid'");
                    }
                    else
                    {
                        try
                        {
                            $this->Conn->exec("UPDATE coins INNER JOIN wallet on coins.uid=wallet.uid SET numcoin='$coin' ,price='$price',money='$money' WHERE coins.coinid='$coinid' AND coins.uid='$uid'");
                        }
                        catch(Exception $e)
                        {
                            $error['buy'] = "Something went wrong in connection";
                        }
                    }
                }
    
                else
                {
    
                    $error['sell'] = "You didn't have enough coins";
                }

            }

           

            if(empty($error))
            {
                $_SESSION['success'] = "Sucessfully Sold";
                header('location:../user/userdetail.php');
            }
        }
    
    }

?>
