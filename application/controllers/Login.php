<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Login extends CI_Controller {  
      
    public function index()  
    {  
        $this->load->view('login_view');  
    }  
    
    public function login_process()  
    {  
        $user = $this->input->post('user');  
        $pass = $this->input->post('pass');  

       

        $this->GetLogin_AD($user,$pass);
        
     
    }  


    public function GetLogin_AD($user,$pass){
        // [{"PERSON_CODE":"003599","PERSON_NAME":"ทศพล โพชะเรือง","PERSON_DEPT_CODE":"19010300","PERSON_DEPT_NAME":"สำนักเทคโนโลยีสารสนเทศ ก.พัฒนาระบบสารสนเทศ"}]
        $file = "http://172.20.55.9/ADAuthenAPI/api/ADUser?pnc=".$user."&pnp=".$pass;
        $data = file_get_contents($file);
        $data = mb_substr($data, strpos($data, '{'));
        $data = mb_substr($data, 0, -1);
        $result = json_decode($data, true);
        
        
        echo $result['PERSON_CODE'];

         // $this->load->view('welcome_message');
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