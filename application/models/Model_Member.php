
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Member extends CI_Model
{       


    public function Get_Member_TOAT($user_ad_code,$page){

        $key_token = "cUnmuaxBg9VPqp3QaQJFRdysyejLsyKu";

        // https://memberapp.toat.co.th/memberttm_test/invisiblelogin?id=003599&pin=cUnmuaxBg9VPqp3QaQJFRdysyejLsyKu&gopage=$page
        $membertoat = 'https://memberapp.toat.co.th/memberttm/invisiblelogin?id='.$user_ad_code.'&pin='.$key_token.'&gopage='.$page;
        return $membertoat ; 

    }

    
    public function template_gen(){
        $data = array(
            'menu_left' => $this->menu_left(),   
        );
        return $data;
    }

    
    public function menu_left(){

        $ProfileDetail = "";
        $Training = "";

        // echo base_url('index.php/Member/ProfileDetail'); exit();
        // echo ($this->uri->segment(2) ); exit();

        if($this->uri->segment(2) == "ProfileDetail" ){
            $ProfileDetail = "menu-item-active";
        }else if($this->uri->segment(2) == "Training" ){
            $Training = "menu-item-active";
        }




        return '
     
        
        <style>
        .sidenav {
          height: 100%;
          width: 0;
          position: fixed;
          z-index: 1;
          top: 0;
          left: 0;
          overflow-x: hidden;
          transition: 0.2s;
          background-color:#efebc2;
          
        }
        
        
        
        @media screen and (max-height: 450px) {
          .sidenav {padding-top: 15px;}
          .sidenav a {font-size: 18px;}
        }
        </style>
        
        
        
        <!--begin::Header Mobile-->
        <div id="kt_header_mobile" class="header-mobile align-items-center" style="margin-bottom: 4%; ">
            <!--begin::Logo-->
            <a>
                <img alt="Logo" class="w-200px" src="'.base_url("src/toat-member-logo.png").'" />
            </a>
            <!--end::Logo-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Aside Mobile Toggle-->
                <button class="btn p-0 icon-2x flaticon2-soft-icons" id="kt_aside_mobile_toggle" onclick="openNav()">
                    <span ></span>
                </button>
                <!--end::Aside Mobile Toggle-->
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Header Mobile-->
        
        
        
        <div id="mySidenav"  class="sidenav">
            <div class="flex-column-fluid" id="kt_aside_menu_wrapper" style="margin: 100px 0px 0px -2px;">
                    <!--begin::Menu Container-->
                    <div class="aside-menu my-4" id="kt_aside_menu" >
                        <!--begin::Menu Nav-->
                        <ul class="menu-nav">
                            <li class="menu-item '.$ProfileDetail.'">
                                <a href="'.base_url('index.php/Member/Login_Line/ProfileDetail').'" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-user"></i>
                                    <span class="menu-text">ประวัติส่วนตัว</span>
                                </a>
                            </li>
                            <li class="menu-item '.$Training.'">
                                <a href="'.base_url('index.php/Member/Login_Line/Training').'" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-checking"></i>
                                    <span class="menu-text">ข้อมูลการฝึกอบรม</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-calendar-9"></i>
                                    <span class="menu-text">ข้อมูลการลา</span>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-list"></i>
                                    <span class="menu-text">เงินทุนสงเคราะห์</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-line-chart"></i>
                                    <span class="menu-text">คะแนนประเมินผล</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-architecture-and-city"></i>
                                    <span class="menu-text">สหกรณ์ฯ ยาสูบ</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon2-protection"></i>
                                    <span class="menu-text">กองทุนสำรองเลี้ยงชีพ</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#" onclick="closeNav()" class="menu-link">
                                    <i class="menu-icon flaticon-doc"></i>
                                    <span class="menu-text">ข้อมูลลดหย่อนภาษี</span>
                                </a>
                            </li>
                           
                        </ul>
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                    </div>
                
          
        </div>
        
        
        <script>
        var status_nav = "nav_close";

        function openNav() {
            if(status_nav != "nav_open"){
                document.getElementById("mySidenav").style.width = "300px";
                status_nav = "nav_open";
            
            }else{
                document.getElementById("mySidenav").style.width = "0";
                status_nav = "nav_close";
            }
            
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
        }
        </script>
           
        
        ';                    
    }

  
    public function GetProfile($user_ad_code){

        $data = array( 
            'status' => false ,
            'result' => "error"
        );

        try {

            $ImagePersonal = "https://memberapp.toat.co.th/memberttm/ImagePersonal.aspx?id=".$user_ad_code;
            $data["ImagePersonal"] = $ImagePersonal;

            $personal = "https://memberapp.toat.co.th/memberapi/api/personalapi?id=".$user_ad_code;
            $data["personal"] = json_decode(file_get_contents($personal));
    
            $education = "https://memberapp.toat.co.th/memberapi/api/educationapi?id=".$user_ad_code;
            $data["education"] = json_decode(file_get_contents($education));
    
            $child = "https://memberapp.toat.co.th/memberapi/api/childapi?id=".$user_ad_code;
            $data["child"] = json_decode(file_get_contents($child));
    
            $decoration = "https://memberapp.toat.co.th/memberapi/api/decorationapi?id=".$user_ad_code;
            $data["decoration"] = json_decode(file_get_contents($decoration));
    
            $upgradeposition = "https://memberapp.toat.co.th/memberapi/api/upgradepositionapi?id=".$user_ad_code;
            $data["upgradeposition"] = json_decode(file_get_contents($upgradeposition));
    
            $upgradesalary = "https://memberapp.toat.co.th/memberapi/api/upgradesalaryapi?id=".$user_ad_code;
            $data["upgradesalary"] = json_decode(file_get_contents($upgradesalary));
    
            $upgradesalarydocid = "https://memberapp.toat.co.th/memberapi/api/upgradesalarydocidapi?id=".$user_ad_code;
            $data["upgradesalarydocid"] = json_decode(file_get_contents($upgradesalarydocid));
    
    
    
            $result = array( 
                'ImagePersonal' => $data["ImagePersonal"],
                'personal' => $data["personal"] ,
                'education' =>  $data["education"],
                'child' => $data["child"],
                'decoration' => $data["decoration"],
                'upgradeposition' => $data["upgradeposition"],
                'upgradesalary' => $data["upgradesalary"],
                'upgradesalarydocid' => $data["upgradesalarydocid"],
    
            );

            $data = array( 
                'status' => true ,
                'result' => $result
            );
          
        } catch (Error $err) {
            $data = array( 
                'status' => true ,
                'result' => "error"
            );
        } 
    
        return $data;
   
    }


    // public function GetTrainingbyYear($user_ad_code,$year){

    //     $data = array( 
    //         'status' => false ,
    //         'result' => "error"
    //     );

    //     if($user_ad_code != ""){
    //         try {

    //             $personal = "https://memberapp.toat.co.th/memberapi/api/trainingapi?id=".$user_ad_code."&year=".$year;
    //             $data["training"] = json_decode(file_get_contents($personal));
        
            
    //             $result = array( 
    //                 'training' => $data["training"],
        
    //             );

    //             $data = array( 
    //                 'status' => true ,
    //                 'result' => $result
    //             );
            
    //         } catch (Error $err) {
    //             $data = array( 
    //                 'status' => true ,
    //                 'result' => "error"
    //             );
    //         } 
    //     }
        
    
    //     return $data;
   
    // }


  
} 