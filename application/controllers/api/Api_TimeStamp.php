<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_TimeStamp extends REST_Controller{

     public function index_get(){}


     public function TimeStamp_DataNow_get(){
          
        date_default_timezone_set('Asia/Bangkok'); 

        $info = getdate();
        $date = $info['mday'];
        $month = $info['mon'];
        $year = $info['year'];
        $hour = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];
        
  
        $date =  date_format(date_create("$year-$month-$date"),"Y-m-d");
        $time = date_format(date_create("$hour:$min:$sec"),"H:i:s");
  
        $value ="$time:$date:$date";
        echo $value;

     }


}
