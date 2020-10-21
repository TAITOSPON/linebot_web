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

    public function Set_user_connect_login($result) {
        
        // ---logout before ---//
        $this->Set_user_logout($result);

       
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
                'user_connect_status' => "true"
            );

            $this->db->insert('lb_user_connect', $data);
            return true;

        }else if($count == "1"){

            $data = array(
                'user_ad_code' => $result['PERSON_CODE'],
                'user_line_uid' => $result['user_line_uid'],
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

        $query = $this->db->query("SELECT COUNT(user_line_uid)FROM lb_user_connect WHERE user_line_uid = '$user_line_uid'")->result_array();
        $count = $query[0]["COUNT(user_line_uid)"];

        $data = array(
            'user_line_uid' => "",
        );

        $this->db->trans_begin();
        $this->db->where('user_line_uid', $user_line_uid)->set($data)->update('lb_user_connect');
                
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

        return false;
    }


    public function Get_log_login() {

        $query = $this->db->select('*')
                            ->get('lb_login_log')
                            ->result_array();

        return $query;  
    }
  
  
}