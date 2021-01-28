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

        return json_encode($data) ;

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, '192.168.0.20/lineOfficial/api/TimestampByType');
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        // $result = curl_exec($ch);
        // curl_close($ch);

        // return array(  'status' => "true" , 'result' => $result );
    
    }





} 