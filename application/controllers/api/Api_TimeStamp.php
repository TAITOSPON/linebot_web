<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_TimeStamp extends REST_Controller{

      public function __construct(){

        parent::__construct();
        $this->load->model('Model_User');
        $this->load->model('Model_TimeStamp');
        
     }

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


   public function GetLoginLog_get(){
      $result = $this->Model_TimeStamp->GetLoginLog();
      echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      
   }

   //   public function fixed_log_get(){




   //    $data = $this->Model_TimeStamp->Getalluserfixed();
   //    // echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

   //    // print_r($data);

   //    $new_data = array();
   //    for($index=0; $index < sizeof($data); $index++){ 

   //       // if($data[$index]["user_ad_code"] == "003599"){
   //          // print_r($data[$index]);

   //          $user_ad_code = $data[$index]['user_ad_code'];
   //          $data_Getdataforfixed = $this->Model_TimeStamp->Getdataforfixed( $user_ad_code);

   //          // print_r($data_Getdataforfixed)  ;

   //          $time_log = strtotime($data_Getdataforfixed[0]['time_stamp_log']);
   //          $date = date("Y-m-d H:i:s", strtotime('-1 minutes' ,  $time_log ));
            
   //          $result['user_ad_code'] = $user_ad_code;
   //          $result['category'] = "LINE_KT";
   //          $result['timestamp'] = $date;


   //          // $PostTimeStamp_result =  array(json_decode($this->Model_TimeStamp->PostTimeStamp($result), true)); 

   //          array_push($new_data, $result);
   //          // print_r($PostTimeStamp_result);

   //       // }

   //    }

   //    print_r($new_data);
            
   //    // $data = $this->Model_TimeStamp->Getdataforfixed();
   //    // echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


   //    // $result['user_ad_code']  = $data;
  

   //    // $PostTimeStamp_result =  array(json_decode($this->Model_TimeStamp->PostTimeStamp($result), true)); 
   //    // print_r( $PostTimeStamp_result);
   //   }


}
