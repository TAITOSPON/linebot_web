<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class Logout extends CI_Controller {  
      

    var $liff_id = "1655109480-GoLo5myJ"; 

    public function index()  
    {       

   
        $data = array( 
            'site_url' => "Logout/Confirm_logout" ,
            'liff_id' => $this->liff_id,
        );


        $this->load->view('login_check_view',$data);

    }  

    public function Confirm_logout(){

        $result['user_line_uid'] = $this->input->post('user_line_uid');

        $this->load->model('Model_User');
        $result = $this->Model_User->Get_user_login($result);  
        // $result = json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
        // echo $result; exit();

        if($result["status"] == true){
            if($result["result"] == "check_login_true"){
                $data = array( 
                    'site_url' => "Logout/Logout_procress" ,
                    'user_ad_code' => $result["data"][0]["user_ad_code"],
                    'liff_id' => $this->liff_id,
                );
                $this->load->view('Logout_view',$data);
              
            }else{
                $data = array( 'liff_id' => $this->liff_id, 'text_status' => "not_login" );
                $this->load->view('login_success_view',$data);
            }
    
        }else{
            $data = array( 'liff_id' => $this->liff_id, 'text_status' => "not_login" );
            $this->load->view('login_success_view',$data);
        }


       
    }

    public function Logout_procress(){

        $result['user_line_uid'] = $this->input->post('user_line_uid');
        $result['user_ad_code'] = $this->input->post('user_ad_code');
        $result['user_os'] = $this->input->post('os');

        $this->load->model('Model_User');
        $result_logout = $this->Model_User->Set_user_logout($result);  

        if($result_logout["status"] == true){
            if($result_logout["result"] == "logout_update_true"){

                $data = array( 'liff_id' => $this->liff_id, 'text_status' => "logout_update_true" );
                $this->load->view('login_success_view',$data);

                // $result['user_line_uid'] = $this->input->post('user_line_uid');
                // $result['user_ad_code'] = $this->input->post('user_ad_code');
                // $result['user_os'] = $this->input->post('os');
                $this->Insert_log_login($result);


            }else{
                $data = array( 'liff_id' => $this->liff_id, 'text_status' => "not_login" );
                $this->load->view('login_success_view',$data);
            }
    
        }else{
            $data = array( 'liff_id' => $this->liff_id, 'text_status' => "not_login" );
            $this->load->view('login_success_view',$data);
        }

    }

    public function Insert_log_login($result){

        $result['login_type'] = 'Logout';
        $this->load->model('Model_User');
        $this->Model_User->Insert_Log_Login($result);
    }

    
}  
?>  