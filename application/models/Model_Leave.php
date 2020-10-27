<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Leave extends CI_Model
{       
    
    
    public function get_leave_year($user_ad_code){
        // http://192.168.0.51/memberapi/api/yearrangeapi?id=003259
        $file = "http://192.168.0.51/memberapi/api/yearrangeapi?id=".$user_ad_code;
        $data = json_decode(file_get_contents($file), true);
        return $data;

   }

   public function get_leave_head_year($user_ad_code,$leave_year){
        // http://192.168.0.51/memberapi/api/leaveyearapi?id=003259&year=2562
        $file = "http://192.168.0.51/memberapi/api/leaveyearapi?id=".$user_ad_code."&year=".$leave_year;
        $data = json_decode(file_get_contents($file), true);
        return $data;

   }

   public function get_leave_detail_year($user_ad_code,$leave_year){
        // http://192.168.0.51/memberapi/api/leaveyeardetailapi?id=003259&year=2562
        $file = "http://192.168.0.51/memberapi/api/leaveyeardetailapi?id=".$user_ad_code."&year=".$leave_year;
        $data = json_decode(file_get_contents($file), true);  
     
        $leave_vacation = array();
        $leave_leave = array();

        for ($i = 0; $i < sizeof($data); $i++) {
             
             if($data[$i]["LeaveType"] == "04"){

                  array_push($leave_vacation,$data[$i]);

             }else if($data[$i]["LeaveType"] == "03"){

                  array_push($leave_leave,$data[$i]);

             }

        }

        $data = array(
             'leave_vacation' =>  $leave_vacation,
             'leave_leave' => $leave_leave
        );

        return $data;

   }
  
} 