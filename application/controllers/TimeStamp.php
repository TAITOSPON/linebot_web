<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class TimeStamp extends CI_Controller {  
      

    var $liff_id = "1655109480-MXKb06wG";

    public function __construct(){

        parent::__construct();
        $this->load->model('Model_User');
        $this->load->model('Model_TimeStamp');
        $this->load->model('Model_TimeAt');
        
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
            $ipaddress = "HTTP_CLIENT_IP : ".getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = "HTTP_X_FORWARDED_FOR : ".getenv('HTTP_X_FORWARDED_FOR');

        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = "HTTP_X_FORWARDED : ".getenv('HTTP_X_FORWARDED');

        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = "HTTP_FORWARDED_FOR : ".getenv('HTTP_FORWARDED_FOR');

        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = "HTTP_FORWARDED : ".getenv('HTTP_FORWARDED');

        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;

    }


    public function CheckisLocalIPAddress($IPAddress,$user_ad_code){
    
        $status_wfh = "false";
        $feed_time = "";

        $result_CheckUserWFH =  array(json_decode($this->Model_TimeStamp->CheckUserWFH($user_ad_code), true));

        $result_get_time_feed = array(json_decode($this->Model_TimeStamp->Get_TimeAt_feed_with_ad($user_ad_code), true)); 

 
        if(json_encode($result_get_time_feed,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
     
            $result_time_at = $result_get_time_feed[0]['result']['result_time_at'];
            if(sizeof($result_time_at) != 0){
                // print_r  ( $result_time_at[0]);

                if(date("H:i:s") < date("12:i:s")){
                    $feed_time = "บันทึกเวลาล่าสุดเมื่อ : ".$result_time_at[0]["in_CHK"]." ด้วย : ".$result_time_at[0]["in_channel"]."<br> สถานที่ : ".$result_time_at[0]["in_location_name"];
                }else{
                    // $index = sizeof($result_time_at)-1;
                    // if($result_time_at[$index ]["out_CHK"] != ""){
                    //     $feed_time = "บันทึกเวลาล่าสุดเมื่อ : ".$result_time_at[$index]["out_CHK"]." ด้วย : ".$result_time_at[$index]["out_channel"]."<br> สถานที่ : ".$result_time_at[$index]["out_location_name"];
                    // }
                    if($result_time_at[0]["out_CHK"] != ""){
                        $feed_time = "บันทึกเวลาล่าสุดเมื่อ : ".$result_time_at[0]["out_CHK"]." ด้วย : ".$result_time_at[0]["out_channel"]."<br> สถานที่ : ".$result_time_at[0]["out_location_name"];
                    }
                }
     
            }
        }

        if(sizeof($result_CheckUserWFH) != 0){

            if(is_array($result_CheckUserWFH[0]['msg'])){
                if(sizeof($result_CheckUserWFH[0]['msg']) != 0){
                    $WFH_ID = $result_CheckUserWFH[0]['msg'][0]['WFH_ID'];
                    if($WFH_ID =="1"){
                        $status_wfh ="true";
                    }
                }
            
            }

        }
    

        if($status_wfh == "false"){
            //172.16 // KT 0
            //172.31 // rot 1
            //172.18. // wan 2
        
            // "LINE_KT" , LINE_ROJANA , LINE_WAN , LINE_WFH

            $wifi_toat =  array("172.16." , "172.31." , "172.18.");

            $ip = substr((string)$IPAddress, 0, 7);

            $statuscheck_wifi = "false";
            $staus_location = "";
            $location = "";

            for($index=0; $index< sizeof($wifi_toat); $index++){
                if($ip == $wifi_toat[$index]){
                    $statuscheck_wifi = "true";
                    $staus_location = (string)$index;
                }
            }

            if($staus_location == 0){

                $location = "LINE_KT";

            }else if($staus_location == 1){

                $location = "LINE_ROJANA";

            }else if($staus_location == 2){

                $location = "LINE_WAN";

            }
            
        }else{
            $statuscheck_wifi = "true";
            $location = "LINE_WFH";
        }
        

        $StatusCheck = array(
            'statuscheck_wifi' => $statuscheck_wifi,
            'feed_time' => $feed_time,
            'category' => $location
        );

        return $StatusCheck;
    
        //     return ( !filter_var($IPAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) );
       
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
                    'status_time_stamp' => array('ip'=> $this->GetClientIP() , 'status' => $this->CheckisLocalIPAddress($this->GetClientIP(),$result_user[0]['user_ad_code']))
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


        $status_time_stamp = $this->CheckisLocalIPAddress($this->GetClientIP(),$result['user_ad_code']);

        if($status_time_stamp['statuscheck_wifi'] == "true"){
           
            $PostTimeStamp_result =  array(json_decode($this->Model_TimeStamp->PostTimeStamp($result), true)); 
            $result['time_stamp_log_result'] = $PostTimeStamp_result;
     
            if( $PostTimeStamp_result[0]["status_old"] == 200 &&  $PostTimeStamp_result[0]["status_new"] == 200){
    
               $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "time_stamp_true" ,'msg' => "บันทึกเวลาสำเร็จ"));
    
            }else{
                $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "error",'msg' => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง" ));
            }


            $this->Model_TimeStamp->Insert_Log_Time_Stamp($result);
           

        }else{

            $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "statuscheck_wifi_false" ,'msg' => "กรุณาบันทึกเวลาด้วย wifi ของการยาสูบแห่งประเทศไทย"));
        
        }

    
    }

}  

?>  