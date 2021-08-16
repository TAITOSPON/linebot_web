<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');
require(APPPATH .'/libraries/CreatorJwt.php');

class Api_LineMessage extends REST_Controller{

        public function __construct(){

            parent::__construct();
            $this->load->model('Model_User');
            $this->load->model('Model_LineMessage');
            $this->load->model('Model_HelpCenter');
            $this->JWT = new CreatorJwt();
        }
    

        public function index_get(){}

        public function Send_Line_Message_post(){

            // if($this->JWT->CheckTokenData($this->input->request_headers('Authorization')) == true){
          
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


            // }

        }



        public function SetImgBranner_post(){
    
            if(isset($_FILES['support_set_img_log_name'])){

                $data_['user_ad_code']                     = $this->input->post('user_ad_code');
                $data_['support_set_img_log_date_start']   = $this->input->post('support_set_img_log_date_start');
                $data_['support_set_img_log_date_end']     = $this->input->post('support_set_img_log_date_end');
    

                if(!empty(  $data_['user_ad_code'] )){
                    if(!empty(  $data_['support_set_img_log_date_start'] )){
                        if(!empty(  $data_['support_set_img_log_date_end'] )){

                            $img_branner = 'https://webhook.toat.co.th/linebot/web/src/img_branner/'.$this->upload_img_branner('support_set_img_log_name',"support_set_img_log_name", APPPATH. '../src/img_branner/' , $data_['user_ad_code']  ) ;
                
            
                            $data_['support_set_img_log_name']     = $img_branner;
                
                            // print_r($data_);
                    
                            $result = $this->Model_HelpCenter->InsetLogSetImgBranner($data_);
                
                            if($result == "true"){
                                $respons = array(   'status' => "true" ,  'result' => $img_branner );
                    
                            }else{
                                $respons = array( 'status' => "false" ,   'result' => "set img false"  );
                            }



                        }else{
                            $respons = array( 'status' => "false" ,   'result' => "request support_set_img_log_date_end"  );
                        }
                    }else{
                        $respons = array( 'status' => "false" ,   'result' => "request support_set_img_log_date_start"  );
                    }
                }else{
                    $respons = array( 'status' => "false" ,   'result' => "request user_ad_code"  );
                }
            }else{
                $respons = array( 'status' => "false" ,   'result' => "request support_set_img_log_name"  );
            }

            echo json_encode($respons,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
          
    
        }
    
        public function upload_img_branner($file_img,$user_id,	$path_img , $ls_shop_id){

            $success_upload_img = "อัพเดตรูปภาพ สำเร็จ";
            $error_upload_img   = "อัพเดตรูปภาพ ไม่สำเร็จ";
    
        
            $image_name = $user_id."_".$ls_shop_id."_".date('YmdHis');
    
            
            $config = array(
                'file_name'     => $image_name,
                'allowed_types' => 'jpg|jpeg|png',
                'overwrite' => TRUE,
                'upload_path' => $path_img);
                
            $this->load->library('upload'); 
    
    
            $this->upload->initialize($config);
    
            if (!$this->upload->do_upload($file_img)){
               
                    $response = ['status' => false, 'msg' => $this->upload->display_errors()];
    
                    // print_r($response);
                    return "null";
                
            }else{
            
                // $response = ['status' => true, 'msg' => $success_upload_img,'img' => $this->base_server_url.$this->upload->data('file_name')];
    
                $upload_data = $this->upload->data();
    
                $response = ['status' => true, 'msg' => $success_upload_img, 'img' =>  $upload_data['file_name'] ];
                // print_r($response);
                return $upload_data['file_name'];
           
    
            }
        }
    

        public function GetImgBranner_get(){

        
            $respons =$this->Model_HelpCenter->GetImgBranner(); 
            echo json_encode($respons,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }

    
     

}
