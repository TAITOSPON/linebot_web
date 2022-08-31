<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class HelpCenter extends CI_Controller {  
      

    var $liff_id = "1655109480-jXW76xR8";

    public function __construct(){

        parent::__construct();
        $this->load->model('Model_User');
        $this->load->model('Model_HelpCenter');

        
    }

    public function index()  {   
           
        $data = array( 
            'site_url' => "HelpCenter/Help" ,
            'liff_id' => $this->liff_id,
        );

        
        $this->load->view('login_check_view',$data); 
        
   
    }  

    public function Help(){

        // $result['intent']  = $this->input->post('intent');
        $result['user_line_uid']  = $this->input->post('user_line_uid');

   
        // if($result['intent'] == "info"){

        //     $data = array( 
        //         'site_url' => 'https://docs.google.com/viewer?url=https://webhook.toat.co.th/linebot/web/src/%E0%B8%84%E0%B8%B9%E0%B9%88%E0%B8%A1%E0%B8%B7%E0%B8%AD_LINE_FULL.pdf&embedded=true' ,
        //     );

        //     $this->load->view('HelpCenter/HelpCenter_iframe_view', $data); 
           
   

        // }else if ($result['intent'] == "sendfeedback"){

        //     $result_user = $this->Model_User->Get_user_ad_with_line_uid($result);  
            
        //     $data = array( 
        //         'site_url' => "HelpCenter/SendFeedBack" ,
        //         'liff_id' => $this->liff_id,
        //         'result_user' => $result_user[0]
              
        //     );
        //     $this->load->view('HelpCenter/Feedback_view', $data); 

        // }

        $result_user = $this->Model_User->Get_user_ad_with_line_uid($result);  
            
        $data = array( 
            'site_url' => "HelpCenter/SendFeedBack" ,
            'liff_id' => $this->liff_id,
            'result_user' => $result_user[0]
          
        );
        $this->load->view('HelpCenter/Feedback_view', $data); 

    }

    public function SendFeedBack(){

        $result['user_line_uid'] = $this->input->post('user_line_uid');
        $result['user_ad_code']  = $this->input->post('user_ad_code');
        $result['os'] = $this->input->post('os');
        $result['subject']  = $this->input->post('subject');



        $SendFeedback = $this->Model_HelpCenter->SendFeedback($result);  
        if($SendFeedback == "true"){

            // $data = array( 
            //     'liff_id' => $this->liff_id,
            //     'text_status' => ""
            // );
    
            // $this->load->view('login_success_view',$data);

            $this->load->view('HelpCenter/Feedback_success_view', array(  'liff_id' => $this->liff_id ,'msg' => "ขอบคุณสำหรับความคิดเห็นและข้อเสนอแนะของคุณ <br>เพื่อยกระดับการใช้งานให้ดีขึ้นเราจะดำเนินการ<br>พัฒนาต่อไป <br><br><br>สำนักเทคโนโลยีสารสนเทศ"));
        }
    
       
        
    }


    public function FeedbackDetail(){
        $this->load->view('HelpCenter/Feedback_detail_view'); 
    }

}  

?>  