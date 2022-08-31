<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Kmim extends CI_Controller {  
    
    var $liff_id_kmim = "1655109480-Ka61NvXx";

    public function __construct()
    {
		parent::__construct();

        // $this->load->model('Model_User');
        // $this->load->model('Model_Infoma');
     

    }

    public function index(){    
        // echo "hi";
        $data = array( 
            // 'site_url' => "" ,
            // 'liff_id' => $this->liff_id_kmim,
        );
        $this->load->view('Kmim/Kmim_iframe_view', $data); 

    }

//     public function InfomaPage($page) {  

//         $this->Login_Line($page,$this->liff_id_infoma);

//    }


//    public function Login_Line($page,$liff_id){

//        $data = array( 
//            'site_url' => "Infoma/".$page ,
//            'liff_id' => $liff_id,

//        );

//        $this->load->view('Infoma/Infoma_login_line_view', $data); 
//    }

    
//     public function Infoma_Main(){

//         $this->Infoma_view("",$this->liff_id_infoma);

//     }



//     public function Infoma_view($page,$liff_id){   


     
//         $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
  
//         $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
 
//         // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

//         if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){

  
//             $site_url = $this->Model_Infoma->Get_Infoma_TOAT($result[0]["user_ad_code"],$page);
//             // echo   $site_url; exit();

//             $data = array( 
//                 'site_url' => $site_url ,
//             );

//             $this->load->view('Infoma/Infoma_Iframe_view',$data); 
    
//         }else{

//             $data = array( 'liff_id' => $liff_id, 'text_status' => "Infomal_not_login" );
//             $this->load->view('login_success_view',$data);
        
          
//         }
//     }
    

}