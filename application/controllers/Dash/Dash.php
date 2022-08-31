<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class Dash extends CI_Controller {  
      



    public function __construct(){

        parent::__construct();

        $this->load->model('Model_Member');
        $this->load->model('Model_Dash');
    }

    public function BETA(){
    
        $data = array();
    
        $this->load->view('Dash/dash_user_sale_view',$data);

    }

    public function GetUser(){

        $data = json_decode(file_get_contents('php://input'), true);
        $user_ad_code = $data["user_ad_code"];

        $retrun = $this->Model_Dash->GetUserSaleLog($user_ad_code);  

            for($i = 0; $i < sizeof($retrun); $i++){
                    $time_stamp_log_result = json_decode($retrun[$i]['time_stamp_log_result'],true);
                    $retrun[$i]['time_stamp_log_result'] = $time_stamp_log_result[0]['status_new'];

                    $time_stamp_log_status_wifi = json_decode($retrun[$i]['time_stamp_log_status_wifi'],true);
                    $retrun[$i]['time_stamp_log_status_wifi'] = $time_stamp_log_status_wifi['category'];
                
                    $detal_profile = $this->Model_Member->GetProfile($user_ad_code);  
                    $detal_profile = json_encode($detal_profile,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                    $detal_profile = json_decode($detal_profile,true);
                    

                    $retrun[$i]['PersonalName']     = $detal_profile['result']['personal']['PersonalName'];
                    $retrun[$i]['Department']       = $detal_profile['result']['personal']['Department'];
                    $retrun[$i]['time_stamp_log_lat_lon']  = $retrun[$i]['time_stamp_log_lat_lon'];
                    $retrun[$i]['time_stamp_log_lat_lon_url']  = "https://maps.google.com/?q=".$retrun[$i]['time_stamp_log_lat_lon'];
    
            }

            $this->load->view('Dash/dash_user_table_view',array( 'data' => $retrun));
  
       
    }

    
    public function Test(){
      
     
        // $user_ad_code = array(
            
        //     "500964",
        //     "003340",
        //     "003382",
        //     "203700",
        // );

        // $name = array(
        //     "นายพุทโธ คำประเสริฐ (พนักงานรายเดือน)",
        //     "นายสุทธิชัย ปันวงค์ (พนักงานรายเดือน)",
        //     "นายพงษ์สิริ ตาวุ่น (พนักงานรายเดือน)",
        //     "นางนิตยา อินฟู (พนักงานรายเดือน)",
        
        // );
        // $detail = array ();
        // for($i = 0; $i < sizeof($user_ad_code); $i++){
        //     $detail[$i]['user_ad_code'] =   $user_ad_code[$i];
        //     $detail[$i]['name']         =   $name[$i];
        // }



        //  echo json_encode($detail,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

   

}
