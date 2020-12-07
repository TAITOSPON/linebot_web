<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Leave extends CI_Controller {  
    
    var $liff_id = "1655109480-VOMzYnqm";

    public function index(){    
        
        $data = array( 
            'site_url' => "Leave/Leave_create" ,
            'liff_id' =>  $this->liff_id
        );
        $this->load->view('login_check_view', $data); 

    }  
    




    public function Leave_create(){

        $result['user_line_uid']   = $this->input->post('user_line_uid');

        $this->load->model('Model_User');
        $result = $this->Model_User->Get_user_ad_with_line_uid($result);  
        // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();
        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
            
            $data = array( 
                'liff_id' =>  $this->liff_id,
                'result_user' => $result[0]
             );
            $this->load->view('Leave_create_view',$data); 

        }else{
            $data = array( 
                'liff_id' =>  $this->liff_id,
                'text_status' => ""
            );
            $this->load->view('login_success_view',$data);
        }
       
      
    }


    public function Leave_select_year(){
        // $this->load->view('welcome_message'); 
        

        $data['user_line_uid'] = $this->input->post('user_line_uid');

        $this->load->model('Model_User');
        $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
        

        if(sizeof($result) != 0){
            
            $user_ad_code = $result[0]["user_ad_code"]; 
            // $user_ad_code = "003259";
            // echo $user_ad_code; exit();

            $this->load->model('Model_Leave');
            $leave_year = $this->Model_Leave->get_leave_year($user_ad_code);

            $data = array(
                'liff_id' => "1655109480-VOMzYnqm",
                'text_status' => "login_true",
                "user_line_uid" => $data['user_line_uid'],
                'user_ad_code' => $user_ad_code,
                'leave_year' => $leave_year,
            );

            $this->load->view('Leave_select_year_view',$data); 

        }else{
            // retrun postnotlogin
            $data = array( 
                'liff_id' => "1655109480-VOMzYnqm",
                'text_status' => "login_false"
            );
            $this->load->view('login_success_view',$data);
        }
         

    }

    public function Leave_select_year_detail(){


        $data['Leave_select_year_detail'] = $this->input->post('Leave_select_year_detail');
        $data['leave_year_select'] = $this->input->post('leave_year_select');

        // echo  $data['Leave_select_year_detail']; exit();
    

        $data = array(
            // 'liff_id' => "1655109480-VOMzYnqm",
            // 'text_status' => "login_true",
            'leave_year_select' =>  $data['leave_year_select'],
            "Leave_select_year_detail" => $data['Leave_select_year_detail'] 
        );

        $this->load->view('Leave_select_year_detail_view',$data); 
        // $this->load->view('welcome_message'); 

    }

}
?>  