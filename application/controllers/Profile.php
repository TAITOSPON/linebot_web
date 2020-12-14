<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Profile extends CI_Controller {  
    
    var $liff_id = "1655109480-wLRoWZpg";

    public function index()  
    {       

   
        $data = array( 
            'site_url' => "Profile/ProfileDetail" ,
            'liff_id' => $this->liff_id,
        );


        $this->load->view('login_check_view', $data); 

     
    }  

    public function ProfileDetail(){

        $this->load->model('Model_User');
        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
    

        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

            $result = $this->Model_User->GetProfile($result[0]["user_ad_code"]);  
            if($result["status"] == true){
    
                $data = array( 'liff_id' => $this->liff_id,'result' => $result, );
                $this->load->view('Profile_view', $data); 
    
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