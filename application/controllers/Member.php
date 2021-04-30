<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Member extends CI_Controller {  
    
    var $liff_id_member = "1655109480-j7nN8VqP";

    public function __construct()
    {
		parent::__construct();

        $this->load->model('Model_User');
        $this->load->model('Model_Member');
        $this->load->model('Model_Leave');

    }

    public function index(){    
 
        $data = array( 
            'site_url' => "" ,
            'template'=> $this->Model_Member->template_gen(),
            'liff_id' => $this->liff_id_member,
        );

        $this->load->view('Member/Member_Login_line_view', $data); 

    }
    
    public function MemberPage($page) {  

         $this->Login_Line($page,$this->liff_id_member);

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

        $this->Member_view("DetailProfile",$this->liff_id_member);

    }

    public function Member_TOAT_Leave(){

        $this->Member_view("LeaveYear",$this->liff_id_member);

    }

    public function Member_TOAT_Financial(){

        $this->Member_view("Financial",$this->liff_id_member);

    }
    
    public function Member_TOAT_Cooperativesaving(){

        $this->Member_view("Cooperativesaving",$this->liff_id_member);

    }

     
    public function Member_TOAT_SearchTelephoneNumber(){

        $this->Member_view("SearchTelephoneNumber",$this->liff_id_member);

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

    
            $data = array( 'liff_id' => $liff_id, 'text_status' => "ProfileDetail_not_login" );
            $this->load->view('login_success_view',$data);
       
          
        }
    }
    

}

?>  