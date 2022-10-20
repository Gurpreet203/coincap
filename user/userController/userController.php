<?php
    include '../validation/validation.php';
    include '../request/database.php';

    class User extends Validate
    {
        private $Data;
        private $Conn;

        function __construct($data=null)
        {
            $conn = new DataBase();
            $this->Conn = $conn->config();
            if(is_string($this->Conn))
            {
                echo $this->Conn;
                die;
            }
            $this->Data = $data;
        }

        function signup()
        {
            global $error;
            $error = $this->nameValidate($this->Data['fname'],'fname');
            $error = $this->nameValidate($this->Data['lname'],'lname');
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $first = $this->Data['fname'];
                $last = $this->Data['lname'];
                $email = $this->Data['email'];
                $pass = $this->Data['pass'];
                try
                {
                   
                    $this->Conn->exec("INSERT INTO User (first_name,last_name,email,password) VALUES ('$first','$last','$email','$pass')");
                    header('location:login.php');
                }
                catch(Exception $e)
                {
                    $error['email'] = "Email already exist";
                }

            }
        }

        function login()
        {
            global $error;
            $error = $this->EmailPassValidate($this->Data['email'],$this->Data['pass']);

            if(empty($error))
            {
                $email = $this->Data['email'];
                $pass = $this->Data['pass'];
                $data = $this->Conn->query("SELECT id,email,password FROM user WHERE email = '$email' AND password='$pass'");
                $data = $data->fetch(PDO::FETCH_ASSOC);

               if(!$data)
                {
                    $error['login'] = "please enter correct email or password";
                }
               else
                {
                    session_start();                  
                    
                    $_SESSION['uid'] = $data['id'];
                    $_SESSION['login'] = true;
                    if(isset($_SESSION['coin']))
                    {
                        header('location:../assets/show.php?name='.$_SESSION['coin']);  
                    }
                    else
                    {
                        header('location:../index.php');  
                    }
                          
                }
                
            }
        }

        function details()
        {
            
            $uid = $_SESSION['uid'];
            $data = $this->Conn->query("SELECT * FROM coins where uid='$uid'");
            $data = $data->fetchAll(PDO::FETCH_ASSOC);

            $wdata = $this->Conn->query("SELECT money FROM wallet where uid='$uid'");
            $wdata = $wdata->fetch(PDO::FETCH_ASSOC);

            if(!empty($wdata))
            {
                $data['money'] = $wdata['money'];
            }

            return $data;            
        }

        function addMoney()
        {
            
            $uid = $_SESSION['uid'];
            $money = $this->Data;
            $data = $this->Conn->query("SELECT * FROM wallet WHERE uid='$uid'");
            $data = $data->fetch(PDO::FETCH_ASSOC);
            if($data)
            {
                try{
                    $money = $data['money'] + $money;   
                    $this->Conn->exec("UPDATE wallet SET money='$money' WHERE uid='$uid'");
                }
                catch(Exception $e)
                {
                    echo "Something went wrong";
                    die;
                }
                
            }
            else
            {
                try{
                    $this->Conn->exec("INSERT INTO wallet (uid,money) VALUES('$uid','$money')");
                }
                catch(Exception $e)
                {
                    echo "Something went wrong";
                    die;
                }
            }
            $_SESSION['success'] = "Money Added Successfully";
            header("location:userdetail.php");
            
        }
    }
?>