<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_User extends CI_Model
{       

    public function Set_user_ad($result) {
       
        $user_ad_code = $result['PERSON_CODE'];
        $data = $this->db->query("SELECT COUNT(user_ad_code)FROM lb_user_ad WHERE user_ad_code = '$user_ad_code'")->result_array();
        
        $count = $data[0]["COUNT(user_ad_code)"];

        if($count == "0"){
        
            $data = array(
                    'user_ad_code' => $result['PERSON_CODE'], 
                    'user_ad_name' => $result['PERSON_NAME'],
                    'user_ad_dept_code' => $result['PERSON_DEPT_CODE'],
                    'user_ad_dept_name' => $result['PERSON_DEPT_NAME']
                );
            
            $this->db->insert('lb_user_ad', $data);

            return true;  

        }else if($count == "1"){

            $data = array(
                'user_ad_code' => $result['PERSON_CODE'], 
                'user_ad_name' => $result['PERSON_NAME'],
                'user_ad_dept_code' => $result['PERSON_DEPT_CODE'],
                'user_ad_dept_name' => $result['PERSON_DEPT_NAME']
            );

            $this->db->trans_begin();
            $this->db->where('user_ad_code', $user_ad_code)->set($data)->update('lb_user_ad');
                   
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
                                
        return false;  
    }

    public function Set_user_line_account($result) {

        // SELECT COUNT(user_line_uid)FROM lb_user_line_account WHERE user_line_uid = "U4f34652f4e163d5492b3fbe573a50d0a"
        $user_line_uid = $result['user_line_uid'];
        $data = $this->db->query("SELECT COUNT(user_line_uid)FROM lb_user_line_account WHERE user_line_uid = '$user_line_uid'")->result_array();
        
        $count = $data[0]["COUNT(user_line_uid)"];

        // echo $count; exit();

        if($count == "0"){

            $data = array(
                'user_line_uid' =>  $result['user_line_uid'], 
                'user_line_display_name' => $result['user_line_name'],
                'user_line_picture_url' => $result['user_line_pic_url']
                
            );

            $this->db->insert('lb_user_line_account', $data);
            return true;
    
   
        }else if($count == "1"){

            $data = array(
                'user_line_uid' =>  $result['user_line_uid'], 
                'user_line_display_name' => $result['user_line_name'],
                'user_line_picture_url' => $result['user_line_pic_url']
                
            );
            $this->db->trans_begin();
            $this->db->where('user_line_uid', $user_line_uid)->set($data)->update('lb_user_line_account');
                   
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }

        }
    
        return false;  
    }


    public function CheckLogin($result){
       
        $result_check_login = $this->Get_line_uid_with_user_ad($result);
        $result_check_login_data = $result_check_login['result']; 
        if(sizeof($result_check_login_data) != 0){
            if($result_check_login_data[0]['user_line_uid'] == ""){
                return true;
            }else{
                $result['login_type'] = 'Try_Other_Device_Not_Logout';
                $this->Insert_Log_Login($result);
                return false;
            }
          
        }else{
            return true;
        }

    }
    public function Set_user_connect_login($result) {
        
        // ---logout before ---//
        // $this->Set_user_logout($result);
        
      
       
        // --- new connect ---//
        $user_ad_code = $result['PERSON_CODE'];
        $data = $this->db->query("SELECT COUNT(user_ad_code)FROM lb_user_connect WHERE user_ad_code = '$user_ad_code'")->result_array();
        
        $count = $data[0]["COUNT(user_ad_code)"];
        if($count == "0"){

            // INSERT INTO `lb_user_connect` (`user_connect_id`, `user_ad_code`, `user_line_uid`, `user_connect_status`) VALUES (NULL, '56365', 'sdfgsdfgs', 'true');
            $data = array(
                'user_connect_id' =>  NULL, 
                'user_ad_code' => $result['PERSON_CODE'],
                'user_line_uid' => $result['user_line_uid'],
                'user_connect_os' => $result['user_os'],
                'user_connect_status' => "true"
            );

            $this->db->insert('lb_user_connect', $data);
            return true;

        }else if($count == "1"){

            $data = array(
                'user_ad_code' => $result['PERSON_CODE'],
                'user_line_uid' => $result['user_line_uid'],
                'user_connect_os' => $result['user_os'],
                'user_connect_status' => "true"
            );
            $this->db->trans_begin();
            $this->db->where('user_ad_code', $user_ad_code)->set($data)->update('lb_user_connect');
                   
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        }
        return false;  
    }

    public function Set_user_logout($result){

        $user_line_uid = $result["user_line_uid"];

        $data = array('user_line_uid' => "");

        $this->db->trans_begin();
        $this->db->where('user_line_uid', $user_line_uid)->set($data)->update('lb_user_connect');
                
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            
            return array('status' => false, 'result' => "logout_update_false" ,'data' => "");
        } else {
            $this->db->trans_commit();
            return array('status' => true, 'result' => "logout_update_true" ,'data' =>  "");
        }

        return array('status' => false, 'result' => "logout_update_error" ,'data' =>  "");;
    }

    public function Get_user_login($result){

        $user_line_uid = $result["user_line_uid"];
        $query = $this->db->query("SELECT COUNT(user_line_uid)FROM lb_user_connect WHERE user_line_uid = '$user_line_uid'")->result_array();
        $count = $query[0]["COUNT(user_line_uid)"];

        if($count == "1"){
            $query = $this->db->get_where('lb_user_connect', array('user_line_uid' => $user_line_uid))->result_array();
            return array('status' => true, 'result' => "check_login_true" ,'data' =>  $query);

        }else if($count == "0"){
            return array('status' => false, 'result' => "check_login_false", 'data' =>  "");
        }

        return array('status' => false, 'result' => "check_login_error", 'data' =>  "");
       
    }

    public function Get_user_ad_with_line_uid($result){

        $user_line_uid = $result["user_line_uid"];
        if($user_line_uid!=null){
            $query = $this->db->query("SELECT * FROM `lb_user_ad` INNER JOIN lb_user_connect ON lb_user_ad.user_ad_code=lb_user_connect.user_ad_code WHERE lb_user_connect.user_line_uid = '$user_line_uid'")->result_array();
            return $query;
        }else{
            return null;
        }
      
    }

    public function Get_line_uid_with_user_ad($result){

        $user_ad_code = $result["user_ad_code"];
        if($user_ad_code!=null){
            $query = $this->db
            ->where('user_ad_code',$user_ad_code)
            ->get('lb_user_connect')
            ->result_array();
            return array('status' => true, 'result' => $query);
        }else{
            return array('status' => false, 'result' => "");
        }
      
    }

    public function Insert_Log_Login($result){

        $data = array(
            'login_id' => NULL,
            'login_date' => date("Y-m-d H:i:s"),
            'user_ad_code' => $result['user_ad_code'], 
            'user_line_uid' => $result['user_line_uid'],
            'login_type' =>  $result['login_type'],
            'login_os' => $result['user_os']
        );
    
        $this->db->insert('lb_login_log', $data);
    }

    public function CheckLoginDuplicateUser($result){

        $user_ad_code = $result["user_ad_code"];
        $user_line_uid = $result['user_line_uid'];


        if($this->CheckLoginDuplicateUid($result)){
            
            $query = $this->db->query("SELECT * FROM `lb_login_log` 
            WHERE user_ad_code = '$user_ad_code'  
            AND login_type = 'Logout'
            ORDER BY `lb_login_log`.`login_id` DESC LIMIT 1")->result_array();
        
            if(sizeof($query) != 0){
                if( $user_line_uid != $query[0]['user_line_uid']){
                   
                    $date_logout = $query[0]['login_date'];
                    $date_status =  date("Y-m-d H:i:s",strtotime(date( $date_logout)." +30 minutes"));
                  
                    if(date("Y-m-d H:i:s") <  $date_status ){
                      
                        $result['login_type'] = 'Try_Other_Device';
                        $this->Insert_Log_Login($result);
                        
                        return false;
    
                    }else{
    
                        return true;
                    }
                
                }else{
                    
                    return true;
                }
            }

            return true;
        }
    



    }

    public function CheckLoginDuplicateUid($result){
       
        $user_ad_code = $result["user_ad_code"];
        $user_line_uid = $result['user_line_uid'];

        $query_uid = $this->db->query(" SELECT * FROM `lb_login_log` 
        WHERE user_line_uid ='$user_line_uid'
        AND login_type = 'Logout'
        ORDER BY `lb_login_log`.`login_id` DESC LIMIT 1")->result_array();
        
        if(sizeof($query_uid) != 0){

            if( $user_ad_code != $query_uid[0]['user_ad_code']){
                
                $date_logout_uid = $query_uid[0]['login_date'];

                $date_status_uid =  date("Y-m-d H:i:s",strtotime(date( $date_logout_uid)." +30 minutes"));
                if(date("Y-m-d H:i:s") <  $date_status_uid ){
                    
                    $result['login_type'] = 'Try_Other_Device';
                    $this->Insert_Log_Login($result);

                    return false;
    
                }else{
                    return true;
                }

             }else{
                    
                return true;
            }
          
        }

        return true;
       
    }

    public function User_logout_with_ad($result){

        $user_ad_code = $result["user_ad_code"];

          $data = array('user_line_uid' => "");

        $this->db->trans_begin();
        $this->db->where('user_ad_code', $user_ad_code)->set($data)->update('lb_user_connect');
                
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            
            return array('status' => false, 'result' => "logout_update_false" ,'data' => "");
        } else {
            $this->db->trans_commit();
            return array('status' => true, 'result' => "logout_update_true" ,'data' =>  "");
        }

        return array('status' => false, 'result' => "logout_update_error" ,'data' =>  "");
    }


    public function Get_test($result){
        $user_ad_code = $result['user_ad_code'];
       
        $data = $this->db->query(" SELECT *
        FROM `lb_user_line_account`  
        INNER JOIN lb_user_connect 
        ON lb_user_line_account.user_line_uid= lb_user_connect.user_line_uid 
        WHERE lb_user_connect.user_ad_code = '$user_ad_code'")->result_array();
        
        return $data;
    }
  
} 