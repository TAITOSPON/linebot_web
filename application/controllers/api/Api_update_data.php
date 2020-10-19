<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_update_data extends REST_Controller {


        public function ChangeStatusDeviceAlert_post(){

                // $data = json_decode(file_get_contents('php://input'), true);
                // $user_beacon_device_id  = $data['user_beacon_device_id'];
                // $status_alert     	= $data['status_alert'];
        		
        	// $this->db->set('user_beacon_device_status_alert',$status_alert);
        	// $this->db->where('user_beacon_device_id', $user_beacon_device_id);
        	// $this->db->update('fm_user_beacon_device');


        	// $retrun = $this->db ->query("SELECT user_beacon_device_id,user_beacon_device_status_alert FROM `fm_user_beacon_device` where user_beacon_device_id ='$user_beacon_device_id'")
        	// 					->result_array();

	    	// echo json_encode($retrun,JSON_PRETTY_PRINT);

		
	}

	// public function ChangeStatusDeviceAlert_post(){

        // 	$data = json_decode(file_get_contents('php://input'), true);
        //     $user_beacon_device_id  = $data['user_beacon_device_id'];
        //     $status_alert     		= $data['status_alert'];
        		
        // 	$this->db->set('user_beacon_device_status_alert',$status_alert);
        // 	$this->db->where('user_beacon_device_id', $user_beacon_device_id);
        // 	$this->db->update('fm_user_beacon_device');


        // 	$retrun = $this->db ->query("SELECT user_beacon_device_id,user_beacon_device_status_alert FROM `fm_user_beacon_device` where user_beacon_device_id ='$user_beacon_device_id'")
        // 						->result_array();

	//     	echo json_encode($retrun,JSON_PRETTY_PRINT);

		
	// }

	// public function UpdatePositionUserBeaconDevice_post(){

        // 	$data = json_decode(file_get_contents('php://input'), true);
        //         $user_beacon_device_position_time_update = date('Y-m-d H:i:s');

        //         for($i = 0; $i < sizeof($data); $i++){

        //                 $user_beacon_device_id           = $data[$i]['user_beacon_device_id'];
        //                 $user_beacon_device_position_lat = $data[$i]['user_beacon_device_position_lat'];
        //                 $user_beacon_device_position_lng = $data[$i]['user_beacon_device_position_lng'];
                    
        //                 $data_update = array('user_beacon_device_position_lat' => $user_beacon_device_position_lat
        //                                                         ,'user_beacon_device_position_lng' => $user_beacon_device_position_lng
        //                                                         ,'user_beacon_device_position_time_update' => $user_beacon_device_position_time_update);
        //                 $this->db->where('user_beacon_device_id',$user_beacon_device_id);
        //                 $this->db->update('fm_user_beacon_device',$data_update);
        //         }
       
	// }

}
