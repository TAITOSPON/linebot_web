<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Covid19 extends CI_Controller {  
    
    var $liff_id_covid_emp = "1655109480-VjdKrvBX";
    var $liff_id_covid_19 = "1655109480-2XKglnaX";


    public function __construct()
    {
		parent::__construct();

        $this->load->model('Model_User');
        $this->load->model('Model_Covid19');
     

    }


    public function index(){    
        $data = array( 
            'site_url' => "Covid19/test2" ,
            'liff_id' => $this->liff_id_covid_19,
        );

        $this->load->view('login_check_view', $data); 

    }




    public function Covid19_boss($self_assessment_id){
  
        // echo $self_assessment_id;

        $data = array( 
            'site_url' => "Covid19/Covid19_boss_view/$self_assessment_id" ,
            'liff_id' => $this->liff_id_covid_19,
   
        );

        $this->load->view('login_check_view', $data); 
   
    } 


    public function Covid19_boss_view($self_assessment_id){
        // echo $self_assessment_id;
        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        // print_r($result); exit();
       
        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
           
            $site_url = $this->Model_Covid19->Get_Covid_web_boss($result[0]["user_ad_code"],$self_assessment_id);
            $data = array(  'site_url' => $site_url , );
            $this->load->view('Covid19/Covid_ifram_view',$data); 

           
        
        }else{

           
            $data = array( 'liff_id' => $this->liff_id_covid_19, 'text_status' => "" );
            $this->load->view('login_success_view',$data);
            
        
        }
       

    } 







    public function Covid19_emp()   {       
        $this->Login_Line("Covid19_emp_form",$this->liff_id_covid_emp);
  
    }



    public function Login_Line($page,$liff_id){

        $data = array( 
            'site_url' => "Covid19/".$page ,
            'liff_id' => $liff_id,
        );

        $this->load->view('login_check_view', $data); 
    }
  


    public function Covid19_emp_form(){

        $this->Covid19_view($this->liff_id_covid_emp);

    }



    public function Covid19_view($liff_id){   
       

        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
  
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
 
        // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();

        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
        

                $site_url = $this->Model_Covid19->Get_Covid_web_emp($result[0]["user_ad_code"]);

                $data = array(  'site_url' => $site_url ,   );
    
                $this->load->view('Covid19/Covid_ifram_view',$data); 

            
    
        }else{

            if($liff_id == $this->liff_id_covid_emp ){
                $data = array( 'liff_id' => $liff_id, 'text_status' => "Covid19_not_login" );
                $this->load->view('login_success_view',$data);

            
            }else{
                $data = array( 'liff_id' => $liff_id, 'text_status' => "" );
                $this->load->view('login_success_view',$data);
            }
          
        }
    }

    public function Covid19_User_vaccine($user_ad_code){
 
       
        $result = $this->Model_Covid19->Get_vaccine_with_user_ad_code($user_ad_code);  
        $data['data'] = $result;

     
   
        if($data['data'] != null){

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
    
            $datenow = date("Y-m-d");

            $date_second = explode("/", $data['data']['second']);
            $date_second = date("Y-m-d", strtotime( $date_second[2]."-".$date_second[1]."-".$date_second[0]));
            
            if($datenow <=  $date_second){
                $this->load->view('Covid19/Covid_vaccine_view',$data); 
            }


           
        }
        
    
    }

    public function Get_Covid19_User_vaccine($user_ad_code){
 
       
        $result = $this->Model_Covid19->Get_vaccine_with_user_ad_code($user_ad_code);  
        $data['data'] = $result;

     
        if($data['data'] != null){

    
            $datenow = date("Y-m-d");

            $date_second = explode("/", $data['data']['second']);
            $date_second = date("Y-m-d", strtotime( $date_second[2]."-".$date_second[1]."-".$date_second[0]));
            
            if($datenow <=  $date_second){
                
                $data = array('status' => "false",'result'=> $data);
            }else{

                $data = array('status' => "false",'result'=> "null");
            
            }
           
        }else{
            $data = array('status' => "false",'result'=> "null");
        }  
    
        echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }


    public function Covid19_admid_form(){

        // line://app/1655109480-2XKglnaX?liff.state=Covid19_admid_form
        $this->Login_Line("Covid19_admid_form_view",$this->liff_id_covid_19);
    }

    public function Covid19_admid_form_view(){

        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
     
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  

        if(json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) != "[]"){
            $user_ad_code = $result[0]["user_ad_code"];
            $site_url =  "https://change.toat.co.th/covid19/index.php/result/index_by_pass/".$user_ad_code;

            $data = array(  'site_url' => $site_url ,   );
        
            $this->load->view('Covid19/Covid_ifram_view',$data); 

        

        }else{

       
            $data = array( 'liff_id' =>$this->liff_id_covid_19 , 'text_status' => "Covid19_not_login" );
            $this->load->view('login_success_view',$data);

    
        }


    }

    public function UserDoctorAppointmentStart($user_ad_code){
         // line://app/1655109480-2XKglnaX?liff.state=UserDoctorAppointmentStart/003599

         $data = array( 
            'site_url' => "Covid19/UserDoctorAppointmentStartView/".$user_ad_code ,
            'liff_id' => $this->liff_id_covid_19,
        );
 
        $this->load->view('login_check_view', $data); 
    }


    public function UserDoctorAppointmentStartView($user_ad_code){
        $user_line_uid["user_line_uid"] = $this->input->post('user_line_uid');
  
        $result = $this->Model_User->Get_user_ad_with_line_uid($user_line_uid);  
      
        
        if(sizeof($result) > 0){
            $user_ad_code = $result[0]['user_ad_code'];
            $data['UserDoctorAppointmentStart'] = $this->Model_Covid19->UserDoctorAppointmentStart($user_ad_code);
            $data['user_result'] = $result[0];
            $this->load->view('Covid19/Hosben_Userdoctor_appointment_view',$data);
           
        }else{
            $data = array( 'liff_id' =>$this->liff_id_covid_19 , 'text_status' => "ProfileDetail_not_login" );
            $this->load->view('login_success_view',$data);
        }
     
    }

    
}
?>  