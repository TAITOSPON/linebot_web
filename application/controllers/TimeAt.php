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

        $user_line_uid['user_line_uid'] = $this->input->post('user_line_uid');
        
        // $a_date = "2020-11-2";
        // echo date("Y-m-t", strtotime($a_date)); exit();
 
        $this->load->model('Model_User');
        $result_user = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
        // echo json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

        if($result_user != null){
            if(json_encode($result_user,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
   
                $this->load->model('Model_TimeAt');

                $month_select = $this->input->post('month_select');
                if($month_select != null){
                    $month_select = (explode('-', $month_select));    

                    $month_start = date("01-".$month_select[1]."-".$month_select[0]);
                    $month_end = date("Y-m-t", strtotime($month_start)); 
                    $month_end = (explode('-', $month_end));    
                    $month_end = date($month_end[2]."-".$month_end[1]."-".$month_end[0]);
                    
                    $result_detail_time_feed = $this->Model_TimeAt->get_detail_time_feed($result_user[0]["user_ad_code"],date($month_start),date($month_end));  
                }else{
                    $month_end = date("Y-m-t", strtotime(date("01-m-Y"))); 
                    $month_end = (explode('-', $month_end));    
                    $month_end = date($month_end[2]."-".$month_end[1]."-".$month_end[0]);
                    $result_detail_time_feed = $this->Model_TimeAt->get_detail_time_feed($result_user[0]["user_ad_code"],date("01-m-Y"),date($month_end));  
                }
        
                // echo($result_detail_time_feed); exit();

                $json = json_decode($result_detail_time_feed,true);
              
                if(isset($json["msg"])){

                    $data = array(  'liff_id' => $this->liff_id,'result_user' => $result_user[0],'result_detail_time_feed' => $json["msg"] );
    
                    $this->load->view('TimeAt_select_month',$data); 

                }else{
                    
                    $this->load->view('Time_stamp_error_view', array(  'liff_id' => $this->liff_id,'text_status' => "error",'msg' => "เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง" ));
                }
             
               
    
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