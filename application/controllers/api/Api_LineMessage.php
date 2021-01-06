<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_LineMessage extends REST_Controller{

        public function __construct(){

            parent::__construct();
            $this->load->model('Model_User');
            $this->load->model('Model_LineMessage');
        }
   

        public function index_get(){}

       
    
       public function Send_Line_Message_post(){

            $data = json_decode(file_get_contents('php://input'), true);     
           
            if( isset( $data['body']) ){
                
                $user_ad_code = $data['body'][0]['user_ad_id_recrive'];

                $detail_user_recrive = $this->Model_User->Get_line_uid_with_user_ad(array('user_ad_code' => $user_ad_code));
                if($detail_user_recrive['status']=="true"){
                    
                    $result = $detail_user_recrive['result'];
                    
                    if(sizeof($result) != 0){

                        if($result[0]['user_line_uid'] != ""){

                            $data['body'][0]['devicetoken'] = $result[0]['user_line_uid'];

                            $result = $this->Model_LineMessage->Send_Line_Message($data);  
                            echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                       
                        }else{
                            return array( 
                                'status' => "false" ,
                                'result' => "none user login line"
                            );
                        }
                       
                    }else{
                        return array( 
                            'status' => "false" ,
                            'result' => "none user login line"
                        );
                    }
                   
                    
                }else{
                    return array( 
                        'status' => "false" ,
                        'result' => "none user login line"
                    );
                }
       
            }else{
                return array( 
                    'status' => "false" ,
                    'result' => "request body , user_ad_id_recrive"
                );
        
            }

            // $result = $this->Model_LineMessage->Send_Line_Message($data);  
            // echo json_encode($detail_user_recrive,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


       }


    
     

}
