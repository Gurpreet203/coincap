<?php

    class DataBase
    {
        public $dbConn;
        private $dbHost="localhost:8000";  
        private $dbName="coincap";  
        private $dbUser="root";      
        private $dbPassword="";  

        function __construct()
        {
            try
            {
                $this->dbConn = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName",$this->dbUser,$this->dbPassword); 
            }
            catch(Exception $e)
            {
                $this->dbConn =  "Connection Problem";
            }
        }
        function config()
        {
            return $this->dbConn;
        }
    }
?>