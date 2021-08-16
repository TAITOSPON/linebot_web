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

    public function GetFeedback(){
        
        $query = $this->db->query(" SELECT * FROM lb_feedback_log  
                                    INNER JOIN `lb_user_ad` ON `lb_user_ad`.user_ad_code = `lb_feedback_log`.user_ad_code 
                                    ORDER BY `lb_feedback_log`.`feedback_log_id` DESC")->result_array();
        return $query;

    }

    public function InsetLogSetImgBranner($result){

        if($result['support_set_img_log_name'] != "https://webhook.toat.co.th/linebot/web/src/img_branner/null"){
            $data = array(
                'support_set_img_log_id'          => NULL,
                'support_set_img_log_name'        => $result['support_set_img_log_name'], 
                'support_set_img_log_date_start'  => $result['support_set_img_log_date_start'],
                'support_set_img_log_date_end'    => $result['support_set_img_log_date_end'],
                'support_set_img_log_datetime_set' => date("Y-m-d H:i:s"),
                'user_ad_code'                    => $result['user_ad_code'], 
               
              
            );
        
            $this->db->insert('lb_support_set_img_log', $data);
            if(($this->db->affected_rows() != 1) ? false : true){
                return "true";
            }else{
                return "false";
            }

        }else{
            return "false";
        }

      


    }

    public function GetImgBranner(){
        $date_now = date("Y-m-d H:i:s");
        $query = $this->db->query(" SELECT * FROM `lb_support_set_img_log`  
        WHERE support_set_img_log_date_start < '$date_now' And support_set_img_log_date_end  > '$date_now' 
        ORDER BY `support_set_img_log_id` DESC LIMIT 1")->result_array();
        return array("status" => "true" ,"result" => $query) ;

    }





    public function GetAllUserStampWFH(){
        

        $WFH = '%"category":"LINE_WFH"%' ;
        $WFH_ = '%"category":""%' ;

        $query = $this->db->query("SELECT*FROM `lb_time_stamp_log`
        INNER JOIN `lb_user_ad` ON `lb_user_ad`.user_ad_code = `lb_time_stamp_log`.user_ad_code  
    
        WHERE time_stamp_log >=  DATE('2021-04-16') 
        -- and time_stamp_log <= DATE('Y-m-d') 
        -- WHERE `lb_user_ad`.user_ad_code = '203393'
        -- AND `lb_user_ad`.user_ad_dept_code LIKE '4300%'
        AND ( time_stamp_log_status_wifi like '$WFH' OR  time_stamp_log_status_wifi like '$WFH_' ) 
        ORDER BY `time_stamp_log_id` ASC")->result_array();

        // echo $this->db->last_query(); exit();
 
        for($i=0; $i < sizeof($query); $i++){

            // $query[$i]['time_stamp_log_index'] = $i;

            // if($query[$i]['time_stamp_log_lat_lon'] == ""){

            //     // $query[$i]["time_stamp_log_lat_lon"] =  $this->GetLatlonFromIP( $query[$i]["time_stamp_log_ip"] );
            //     $query[$i]["time_stamp_log_province"] = "empty";
            // }else{
            //     $query[$i]["time_stamp_log_province"] = "empty";
            //     // $query[$i]["time_stamp_log_province"] = $this->GetAddressFromLatlon( $query[$i]['time_stamp_log_lat_lon'] );
            // }

            $query[$i]["time_stamp_log_province"] = "";
        }
        
        return $query;

    }

    public function RE_GetAllUserStampWFH($query){
      
        for($i=0; $i < sizeof($query); $i++){

            if( $query[$i]["time_stamp_log_province"] == ""){


                if( $query[$i]["time_stamp_log_lat_lon"] != ""){

                    // $query[$i]["time_stamp_log_province"] = $this->GetAddressFromLatlon($query[$i]["time_stamp_log_lat_lon"]);

                  
                }else{
          
                    $query[$i]["time_stamp_log_province"] = $this->GetLatlonFromIP($query[$i]["time_stamp_log_ip"]);
                    
                }

               
            }

        }

        return $query;

    }


    
    public function GetLatlonFromIP($ip){
        
        // $file = "http://api.ipstack.com/".$ip."?access_key=acf61758d1bbf3042f2146d197da598a&format=1" ; 

       
        // $file = "https://api.ipgeolocation.io/ipgeo?apiKey=3dae2ab9dcf241f78510a7a198dc387b&ip=".$ip;

        $file = "http://ip-api.com/json/".$ip;


        $data = file_get_contents($file);
        $result = json_decode($data, true);

        // $latlon = $result['latitude'].",".$result['longitude'];
     
        $latlon = $result['lat'].",".$result['lon'];


        $province = $result['city'];

        if($province == NULL){
            return "empty";
        }else{
            return $province;
        }




    }

    public function GetAddressFromLatlon($latlon){
        
   
        $LatlLon = explode(",", $latlon); 

        $lat = $LatlLon[0];
        $lon = $LatlLon[1];
        
        $file = "https://api.longdo.com/map/services/address?lon=".$lon."&lat=".$lat."&key=895d89ba88f975b9666679b61e2d6637";
        $data = file_get_contents($file);
        $result = json_decode($data, true);

          
        $province = $result['province'];

        if($province == NULL){
            return "empty";
        }else{
            return $province;
        }

     

     
    }



    public function GetData_Issue(){
        
        // $query = $this->db->query(" SELECT * FROM `lb_time_stamp_log` WHERE user_ad_code = 002693  
        // ORDER BY `lb_time_stamp_log`.`time_stamp_log_id`  DESC")->result_array();
        // return $query;

        $WFH = '%"category":"LINE_WFH"%' ;

        $query = $this->db->query("SELECT * FROM `lb_time_stamp_log` 
        WHERE `time_stamp_log_status_wifi` LIKE '$WFH'
        ORDER BY `time_stamp_log_id`  DESC")->result_array();
        return $query;
    }





} 