
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Infoma extends CI_Model
{       
    
    public function Get_Infoma_TOAT($user_ad_code,$page){

        $key_token = "";
        $Url_infoma = 'https://vmi.thaitobacco.or.th/infoma/info.asp?enno='.$user_ad_code;
        // $Url_infoma = 'https://vmi.thaitobacco.or.th/infoma/info.asp?enno=002778';
        return $Url_infoma ; 

    }

}
