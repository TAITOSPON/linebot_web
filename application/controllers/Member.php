<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Member extends CI_Controller {  
    
    var $liff_id_member_profile = "1655109480-wLRoWZpg";
    var $liff_id_member_leave = "1655109480-lKekYNJK";
    
    public function __construct()
    {
		parent::__construct();

        $this->load->model('Model_User');
        $this->load->model('Model_Member');
        $this->load->model('Model_Leave');

    }

    public function Profile()   {       
        $this->Login_Line("Member_TOAT_Profile",$this->liff_id_member_profile);
  
    }

    public function Leave()   {       
        $this->Login_Line("Member_TOAT_Leave",$this->liff_id_member_leave);
  
    }


    public function Login_Line($page,$liff_id){

        $template = $this->Model_Member->template_gen();

        $data = array( 
            'site_url' => "Member/".$page ,
            'liff_id' => $liff_id,
            'template'=> $template,
        );


        $this->load->view('Member/Member_Login_line_view', $data); 
    }
  

   

    public function Member_TOAT_Profile(){

        $this->Member_view("DetailProfile",$this->liff_id_member_profile);

    }

    public function Member_TOAT_Leave(){

        $this->Member_view("LeaveYear",$this->liff_id_member_leave);

    }


    public function Member_view($page,$liff_id){   
       

        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
  
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
 
        // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
   
            $site_url = $this->Model_Member->Get_Member_TOAT($result[0]["user_ad_code"],$page);

            $data = array( 
                'site_url' => $site_url ,
            );

            $this->load->view('Member/Member_Iframe_view',$data); 
    
        }else{

            if($liff_id == $this->liff_id_member_profile){
                $data = array( 'liff_id' => $liff_id, 'text_status' => "ProfileDetail_not_login" );
                $this->load->view('login_success_view',$data);
            }else{
                $data = array( 'liff_id' => $liff_id, 'text_status' => "Leave_Detail_not_login" );
                $this->load->view('login_success_view',$data);
            }
          
        }
    }



    // public function Member_Create_leave(){


    //  // https://memberapp.toat.co.th/memberttm_test/saveleaveyear

    //     $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');

    //     $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

    //     if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
   
    //         // $site_url = $this->Model_Member->Get_Member_TOAT($result[0]["user_ad_code"]);
    //         $site_url = 'https://memberapp.toat.co.th/memberttm_test/saveleaveyear';

    //         $data = array( 
    //             'site_url' => $site_url ,
    //         );

    //         $this->load->view('Member/Member_Iframe_view',$data); 
    
    //     }else{
    //         $data = array( 'liff_id' => $this->liff_id, 'text_status' => "error_api" );
    //         $this->load->view('login_success_view',$data);
    //     }


    // }

   
    // public function ProfileDetail(){

    //     $template = $this->Model_Member->template_gen();
    //     $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
    //     $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
    
       
    //     if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

    //         $result = $this->Model_Member->GetProfile($result[0]["user_ad_code"]);  
    //         // $result = $this->Model_Member->GetProfile("002906");  
    //         // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ; exit();
    //         if($result["status"] == true){
    //             $data = array( 'liff_id' => $this->liff_id,'result' => $result["result"],'template'=>$template, );
    //             $this->load->view('Member/Member_Profile_view', $data); 
    
    //         }else{
    //             $data = array( 'liff_id' => $this->liff_id, 'text_status' => "error_api" );
    //             $this->load->view('login_success_view',$data);
    //         }
    
    //     }else{
    //         $data = array( 
    //             'liff_id' => $this->liff_id,
    //             'text_status' => "ProfileDetail_not_login" 
    //         );
    //         $this->load->view('login_success_view',$data);
    //     }
    
       
    // }



    // public function Training(){
      
    //     $template = $this->Model_Member->template_gen();

    //     $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
    //     $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
    
      
    //     $result_year = $this->Model_Leave->get_leave_year($result[0]["user_ad_code"]);
    //     // echo json_encode($result_year,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ; exit();
       
    //     if(json_encode($result_year,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

    //         $data = array( 
    //             'liff_id' => $this->liff_id,
    //             'user_ad_code' => $result[0]["user_ad_code"],
    //             'result_year'=>$result_year,
    //             'template'=>$template, );

    //         $this->load->view('Member/Member_Training_view', $data); 
    
         
    //     }else{
    //         $data = array( 
    //             'liff_id' => $this->liff_id,
    //             'text_status' => "ProfileDetail_not_login" 
    //         );
    //         $this->load->view('login_success_view',$data);
    //     }
    
    // }
     
    
   
    


    
}
?>  