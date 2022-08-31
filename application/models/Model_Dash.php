<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dash extends CI_Model{       

    public function GetUserSaleLog($user_ad_code){

        $retrun = $this->db->query("SELECT * FROM `lb_time_stamp_log` WHERE user_ad_code = '$user_ad_code'
        AND (time_stamp_log_datetime LIKE '2022-03-%' or time_stamp_log_datetime LIKE '2022-04-%')  
                                ORDER BY `lb_time_stamp_log`.`time_stamp_log_id`  ASC")
                        ->result_array();

  
        return  $retrun ;
    }
}