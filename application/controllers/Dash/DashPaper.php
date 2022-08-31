<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class DashPaper extends CI_Controller {  
      



    public function __construct(){

        parent::__construct();

        // $this->load->model('Model_Member');
        // $this->load->model('Model_Dash');
    }

    public function DashPaperMain(){
    
        $data = array();
    
        $this->load->view('Dash/dash_paper_main_view',$data);

    }

   
   

}
