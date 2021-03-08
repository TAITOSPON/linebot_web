<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_LineMessage extends CI_Model
{       

    function Send_Line_Message($result){
        // {
        //     "header": [
        //         {
        //             "User-Agent": "User-Agent:back_end_Covid"
        //         }
        //     ],
        //     "body": [
        //         {
        //             "user_ad_id_recrive": "003599",
        //             "text": "asdsdfsdf",
        //             "devicetoken": "U4f34652f4e163d5492b3fbe573a50d0a"
        //         }
        //     ],
        //     "detail": "sdfgsdfgsdfgsdfgsdfgsdfg"
        // }

        // {
        //     "header" : [
        //         {
        //             "User-Agent" : "back_end_Covid"
        //         }
        //     ],
        //     "body" : [
        //         {
        //             "user_ad_id_recrive" : "003599",
        //             "text" : "สวัสดี Nueng"
        //         }
        //     ]
        // }
        
        // {
        //     "status": "true",
        //     "result": "THIS LINEBOT WEBHOOK SERVER!"
        // }

        $UserAgent ="User-Agent:".$result['header'][0]['User-Agent'];
        $body = $result['body'];


        // LOG PUSH MESSAGE //
        $data = array(
            'push_message_log_id' => NULL,
            'push_message_log_result' => json_encode($result),
            'push_message_log_detetime' => date("Y-m-d h:i:s")
        );

        $this->db->insert('lb_push_message_log', $data);
     

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://webhook.toat.co.th/linebot/webhook/webhook');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( $UserAgent, 'Content-Type:application/json; charset=utf-8'  ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($body));
        $result = curl_exec($ch);
        curl_close($ch);

        return array(  'status' => "true" , 'result' => $result );
    }

}