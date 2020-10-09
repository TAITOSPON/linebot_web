<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Login extends CI_Controller {  
      
    public function index()  
    {  
        $this->load->view('login_view');  
    }  
    
    public function login_process()  
    {  
        // $user = $this->input->post('user');  
        // $pass = $this->input->post('pass');  

        $this->load->view('welcome_message');
     
    }  

  
}  
?>  