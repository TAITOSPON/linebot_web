<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_TimeStamp extends CI_Model
{       
    


    public function PostTimeStamp($result){
        

        // {
        //     "apiKey":"bW90aGVyZnVja2VybGluZXRpbWVzdGFtcA==",
        //     "empID":"003599",
        //     "timestamp":"2020-01-28 10:48:40",
        //     "category":"LINE_KT"
        // }

        $data = array(
            'apiKey' => "bW90aGVyZnVja2VybGluZXRpbWVzdGFtcA==",
            'empID' => $result['user_ad_code'],
            'timestamp' =>  $result['timestamp'],
            'category' => $result['category']
        );

        // return json_encode($data) ;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.0.20/lineOfficial/api/TimestampByType');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);


        // $result ='
        // {
        //     "status_old": 200,
        //     "status_new": 200
        // }';


        return $result;
    
    }

    public function CheckUserWFH($user_ad_code){

        // https://change.toat.co.th/timeatt/index.php/api/chk_inout/chkUserWFH


        $data = array(
            'user_id' => $user_ad_code, 
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://change.toat.co.th/timeatt/index.php/api/chk_inout/chkUserWFH');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;

    }

    public function Get_TimeAt_feed_with_ad($user_ad_code){

        $data = array(
            'user_ad_code' => $user_ad_code, 
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://webhook.toat.co.th/linebot/web/index.php/api/Api_TimeAt/TimeAt_feed_with_ad');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }


    public function Insert_Log_Time_Stamp($result){
        
        $data = array(
            'time_stamp_log_id' => NULL,
            'time_stamp_log_datetime' => date("Y-m-d H:i:s"),
            'time_stamp_log_status_wifi' => json_encode($result['time_stamp_log_status_wifi']),
            'time_stamp_log_result' => json_encode($result['time_stamp_log_result']),
            'time_stamp_log' => $result['timestamp'],
            'time_stamp_log_ip' => $result['ip'],
            'time_stamp_log_lat_lon' => $result['latlon'],
            'time_stamp_log_os' => $result['os'],
            'user_ad_code' => $result['user_ad_code'], 
            'user_line_uid' => $result['user_line_uid']
        );
    
 
        $this->db->insert('lb_time_stamp_log', $data);

        
    }

    public function Insert_Log_Time_Stamp_error($result){
        
        $data = array(
            'time_stamp_log_id' => NULL,
            'time_stamp_log_datetime' => date("Y-m-d H:i:s"),
            'time_stamp_log_status_wifi' => json_encode($result['time_stamp_log_status_wifi']),
            'time_stamp_log_result' => json_encode($result['time_stamp_log_result']),
            'time_stamp_log' => $result['timestamp'],
            'time_stamp_log_ip' => $result['ip'],
            'time_stamp_log_lat_lon' => $result['latlon'],
            'time_stamp_log_os' => $result['os'],
            'user_ad_code' => $result['user_ad_code'], 
            'user_line_uid' => $result['user_line_uid']
        );
    
 
        $this->db->insert('lb_time_stamp_log_error', $data);

        
    }

    public function GetLoginLog(){
       
        $query = $this->db->query(" SELECT * FROM `lb_login_log` INNER JOIN lb_user_ad ON lb_login_log.user_ad_code=lb_user_ad.user_ad_code 
        AND login_date Like '2022-07%'
        ORDER BY `lb_login_log`.`login_id`  DESC")->result_array();
        return $query ;
     }
  

    // public function Getdataforfixed($user_ad_code){
    //     $query = $this->db->query(" SELECT time_stamp_log FROM `lb_time_stamp_log`
    //     WHERE (time_stamp_log_ip = '1.1.253.10' or time_stamp_log_ip = '1.1.253.2') 
    //     AND user_ad_code = '$user_ad_code'
    //     AND time_stamp_log_datetime LIKE '2021-09-20%'
    //     and time_stamp_log_status_wifi LIKE '%LINE_WFH%' ORDER BY `lb_time_stamp_log`.`time_stamp_log_id` ASC LIMIT 1")->result_array();
    //     return $query ;
    // }

    // public function Getalluserfixed(){
    //     $query = $this->db->query(" SELECT DISTINCT user_ad_code FROM `lb_time_stamp_log`
    //     WHERE   (time_stamp_log_ip = '1.1.253.10' or time_stamp_log_ip = '1.1.253.2') 
    //     and time_stamp_log_status_wifi LIKE '%LINE_WFH%'  
    //     AND time_stamp_log_datetime LIKE '2021-09-20%'
    //     ORDER BY `lb_time_stamp_log`.`time_stamp_log_id` ASC")->result_array();
    //     return $query ;
    // }




} 