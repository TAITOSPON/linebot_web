
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Covid19 extends CI_Model{    
    
    public function Get_Covid_web_emp($user_ad_code){

        $key_token = "sdfdfsdfsdfsdfpowerwoildskfmcvnxxcmnxcvhieriowptynmneew4ewrerdffsdfsdfvcxvnbmj";

        // https://change.toat.co.th/covid19/index.php/Welcome/bypassEmp/003599/sdfdfsdfsdfsdfpowerwoildskfmcvnxxcmnxcvhieriowptynmneew4ewrerdffsdfsdfvcxvnbmj
        $Covid_web_emp = 'https://change.toat.co.th/covid19/index.php/Welcome/bypassEmp/'.$user_ad_code.'/'.$key_token;
        return $Covid_web_emp ; 


    }


    public function Get_Covid_web_boss($user_ad_code,$self_assessment_id){

        $key_token = "sdfdfsdfsdfsdfpowerwoildskfmcvnxxcmnxcvhieriowptynmneew4ewrerdffsdfsdfvcxvnbmj";
        $code =  $user_ad_code.$self_assessment_id;
        // https://change.toat.co.th/covid19/index.php/Welcome/bypassEmp/003599/sdfdfsdfsdfsdfpowerwoildskfmcvnxxcmnxcvhieriowptynmneew4ewrerdffsdfsdfvcxvnbmj
        $Covid_web_boss = 'https://change.toat.co.th/covid19/index.php/Welcome/bypassBoss/'.$code.'/'.$key_token;
        return $Covid_web_boss ; 


    }
}