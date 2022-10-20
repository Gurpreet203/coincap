<?php

    class ResponseAssets
    {
        public $response;
         
        function __construct($name=null)
        {
            if($name !=null)
            {
                $name = trim($name);
                $name = strtolower($name);
                $name = str_replace(' ',"-",$name);
                $url = "https://api.coincap.io/v2/assets/".$name."";
                $ch = curl_init();
                curl_setopt_array($ch,[CURLOPT_URL=>$url,CURLOPT_RETURNTRANSFER=>true]);
            
                $this->response = curl_exec($ch);
                $error = curl_error($ch);
                curl_close($ch);

                if($error)
                {
                    $this->response = 'Something Went Wrong , Check Internet Connection Or Something Else';
                }
                else
                {
                    $this->response = json_decode($this->response,true);
                }
            
                
            }
            else
            {
                $url = "https://api.coincap.io/v2/assets";
                $ch = curl_init();
                curl_setopt_array($ch,[CURLOPT_URL=>$url,CURLOPT_RETURNTRANSFER=>true]);
            
                $this->response = curl_exec($ch);
                $error = curl_error($ch);
                curl_close($ch);
            
                if($error)
                {
                    $this->response = 'Something Went Wrong , Check Internet Connection Or Something Else';
                }
                else
                {
                    $this->response = json_decode($this->response,true);
                }
            }
        }
    }
   
?>