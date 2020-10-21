<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Login extends CI_Controller {  
      
    public function index()  
    {  
        $this->load->view('login_view');  
    }  
    
    public function login_process()  
    {  
        $user_ad = $this->input->post('user');  
        $user_ad_pass = $this->input->post('pass');  
        $user_line_uid = $this->input->post('user_line_uid');
        $user_line_name = $this->input->post('user_line_name');
        $user_line_pic_url = $this->input->post('user_line_pic_url');

        // echo $user_ad." ".$user_ad_pass." ".$user_line_uid." ".$user_line_name; exit();

        $this->GetLogin_AD($user_ad,$user_ad_pass,$user_line_uid, $user_line_name,$user_line_pic_url);
     

    }  


    public function GetLogin_AD($user_ad,$user_ad_pass,$user_line_uid,$user_line_name,$user_line_pic_url){
        // [{"PERSON_CODE":"003599","PERSON_NAME":"ทศพล โพชะเรือง","PERSON_DEPT_CODE":"19010300","PERSON_DEPT_NAME":"สำนักเทคโนโลยีสารสนเทศ ก.พัฒนาระบบสารสนเทศ"}]
        $file = "http://172.20.55.9/ADAuthenAPI/api/ADUser?pnc=".$user_ad."&pnp=".$user_ad_pass;
        $data = file_get_contents($file);
        $data = mb_substr($data, strpos($data, '{'));
        $data = mb_substr($data, 0, -1);
        $result = json_decode($data, true);

        $result['user_line_uid'] = $user_line_uid;
        $result['user_line_name'] = $user_line_name;
        $result['user_line_pic_url'] = $user_line_pic_url;
        
        // echo $result['user_line_uid'], $result['user_line_name'], $result['user_line_pic_url']; exit();

        $PERSON_CODE = $result['PERSON_CODE'];
        if($PERSON_CODE!=""){

            $this->load->model('Model_User');
            // $status_user_ad = $this->Model_User->Set_user_ad($result);
            
            if($this->Model_User->Set_user_ad($result)){
                if($this->Model_User->Set_user_line_account($result)){
                    if($this->Model_User->Set_user_connect_login($result)){

                     
                        if($this->Postcallbacklogin($result)){    
                            $this->load->view('welcome_view');
                        }

                    }else {echo "db user_connect false";}

                }else {echo "db user_line false";}
  
            }else {echo "db user_ad false";}
      
    

        }else{
            echo "ad PERSON_CODE false";
        }
   

    }

    public function Postcallbacklogin($result){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://webhook.toat.co.th/linebot/webhook/callback');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('type: login-true','Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($result));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

   
}  
?>  