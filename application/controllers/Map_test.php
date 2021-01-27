<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class Map_test extends CI_Controller {  
      

    var $liff_id = "1655109480-MXKb06wG";

    public function __construct(){

        parent::__construct();
        // $this->load->model('Model_User');
    }

    public function index()  
    {       
        // $data = array( 
        //     'site_url' => "Map_test/TimeStamp" ,
        //     'liff_id' => $this->liff_id,
        // );
   
     
        // $this->load->view('login_check_view', $data); 
     


       
        $ip_address=file_get_contents('http://checkip.dyndns.com/');
        echo $ip_address ;
        echo "<br>";
        echo "<br>";
        echo $this->get_client_ip();
        echo "<br>";
        echo "<br>";
        echo  $this->isLocalIPAddress($this->get_client_ip());
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

 
    public function get_client_ip() {
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
            $ipaddress = "REMOTE_ADDR : ".getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;



        // if (!empty($_SERVER['HTTP_CLIENT_IP'])){

        //     $ip_address = $_SERVER['HTTP_CLIENT_IP'];

        // }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        //     $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];

        // }else {

        //   $ip_address = $_SERVER['REMOTE_ADDR'];
        // }
        // return $ip_address;
    }


    public function isLocalIPAddress($IPAddress){
        if($IPAddress == '127.0.0.1'){
            // return true;
            return "nononono";
        }else{
            return ( !filter_var($IPAddress, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) );

        } 
       
    }





    public function TimeStamp(){

        $user_line_uid['user_line_uid'] = $this->input->post('user_line_uid');
        
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
              
                $data = array(  
                    'result_user' => $result_user[0],
                    'liff_id' => $this->liff_id,
                    'ip' => $this->get_client_ip()
                );
                $this->load->view('map_test_view', $data);
           
           
           
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