<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class TimeStamp extends CI_Controller {  
      

    var $liff_id = "1655109480-MXKb06wG";

    public function __construct(){

        parent::__construct();
        $this->load->model('Model_User');
        $this->load->model('Model_TimeStamp');
        
    }

    public function index()  
    {       
        $data = array( 
            'site_url' => "TimeStamp/TimeStamp" ,
            'liff_id' => $this->liff_id,
        );
   
     
        $this->load->view('login_check_view', $data); 
     
   
    }  

    public function get_data_detail(){

        $ip_address=file_get_contents('http://checkip.dyndns.com/');
        echo $ip_address ;
        echo "<br>";
        echo "<br>";
        echo $this->GetClientIP();
        echo "<br>";
        echo "<br>";
        echo  $this->CheckisLocalIPAddress($this->GetClientIP());
        echo "<br>";
        echo "<br>";
        echo $_SERVER['PHP_SELF'];
        echo "<br>";
        echo $_SERVER['SERVER_NAME'];
        echo "<br>";
        echo $_SERVER['HTTP_HOST'];
        echo "<br>";
        echo $_SERVER['HTTP_USER_AGENT'];
        echo "<br>";
        echo $_SERVER['SCRIPT_NAME'];

    }

 
    public function GetClientIP() {

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');

        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');

        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');

        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = '';
        return $ipaddress;

    }

    public function CheckWFH(){
        
        $status_wfh = "false";
        $result_CheckUserWFH =  array(json_decode($this->Model_TimeStamp->CheckUserWFH($user_ad_code), true));

        if(sizeof($result_CheckUserWFH) != 0){

            if(is_array($result_CheckUserWFH[0]['msg'])){
                if(sizeof($result_CheckUserWFH[0]['msg']) != 0){
                    $WFH_ID = $result_CheckUserWFH[0]['stat'];
                    if($WFH_ID == 1){
                        $status_wfh ="true";
                    }
                }
            
            }

        }
    }


    public function CheckisLocalIPAddress($IPAddress,$user_ad_code,$status_wfh){
       
        $feed_time = "";

        if($status_wfh == ""){

            $status_wfh = "false";
        
            $result_CheckUserWFH =  array(json_decode($this->Model_TimeStamp->CheckUserWFH($user_ad_code), true));

            if(sizeof($result_CheckUserWFH) != 0){

                if(is_array($result_CheckUserWFH[0]['msg'])){
                    if(sizeof($result_CheckUserWFH[0]['msg']) != 0){
                        $WFH_ID = $result_CheckUserWFH[0]['stat'];
                        if($WFH_ID == 1){
                            $status_wfh ="true";
                        }
                    }
                
                }

            }

        }
   
        
        if($status_wfh == "false"){
           
            $statuscheck_wifi = "false";
            $staus_location = "";
            $category = "";
           
            if($this->CheckwifiLocalIP($IPAddress) == ''){
                
                if($this->CheckwifiRealIP($IPAddress) == ''){

                    $statuscheck_wifi = "false";
                    $category = "";

                }else{
                    $statuscheck_wifi = "true";
                    $category = $this->CheckwifiRealIP($IPAddress);
                }
              
            }else{
                $statuscheck_wifi = "true";
                $category = $this->CheckwifiLocalIP($IPAddress);
            }
            
        }else{

           
            $statuscheck_wifi = "true";
            $category = "LINE_WFH";
          

            if($this->CheckwifiLocalIP($IPAddress) == ''){
                
                if($this->CheckwifiRealIP($IPAddress) == ''){

                    $statuscheck_wifi = "true";
                    $category = "LINE_WFH";

                }else{
                    $statuscheck_wifi = "true";
                    $category = $this->CheckwifiRealIP($IPAddress);
                }
              


            }else{
                $statuscheck_wifi = "true";
                $category = $this->CheckwifiLocalIP($IPAddress);
            }

        }
        

        $StatusCheck = array(
            'statuscheck_wifi' => $statuscheck_wifi,
            'feed_time' => $feed_time,
            'category' => $category,
            'ip' => $IPAddress,
            'status_wfh' => $status_wfh

        );

        return $StatusCheck;
  
       
    }

    public function CheckwifiLocalIP($IPAddress){

         //172.16 // KT 0
         //172.31 // rot 1
        //172.18. // wan 2

        // "LINE_KT" , LINE_ROJANA , LINE_WAN , LINE_WFH

        $category = "";
        $staus_location = "";

        $wifi_toat_local =  array(
            "172.16." , 
            "172.31." , 
            "172.18."
        );

        $ip = substr((string)$IPAddress, 0, 7);

        for($index=0; $index< sizeof($wifi_toat_local); $index++){
            if($ip == $wifi_toat_local[$index]){
                $staus_location = (string)$index;
            }
        }

        if($staus_location == "0"){

            $category = "LINE_KT";

        }else if($staus_location == "1"){

            $category = "LINE_ROJANA";

        }else if($staus_location == "2"){

            $category = "LINE_WAN";

        }
        

        return $category;

    }

    public function CheckwifiRealIP($IPAddress){

        $category = "";
        $staus_location = "";

        $wifi_toat =  array(
            "103.144.44.222",
            "103.144.44.190",

            "58.137.230.176",
            "203.146.190.32", 
            "58.137.230.179",
            "58.137.230.178",

            "1.4.158.35" // LUMPANG

        );

        $ip = $IPAddress;

        for($index=0; $index< sizeof($wifi_toat); $index++){
            if($ip == $wifi_toat[$index]){
                $staus_location = (string)$index;
            }
        }
     
        if($staus_location == "0"){

            $category = "LINE_ROJANA";

        }else if($staus_location == "1"){

            $category = "LINE_ROJANA";

        }else if($staus_location == "2"){

            $category = "LINE_KT";
            
        }else if($staus_location == "3"){

            $category = "LINE_KT";

        }else if($staus_location == "4"){

            $category = "LINE_KT";

        }else if($staus_location == "5"){

            $category = "LINE_KT";

        }else if($staus_location == "6"){

            $category = "LINE_NTM_LAMPANG";
        }
        

        return $category;

    }



 
    public function TimeStamp(){

        $user_line_uid['user_line_uid'] = $this->input->post('user_line_uid');
        
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
              
                $data = array(  
                    'site_url' => "TimeStamp/PostTimestamp",
                    'result_user' => $result_user[0],
                    'liff_id' => $this->liff_id,
                    'status_time_stamp' => array(
                                                'ip'=> $this->GetClientIP() , 
                                                'status' => $this->CheckisLocalIPAddress($this->GetClientIP() , $result_user[0]['user_ad_code'] , "")
                                                )
                );
                $this->load->view('Time_stamp_view', $data);
           
           
           
            }else{
                $data = array( 'liff_id' =>  $this->liff_id, 'text_status' => "" );
                $this->load->view('login_success_view',$data);
            }
           
        }else{
            $data = array(  'liff_id' =>  $this->liff_id,'text_status' => "Time_Stamp_True" );
            $this->load->view('login_success_view',$data);
        }
    }


    public function PostTimestamp(){
       
        $result['user_ad_code']  = $this->input->post('user_ad_code');
        $result['category']  = $this->input->post('category');
        $result['timestamp']  = $this->input->post('timestamp');
        $result['user_line_uid'] = $this->input->post('user_line_uid');
        $result['ip'] = $this->input->post('ip');
        $result['status_wfh'] = $this->input->post('status_wfh');
        $result['latlon'] = $this->input->post('latlong');
        $result['os'] = $this->input->post('os');



        if($result['user_ad_code'] != NULL){

            $status_time_stamp = $this->CheckisLocalIPAddress($this->GetClientIP() , $result['user_ad_code'] , $result['status_wfh']);

            // if($status_time_stamp['statuscheck_wifi'] == "true"){

                $result['time_stamp_log_status_wifi'] = $status_time_stamp;
        
                $PostTimeStamp_result =  array(json_decode($this->Model_TimeStamp->PostTimeStamp($result), true)); 
            

                if(sizeof($PostTimeStamp_result) != 0){


                    if( $PostTimeStamp_result[0]["status_old"] == 200 &&  $PostTimeStamp_result[0]["status_new"] == 200){
            
                        $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "time_stamp_true" ,'msg' => "บันทึกเวลาสำเร็จ"));

                    
                    }else{
                        $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "error",'msg' => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง" ));
                        
                        $result['time_stamp_log_result'] = $PostTimeStamp_result;
                        $this->Model_TimeStamp->Insert_Log_Time_Stamp_error($result);
                    }
                
            
                    $result['time_stamp_log_result'] = $PostTimeStamp_result;
                    $this->Model_TimeStamp->Insert_Log_Time_Stamp($result);

                }else{

                    $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "error",'msg' => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง" ));

                    $result['time_stamp_log_result'] = array('message' => "Api_PostTimeStamp_result_error");
                    $this->Model_TimeStamp->Insert_Log_Time_Stamp_error($result);
                }
                

            // }else{

            //     $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "statuscheck_wifi_false" ,'msg' => "กรุณาบันทึกเวลาด้วย wifi ของการยาสูบแห่งประเทศไทย"));
            
            // }
            
        }else{
            $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "error",'msg' => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง" ));
        }

    
    }

}  

?>  