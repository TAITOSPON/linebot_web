<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_HelpCenter extends CI_Model
{       
    

    public function SendFeedback($result){

        $feedback_result = array(
            'result' => $result['subject'] 
        );

        $data = array(
            'feedback_log_id' => NULL,
            'user_ad_code' => $result['user_ad_code'], 
            'user_line_uid' => $result['user_line_uid'],
            'feedback_log_result' => json_encode($feedback_result),
            'feedback_log_datetime' => date("Y-m-d H:i:s"),
            'feedback_log_os' => $result['os']
        );
    
        $this->db->insert('lb_feedback_log', $data);
        if(($this->db->affected_rows() != 1) ? false : true){
            return "true";
        }

    }



} 