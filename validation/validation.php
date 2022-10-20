<?php
    
    class Validate
    {
        
        public $error=array();
        
            function EmailPassValidate($email , $password)
            {
                
                if( empty($email) )
                {
                    $this->error['email'] = "please enter Email";
                }
                else
                {
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        $this->error['email'] = "please enter valid Email";
                    }
                }
        
                if( empty($password) )
                {
                    $this->error['pass'] = "please enter password";
                }
                else
                {
                    $password = trim($password);
                    if(empty($password))
                    {
                        $this->error['pass'] = "please don't enter spaces only password";
                    }
                    elseif(strlen($password)<8)
                    {
                        $this->error['pass'] = "please enter 8 digit password";
                    }
                }
                return $this->error;
            }
        
        // name validation function
        
            protected function nameValidate($name , $key)
            {
                
                if( !empty($name)  )
                {
                    $nam = ltrim($name);
                    if( is_numeric($nam) || preg_match('/[^a-z_+-0-9]/i', $nam) )
                    {
                        $this->error[$key] = "please enter correct $key ";
                    }
                    else
                    {
                        for( $i=0 ; $i<strlen($nam) ; $i++)
                        {
                            if($nam[$i]==" ")
                            {
                                $this->error[$key] = "please enter only $key ";
                            }
                        }
                    }
                    
                }
                else
                {
                $this->error[$key] = "please enter $key ";
                }
        
                return $this->error;
            }

            function coinValidate($data,$key)
            {
                if(empty($data))
                {
                    $this->error[$key] = "Please enter some coins";
                }

                elseif(!isset($_SESSION['login']))
                {
                    $this->error[$key] ="Please login to buy coins <a href='../user/login.php'>LogIn</a>";
                }

                return $this->error;
            }
    }
?>