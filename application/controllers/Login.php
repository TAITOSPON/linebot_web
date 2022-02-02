<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  


  
class Login extends CI_Controller {  
      

    var $liff_id = "1655109480-NdbD97GK"; // toat
    // var $liff_id = "1654967329-yQRPp5rQ"; // dev

    public function index()  
    {       

   
        $data = array( 
            'site_url' => "Login/Check_login" ,
            'liff_id' => $this->liff_id,
        );


        $this->load->view('login_check_view',$data);

    }  

    public function Goto_login_success_view($text_status){

        $data = array( 
            'liff_id' => $this->liff_id,
            'text_status' => $text_status
        );

        $this->load->view('login_success_view',$data);
    }

    public function Check_login(){

        $result['user_line_uid']        = $this->input->post('user_line_uid');
        $result['user_line_name']       = $this->input->post('user_line_name');
        $result['user_line_pic_url']    = $this->input->post('user_line_pic_url');

        $this->load->model('Model_User');
        $result = $this->Model_User->Get_user_login($result);  

        // echo json_encode($result,JSON_PRETTY_PRINT);

        if($result["result"] == "check_login_true"){

            $this->Goto_login_success_view("login_true");

        }else if($result["result"] == "check_login_false"){
          
            $data = array( 
                'site_url' => "Login/Check_login" ,
                'liff_id' => $this->liff_id,
                'text_status' => "login_true"
            );

            $this->load->view('login_view',  $data);  
        
        }else{
            echo "db check login false";
        }


    }
    
    public function login_process()  
    {  
        $user_ad = $this->input->post('user');  
        $user_ad_pass = $this->input->post('pass');  
        $user_line_uid = $this->input->post('user_line_uid');
        $user_line_name = $this->input->post('user_line_name');
        $user_line_pic_url = $this->input->post('user_line_pic_url');
        $user_os = $this->input->post('os');

        // echo $user_ad." ".$user_ad_pass." ".$user_line_uid." ".$user_line_name; exit();

        $this->GetLogin_AD($user_ad,$user_ad_pass,$user_line_uid, $user_line_name,$user_line_pic_url,$user_os);
     

    }  


    public function GetLogin_AD($user_ad,$user_ad_pass,$user_line_uid,$user_line_name,$user_line_pic_url,$user_os){
        // [{"PERSON_CODE":"003599","PERSON_NAME":"ทศพล โพชะเรือง","PERSON_DEPT_CODE":"19010300","PERSON_DEPT_NAME":"สำนักเทคโนโลยีสารสนเทศ ก.พัฒนาระบบสารสนเทศ"}]
        $file = "http://172.20.55.9/ADAuthenAPI/api/ADUser?pnc=".$user_ad."&pnp=".$user_ad_pass;
        $data = file_get_contents($file);
        $data = mb_substr($data, strpos($data, '{'));
        $data = mb_substr($data, 0, -1);
        $result = json_decode($data, true);

        $result['user_line_uid'] = $user_line_uid;
        $result['user_line_name'] = $user_line_name;
        $result['user_line_pic_url'] = $user_line_pic_url;
        $result['user_ad_code'] = $user_ad;
        $result['user_os'] = $user_os;
        
        // echo $result['user_line_uid'], $result['user_line_name'], $result['user_line_pic_url']; exit();

        $PERSON_CODE = $result['PERSON_CODE'];
        if($PERSON_CODE!=""){

            $this->load->model('Model_User');
            // $status_user_ad = $this->Model_User->Set_user_ad($result);

            if($this->Model_User->CheckLoginDuplicateUser($result)){

                if($this->Model_User->Set_user_ad($result)){
                    if($this->Model_User->Set_user_line_account($result)){
                        if($this->Model_User->CheckLogin($result)){
                            if($this->Model_User->Set_user_connect_login($result)){
                
                        
                                $this->Goto_login_success_view("login_true_first");
                                $this->Insert_log_login($result);
        
                        
                            }else {
                                // echo "db user_connect false";
                                $this->load->view('login_error_view',array( 'text_status' => "เกิดข้อผิดพลาดกรุณาลองใหม่" ));
                            }

                        }else {
                            // still login other device
                            $this->load->view('login_error_view',array( 'text_status' => "ขออภัยรหัสพนักงานของคุณเข้าสู่ระบบแล้ว<br>จากอีกอปุกรณ์<br>กรุณาออกจากระบบจากอีกอุปกรณ์ก่อน" ));

                        }

                    }else {
                        // echo "db user_line false";
                        $this->load->view('login_error_view',array( 'text_status' => "เกิดข้อผิดพลาดกรุณาลองใหม่" ));
                    }
    
                }else {
                    // echo "db user_ad false";
                    $this->load->view('login_error_view',array( 'text_status' => "เกิดข้อผิดพลาดกรุณาลองใหม่" ));
                }

            }else{
                $this->load->view('login_error_view',array( 'text_status' => "ขออภัย<br>เนื่องจากคุณได้ทำการออกจากระบบจากอีกอุปกรณ์<br>จะสามารถเข้าสู่ระบบได้อีกครั้งหลังจาก 30 นาทีหลังจากเวลาที่ออกจากระบบเพื่อป้องการทุจริต" ));
            }


    

        }else{
            $this->load->view('login_error_view',array( 'text_status' => "รหัสพนักงานไม่ถูกต้อง" ));
        }
   

    }

    public function Insert_log_login($result){

        $result['login_type'] = 'Login';
        $this->load->model('Model_User');
        $this->Model_User->Insert_Log_Login($result);
    }

    // public function Postcallbacklogin($result){

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'https://webhook.toat.co.th/linebot/webhook/webhook');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: login-true','Content-Type: application/json'));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($result));
    //     $result = curl_exec($ch);
    //     curl_close($ch);

    //     return true;
    // }




}  
?>  