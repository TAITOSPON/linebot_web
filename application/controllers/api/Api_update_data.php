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

        //      $data = json_decode(file_get_contents('php://input'), true);
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

        public function Check_user_post(){

                $this->load->model('Model_Member');

                $data = json_decode(file_get_contents('php://input'), true);
                $user_ad_code = $data['user_ad_code'];

        	$retrun = $this->db->query("SELECT * FROM `lb_time_stamp_log` WHERE user_ad_code = '$user_ad_code'
                 AND (time_stamp_log_datetime LIKE '2022-03-%' or time_stamp_log_datetime LIKE '2022-04-%')  
                                        ORDER BY `lb_time_stamp_log`.`time_stamp_log_id`  ASC")
        						->result_array();

                for($i = 0; $i < sizeof($retrun); $i++){
                        $time_stamp_log_result = json_decode($retrun[$i]['time_stamp_log_result'],true);
                        $retrun[$i]['time_stamp_log_result'] = $time_stamp_log_result[0]['status_new'];

                        $time_stamp_log_status_wifi = json_decode($retrun[$i]['time_stamp_log_status_wifi'],true);
                        $retrun[$i]['time_stamp_log_status_wifi'] = $time_stamp_log_status_wifi['category'];
                      
                        $detal_profile = $this->Model_Member->GetProfile($user_ad_code);  
                        $detal_profile = json_encode($detal_profile,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                        $detal_profile = json_decode($detal_profile,true);
                        
        
                        $retrun[$i]['PersonalName']     = $detal_profile['result']['personal']['PersonalName'];
                        $retrun[$i]['Department']       = $detal_profile['result']['personal']['Department'];

                        $retrun[$i]['time_stamp_log_lat_lon']  = "https://maps.google.com/?q=".$retrun[$i]['time_stamp_log_lat_lon'];
         
                }

         
               
	    	echo json_encode($retrun,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);



        }

        public function tsdfsdf($data){
                $result = array();

                for($i = 0; $i < sizeof($data); $i++){

                        if( sizeof( $data[$i]['data']) > 1){

                                $status = $this->checkindata( $data[$i]['data']);    
                                if( $status == "false" ){
                                        $user_line_uid =  $data[$i]['user_line_uid'];
                                        $user_line_display_name = $this->db ->query("SELECT user_line_display_name FROM `lb_user_line_account` WHERE user_line_uid = '$user_line_uid'")->result_array(); 
                                        
                                        $model[$i]['user_line_uid'] = $user_line_uid;
                                        $model[$i]['user_line_display_name'] = $user_line_display_name[0]['user_line_display_name'];
                                        array_push($result,$model[$i]); 
                                }
                             
                        }
                           
                }
           


                return  $result ;

        }

        public function checkindata($data){

                $result = array();
               
       

                for($i = 0; $i < sizeof($data); $i++){
                     

                       if($data[$i]['user_ad_code'] !=  $data[0]['user_ad_code'] ){
                                $status = "false";
                                return $status;
                       }
                           
                }

                $status = "true";
                return $status;

        }


        public function gettime($data){
                // $result = array();
                for($i = 0; $i < sizeof($data); $i++){
                        $user_line_uid = $data[$i]['user_line_uid'];
                        $time = $this->db ->query("SELECT DISTINCT  `lb_time_stamp_log`.user_ad_code ,user_ad_name,user_ad_dept_name FROM `lb_time_stamp_log` INNER JOIN lb_user_ad ON lb_time_stamp_log.user_ad_code = lb_user_ad.user_ad_code WHERE user_line_uid ='$user_line_uid'
                        ORDER BY `lb_time_stamp_log`.`time_stamp_log_id`  DESC")->result_array();
                        $data[$i]['time'] = $time;
                        // array_push($result,$time); 
                }     

                // return  $result ;
                return  $data ;
                
        }

        public function dfsdf($data){
                $result = array();

                for($i = 0; $i < sizeof($data); $i++){

                        if( sizeof( $data[$i]['time']) > 1){

                                array_push($result, $data[$i]); 
                        }
                }

                 return  $result ;
        }

}
