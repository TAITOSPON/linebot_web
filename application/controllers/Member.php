<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Member extends CI_Controller {  
    
    var $liff_id = "1655109480-wLRoWZpg";
    
    public function __construct()
    {
		parent::__construct();
        $this->load->model('Model_view_main_member');
        $this->load->model('Model_User');

    }

    public function index()   {       
        $this->Login_Line("ProfileDetail");
    }
    

    public function Login_Line($page){

        $template = $this->Model_view_main_member->template_gen();

        $data = array( 
            'site_url' => "Member/".$page ,
            'liff_id' => $this->liff_id,
            'template'=> $template,
        );


        $this->load->view('Member_Login_line_view', $data); 
    }
  

    public function ProfileDetail(){

        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
    
       
        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

            $result = $this->Model_User->GetProfile($result[0]["user_ad_code"]);  
            // $result = $this->Model_User->GetProfile("002906");  
            // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ; exit();
            if($result["status"] == true){
             
                $template = $this->Model_view_main_member->template_gen();
                $data = array( 'liff_id' => $this->liff_id,'result' => $result["result"],'template'=>$template, );
                $this->load->view('Member_Profile_view', $data); 
    
            }else{
                $data = array( 'liff_id' => $this->liff_id, 'text_status' => "error_api" );
                $this->load->view('login_success_view',$data);
            }
    
        }else{
            $data = array( 
                'liff_id' => $this->liff_id,
                'text_status' => "ProfileDetail_not_login" 
            );
            $this->load->view('login_success_view',$data);
        }
    
       
    }



    public function Training(){

        $this->load->model('Model_User');
        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
    
       
        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

            $result = $this->Model_User->GetProfile($result[0]["user_ad_code"]);  
            // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ; exit();
            if($result["status"] == true){
                $this->load->model('Model_view_main_member');
                $template = $this->Model_view_main_member->template_gen();

                $data = array( 'liff_id' => $this->liff_id,'result' => $result["result"],'template'=>$template, );

                $this->load->view('Member_Training_view', $data); 
    
            }else{
                $data = array( 'liff_id' => $this->liff_id, 'text_status' => "error_api" );
                $this->load->view('login_success_view',$data);
            }
    
        }else{
            $data = array( 
                'liff_id' => $this->liff_id,
                'text_status' => "ProfileDetail_not_login" 
            );
            $this->load->view('login_success_view',$data);
        }
    
       
  
   
    }
     
    


    
}
?>  