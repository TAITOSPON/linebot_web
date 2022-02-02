<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class SystemWork extends CI_Controller {  
    
    var $liff_id_systemwork = "1655109480-k7MoQ9jP";

    public function __construct()
    {
		parent::__construct();

        $this->load->model('Model_User');
        // $this->load->model('Model_Member');
        // $this->load->model('Model_Leave');

    }

    public function index(){    
 
        $data = array( 
            'site_url' => "" ,
            'liff_id' => $this->liff_id_systemwork,
        );

        $this->load->view('SystemWork/systemwork_Login_line_view', $data); 

    }
    
    public function SystemWorkPage($page) {  

        $this->Login_Line($page,$this->liff_id_systemwork);

   }


    public function Login_Line($page,$liff_id){

        $data = array( 
            'site_url' => "SystemWork/".$page ,
            'liff_id' => $liff_id,
        );


        $this->load->view('SystemWork/systemwork_Login_line_view', $data); 
    }
  


    public function SystemWork_Sale_report(){

        $this->SystemWork_view("DetailProfile",$this->liff_id_systemwork);

    }

   
    public function SystemWork_view($page,$liff_id){   
       

        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
  
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
 
        // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
   
            // $result[0]["user_ad_code"]

            // $site_url = $this->Model_Member->Get_Member_TOAT($result[0]["user_ad_code"],$page);

            // $site_url = "https://change.toat.co.th/invMn/index.php/sale/LastMntCompare";
            $site_url = "https://healthlink.toat.co.th/saleDashboard";
            
            $data = array( 
                'site_url' => $site_url ,
            );

            $this->load->view('SystemWork/systemwork_iframe_view', $data); 
    
        }else{

    
            $data = array( 'liff_id' => $liff_id, 'text_status' => "System_work_not_login" );
            $this->load->view('login_success_view',$data);
       
          
        }
    }
    

}

?>  