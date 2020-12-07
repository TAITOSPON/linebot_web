<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_TimeAt extends CI_Model
{       
    


    public function get_time_feed($user_ad_code){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://change.toat.co.th/timeatt/index.php/api/chk_inout/getfeedtimeByUser');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: login-true','Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( array('user_id' => $user_ad_code)) );
        $result = curl_exec($ch);
        curl_close($ch);
        return  $result;
    }

} 