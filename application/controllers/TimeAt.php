<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class TimeAt extends CI_Controller {  
    
    var $liff_id = "1655109480-jrRy7m25";

    public function index()  
    {       

   
        $data = array( 
            'site_url' => "TimeAt/time_at_select_month" ,
            'liff_id' => $this->liff_id,
        );


        $this->load->view('login_check_view', $data); 

     
    }  
     
    public function time_at_select_month(){

        $user_line_uid['user_line_uid']   = $this->input->post('user_line_uid');

        $this->load->model('Model_User');
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
        // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
   
                $this->load->model('Model_TimeAt');
                $result_detail_time_feed = $this->Model_TimeAt->get_detail_time_feed($result_user[0]["user_ad_code"],date("01-m-Y"),date("d-m-Y"));  
                // echo($result_detail_time_feed); exit();

                $data = array(  'liff_id' => $this->liff_id,'result_user' => $result_user[0],'result_detail_time_feed' => $result_detail_time_feed );
                $this->load->view('TimeAt_select_month',$data); 
               
    
            }else{
                $data = array( 'liff_id' =>  $this->liff_id );
                $this->load->view('login_success_view',$data);
            }
           
        }else{
            $data = array(  'liff_id' =>  $this->liff_id );
            $this->load->view('login_success_view',$data);
        }




    }


    
}
?>  