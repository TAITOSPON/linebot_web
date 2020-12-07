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

         
        $data = array(  'liff_id' => $this->liff_id  );
        $this->load->view('TimeAt_select_month',$data); 
    }


    
}
?>  