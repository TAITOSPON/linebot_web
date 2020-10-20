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
                    'user_ad_id' => NULL,
                    'user_ad_code' => $result['PERSON_CODE'], 
                    'user_ad_name' => $result['PERSON_NAME'],
                    'user_ad_dept_code' => $result['PERSON_DEPT_CODE'],
                    'user_ad_dept_name' => $result['PERSON_DEPT_NAME']
                );
            
            $this->db->insert('lb_user_ad', $data);

            return "true";  

        }else if($count == "1"){

            $data = array(
                'user_ad_id' => NULL,
                'user_ad_code' => $result['PERSON_CODE'], 
                'user_ad_name' => $result['PERSON_NAME'],
                'user_ad_dept_code' => $result['PERSON_DEPT_CODE'],
                'user_ad_dept_name' => $result['PERSON_DEPT_NAME']
            );

            $this->db->trans_begin();
            $this->db->where('user_ad_code', $user_ad_code)->set($data)->update('lb_user_ad');
                   
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return "false";
            } else {
                $this->db->trans_commit();
                return "true";
            }
        }
                                
        return "false";  
    }

    public function Set_user_line_account($result) {

        // INSERT INTO `lb_user_line_account` (`user_line_id`, `user_line_uid`, `user_line_display_name`, `user_line_picture_url`) VALUES (NULL, 'sdfsdfsdfsdfsdfsfdsdfsdfsdf', 'test', 'www.test.com');
      
        $data = array(
            'user_line_id' => NULL,
            'user_line_uid' =>  $result['user_line_uid'], 
            'user_line_display_name' => $result['user_line_name'],
            'user_line_picture_url' => $result['user_line_pic_url']
            
        );
    
        $this->db->insert('lb_user_line_account', $data);
        return "false";  
    }

    // public function Connect_userad_with_userline($result) {

    //     // INSERT INTO `lb_user` (`user_id`, `user_line_id`, `user_line_uid`, `user_ad_id`, `user_status`) VALUES (NULL, '5', 'htrfhgj44', '154898', '1');

    //     return "false";  
    // }


    public function Get_log_login() {

        $query = $this->db->select('*')
                            ->get('lb_login_log')
                            ->result_array();

        return $query;  
    }
  
  
}