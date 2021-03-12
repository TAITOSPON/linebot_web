<?php 
//application/libraries/CreatorJwt.php
    require APPPATH . '/libraries/JWT.php';

    class CreatorJwt
    {
       

        /*************This function generate token private key**************/ 

        PRIVATE $key = "1234567890qwertyuiopmnbvcxzasdfghjkl"; 
        public function GenerateToken()
        {          

            $tokenData['uniqueId'] = '11';
            $tokenData['role'] = 'nuengdev';
            $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
            $jwt = JWT::encode($tokenData, $this->key);
            return $jwt;
        }
        

       /*************This function DecodeToken token **************/

        public function DecodeToken($token)
        {          
            $decoded = JWT::decode($token, $this->key, array('HS256'));
            $decodedData = (array) $decoded;
            return $decodedData;
        }




        public function CheckTokenData($received_Token){

            try{
                if(isset($received_Token['Token'])){
                    $jwtData = $this->DecodeToken($received_Token['Token']);
                    if($jwtData['role'] == "nuengdev"){
                        return true;
                    }
                }else{
                    http_response_code('401');
                    echo json_encode(array( 
                        'status' => "false" ,
                        'result' => "token false"
                    ));
                    return false;
                }
               
            }
            catch (Exception $e){
                http_response_code('401');
                echo json_encode(array( 
                    'status' => "false" ,
                    'result' => "token false"
                ));
                return false;
            }
        }
    }