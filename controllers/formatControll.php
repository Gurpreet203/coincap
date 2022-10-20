<?php
    class FormatNumber
    {
        public $format;

        function format($number)
        {
            if ($number < 1000000) {
            
                $this->format = number_format($number,2);
            } 
            else if ($number < 1000000000) {
               
                $this->format = number_format($number / 1000000, 2) . 'm';
            } 
            else {
               
                $this->format = number_format($number / 1000000000, 2) . 'b';
            }
            return $this->format;
        }
    }
?>