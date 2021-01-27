<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class TimeStamp extends CI_Controller {  
      

    var $liff_id = "1655109480-MXKb06wG";

    public function __construct(){

        parent::__construct();
        $this->load->model('Model_User');
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


    public function CheckisLocalIPAddress($IPAddress){

        $wifi_toat =  "172.16.";

        $ip = substr((string)$IPAddress, 0, 7);

        if($ip == $wifi_toat){
            return "true";
        }else{
            return "false";
        }
           
        
        //     return ( !filter_var($IPAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) );


       
    }





    public function TimeStamp(){

        $user_line_uid['user_line_uid'] = $this->input->post('user_line_uid');
        
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
              
                $data = array(  
                    'result_user' => $result_user[0],
                    'liff_id' => $this->liff_id,
                    'status_time_stamp' => array('ip'=> $this->GetClientIP() , 'status' => $this->CheckisLocalIPAddress($this->GetClientIP()))
                );
                $this->load->view('time_stamp_view', $data);
           
           
           
            }else{
                $data = array( 'liff_id' =>  $this->liff_id, 'text_status' => "" );
                $this->load->view('login_success_view',$data);
            }
           
        }else{
            $data = array(  'liff_id' =>  $this->liff_id,'text_status' => "" );
            $this->load->view('login_success_view',$data);
        }
    }

}  

?>  