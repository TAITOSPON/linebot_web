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
        // $this->load->view('welcome_view');
     
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
            $status_user_ad = $this->Model_User->Set_user_ad($result);
            
            if($status_user_ad == "true"){
                $status_user_line = $this->Model_User->Set_user_line_account($result);
                if($status_user_line == "true"){

                    $status_user_connect = $this->Model_User->Set_user_connect_login($result);
                    if($status_user_connect == "true"){

                        // echo  "status_user_connect".$status_user_connect;

                        $this->load->view('welcome_view');

                    }else {echo "db user_connect false";}

                }else {echo "db user_line false";}
  
            }else {echo "db user_ad false";}
      
    

        }else{
            echo "ad PERSON_CODE false";
        }
   

         
    }


    // public function Send_Firebase_Notification_Android($token, $data){
	//  		// echo "Send_Firebase_Notification_Android";

    //              $title           = "Device disconnect";
    //              $message         = $data[0]["user_beacon_device_name"];
    //              $timestamp       = date('Y-m-d H:i:s');
    //              $track_id        = "DEVICEDISCONNECT";
    //              $user_id 		  = $data[0]["fk_user_id"];
    //              $device_id 	  = $data[0]["fk_beacon_device_id"];

    //              $msg_android = array
    //                  (
    //                  'title' => $title,
    //                  'message' => $message,
    //                  'timestamp' => $timestamp,
    //                  'track_id' => $track_id,
    //                  'user_id' => $user_id,
    //                  'beacon_device_id' => $device_id,
    //              );
    //              $fields = array( 
    //                  'to' => $token,
    //                  'data' => $msg_android,
                     
    //              );
    //              $headers = array
    //                  (
    //                  'Authorization: key=AAAAA2Yrf1U:APA91bH_6qZRUcJkK9NihbrZiOgXSfwy3sDVLRCY4zo0lFMARkPKXSVC3MRymbSl92uyNf9GWQdqSO8Ip-jCEGBTOtKi9Fmi84zNpxRdM-gBfTS8de9gUA9coVVJ_IhXxyoNeHr-OEOF',
    //                  'Content-Type: application/json',
    //              );
    //              $ch = curl_init();
    //              curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //              curl_setopt($ch, CURLOPT_POST, true);
    //              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    //              $result = curl_exec($ch);
    //              curl_close($ch);

    //  }
   
}  
?>  