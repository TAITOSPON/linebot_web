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
            "172.18." ,
    

            
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
            "1.1.253.10",
            "1.1.253.2",
            "58.137.91.30",
            "1.179.205.254",

            "1.4.158.35", // LUMPANG

            "182.52.136.22",        // LINE_CMG01        index 11  สำนักงานยาสูบเชียงใหม่
            "1.4.158.27",           // LINE_CMG02        index 12  สถานีใบยาสันมหาพน
            "1.4.158.28",           // LINE_CMG03        index 13  สถานีใบยาปากทาง
            "1.4.158.29",           // LINE_CMG04        index 14  สถานีใบยาห้วยไซ
            "1.4.158.26",           // LINE_CMG05        index 15  สถานีใบยาแม่เลน
            "182.52.136.29",        // LINE_CMG06        index 16  โกดังเก็บใบยาแม่โจ้
            "182.53.230.192",       // LINE_CMG07        index 17  สถานีทดลองยาสูบแม่โจ้
            "182.52.136.23",        // LINE_CHL01        index 18  สำนักงานยาสูบเชียงราย
            "1.4.158.32",           // LINE_CHL02        index 19  สถานีใบยาป่าก่อดำ
            "1.4.158.33",           // LINE_CHL03        index 20  สถานีใบยาป่าสักขวาง
            "1.4.158.34",           // LINE_CHL04        index 21  สถานีใบยาเวียงพาน
            "182.52.136.28",        // LINE_PHR01        index 22  สำนังานยาสูบแพร่
            "1.4.158.30",           // LINE_PHR02        index 23  สถานีใบยาทุ่งน้าว
            "1.4.158.31",           // LINE_PHR03        index 24  สถานีใบยาร้องกวาง
            "182.52.136.34",        // LINE_PHR04        index 25  โรงอบใบยาเด่นชัยupdateCID
            "101.109.112.234",      // LINE_PET01        index 26  สำนักงานยาสูบเพชรบูรณ์
            "1.20.199.151",         // LINE_PET02        index 27  สถานีใบยานางั่ว
            "1.20.199.150",         // LINE_PET03        index 28  สถานีใบยาท่าพล
            "125.25.201.16",        // LINE_SUK01        index 29  สำนักงานยาสูบสุโขทัย
            "1.20.199.148",         // LINE_SUK02        index 30  สถานีใบยาศรีสำโรง
            "1.20.199.149",         // LINE_SUK03        index 31  สถานีใบยาหนองยาว
            "182.52.57.29",         // LINE_BAP01        index 32  สำนักงานยาสูบบ้านไผ่
            "1.0.138.132",          // LINE_BAP02        index 33  สถานีใบยาหนองโก
            "1.0.138.174",          // LINE_BAP03        index 34  สถานีใบยาไทรงาม1
            "1.0.138.175",          // LINE_BAP04        index 35  สถานีใบยาไทรงาม2
            "182.52.57.34",         // LINE_BAP05        index 36  โรงทำความสะอาดใบยาเตอร์กิชชนบท
            "182.52.57.35",         // LINE_NOK01        index 37  สำนักงานยาสูบหนองคาย
            "1.0.138.159",          // LINE_NOK02        index 38  สถานีใบยาศรีเชียงใหม่
            "1.0.138.158",          // LINE_NOK03        index 39  สถานีใบยาโพนสา
            "1.0.138.151",          // LINE_NOK04        index 40  สถานีใบยาปากสวย
            "182.52.57.37",         // LINE_NAP01        index 41  สำนักงานยาสูบนครพนม
            "1.0.138.135",          // LINE_NAP02        index 42  สถานีใบยาบ้านแพง
            "1.0.138.157",          // LINE_NAP03        index 43  สถานีใบยาท่าสีไค
            "1.0.138.143",          // LINE_NAP05        index 44  สถานีใบยานาทาม
            "1.0.138.144",          // LINE_NAP06        index 45  สถานีใบยาดอนนางหงส์
            "1.0.138.137",          // LINE_NAP07        index 46  สถานีใบยาไชยบุรี
            "1.4.158.35",           // LINE_NTM_LAMPANG  index 47  ศูนย์บริหารการขายพื้นที่ภาคเหนือ(ลำปาง)


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

            $category = "LINE_KT";

        }else if($staus_location == "7"){

            $category = "LINE_KT";

        }else if($staus_location == "8"){

            $category = "LINE_KT";

        }else if($staus_location == "9"){

            $category = "LINE_KT";
        }
        else if($staus_location == "10"){

            $category = "LINE_NTM_LAMPANG";
        }


        else if($staus_location == "11"){

            $category = "LINE_CMG01";
        }
        else if($staus_location == "12"){

            $category = "LINE_CMG02";
        }
        else if($staus_location == "13"){

            $category = "LINE_CMG03";
        }
        else if($staus_location == "14"){

            $category = "LINE_CMG04";
        }
        else if($staus_location == "15"){

            $category = "LINE_CMG05";
        }
        else if($staus_location == "16"){

            $category = "LINE_CMG06";
        }
        else if($staus_location == "17"){

            $category = "LINE_CMG07";
        }
        else if($staus_location == "18"){

            $category = "LINE_CHL01";
        }
        else if($staus_location == "19"){

            $category = "LINE_CHL02";
        }
        else if($staus_location == "20"){

            $category = "LINE_CHL03";
        }
        else if($staus_location == "21"){

            $category = "LINE_CHL04";
        }
        else if($staus_location == "22"){

            $category = "LINE_PHR01";
        }
        else if($staus_location == "23"){

            $category = "LINE_PHR02";
        }
        else if($staus_location == "24"){

            $category = "LINE_PHR03";
        }
        else if($staus_location == "25"){

            $category = "LINE_PHR04";
        }
        else if($staus_location == "26"){

            $category = "LINE_PET01";
        }
        else if($staus_location == "27"){

            $category = "LINE_PET02";
        }
        else if($staus_location == "28"){

            $category = "LINE_PET03";
        }
        else if($staus_location == "29"){

            $category = "LINE_SUK01";
        }
        else if($staus_location == "30"){

            $category = "LINE_SUK02";
        }
        else if($staus_location == "31"){

            $category = "LINE_SUK03";
        }
        else if($staus_location == "32"){

            $category = "LINE_BAP01";
        }
        else if($staus_location == "33"){

            $category = "LINE_BAP02";
        }
        else if($staus_location == "34"){

            $category = "LINE_BAP03";
        }
        else if($staus_location == "35"){

            $category = "LINE_BAP04";
        }
        else if($staus_location == "36"){

            $category = "LINE_BAP05";
        }
        else if($staus_location == "37"){

            $category = "LINE_NOK01";
        }
        else if($staus_location == "38"){

            $category = "LINE_NOK02";
        }
        else if($staus_location == "39"){

            $category = "LINE_NOK03";
        }
        else if($staus_location == "40"){

            $category = "LINE_NOK04";
        }
        else if($staus_location == "41"){

            $category = "LINE_NAP01";
        }
        else if($staus_location == "42"){

            $category = "LINE_NAP02";
        }
        else if($staus_location == "43"){

            $category = "LINE_NAP03";
        }
        else if($staus_location == "44"){

            $category = "LINE_NAP05";
        }
        else if($staus_location == "45"){

            $category = "LINE_NAP06";
        }
        else if($staus_location == "46"){

            $category = "LINE_NAP07";
        }
        else if($staus_location == "47"){

            $category = "LINE_NTM_LAMPANG";
        }

        
        

        

        return $category;

    }



 
    public function TimeStamp(){

        $user_line_uid['user_line_uid'] = $this->input->post('user_line_uid');
        
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
              
           

                if($user_line_uid['user_line_uid'] == "U4f34652f4e163d5492b3fbe573a50d0a"){ // nueng  only  for service dev
           

                    $data = array(  
                        'site_url' => "TimeStamp/PostTimestamp",
                        'result_user' => $result_user[0],
                        'liff_id' => $this->liff_id,
                        'status_time_stamp' => array(
                                                    'ip'=> $this->GetClientIP() , 
                                                    'status' => $this->CheckisLocalIPAddress($this->GetClientIP() , $result_user[0]['user_ad_code'] , "")
                                                    )
                    );
                    $this->load->view('Time_stamp_view_dev', $data);

                }else{ // all user
                    
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
                }

           
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

                $status_time_stamp['category'] =  $result['category'];
                $result['time_stamp_log_status_wifi'] = $status_time_stamp;
        
                $PostTimeStamp_result =  array(json_decode($this->Model_TimeStamp->PostTimeStamp($result), true)); 
            

                if(sizeof($PostTimeStamp_result) != 0){


                    if( $PostTimeStamp_result[0]["status_old"] == 200 &&  $PostTimeStamp_result[0]["status_new"] == 200){
            
                        $this->load->view('Time_stamp_error_view', array(  
                            'liff_id'       => $this->liff_id,
                            'text_status'   => "time_stamp_true" ,
                            'msg'           => "บันทึกเวลาสำเร็จ" ,
                            'user_ad_code'  => $result['user_ad_code'],
                            'user_line_uid' => $result['user_line_uid'],
                        ));
                    
                    }else{
                      
                        $this->load->view('Time_stamp_error_view', array(  
                            'liff_id'       => $this->liff_id,
                            'text_status'   => "error",
                            'msg'           => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง",
                            'user_ad_code'  => $result['user_ad_code'],
                            'user_line_uid' => $result['user_line_uid'],
                        ));

                        $result['time_stamp_log_result'] = $PostTimeStamp_result;
                        $this->Model_TimeStamp->Insert_Log_Time_Stamp_error($result);
                    }
                
            
                    $result['time_stamp_log_result'] = $PostTimeStamp_result;
                    $this->Model_TimeStamp->Insert_Log_Time_Stamp($result);

                }else{

              
                    $this->load->view('Time_stamp_error_view', array(  
                        'liff_id'       => $this->liff_id,
                        'text_status'   => "error",
                        'msg'           => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง",
                        'user_ad_code'  => $result['user_ad_code'],
                        'user_line_uid' => $result['user_line_uid'],
                    ));

                    $result['time_stamp_log_result'] = array('message' => "Api_PostTimeStamp_result_error");
                    $this->Model_TimeStamp->Insert_Log_Time_Stamp_error($result);
                }
                

            // }else{

            //     $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "statuscheck_wifi_false" ,'msg' => "กรุณาบันทึกเวลาด้วย wifi ของการยาสูบแห่งประเทศไทย"));
            
            // }
            
        }else{
            $this->load->view('Time_stamp_error_view', array(  
                'liff_id'       => $this->liff_id,
                'text_status'   => "error",
                'msg'           => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง",
                'user_ad_code'  => "",
                'user_line_uid' => "",
            ));
        }

    
    }

    

    public function PostTimestamp_test(){
       
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

                $status_time_stamp['category'] =  $result['category'];
                $result['time_stamp_log_status_wifi'] = $status_time_stamp;

                echo ("<pre>".print_r($status_time_stamp,true)."</pre>");
                echo ("<pre>".print_r($result,true)."</pre>");

            
        }else{
            $this->load->view('Time_stamp_error_view', array(  
                'liff_id'       => $this->liff_id,
                'text_status'   => "error",
                'msg'           => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง",
                'user_ad_code'  => "",
                'user_line_uid' => "",
            ));
        }

    
    }
   
}  

?>  