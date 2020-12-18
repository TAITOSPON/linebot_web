<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Api_Member extends REST_Controller{

       public function index_get(){}

  

       public function Member_User_Profile_Post(){
    
       
              $data = json_decode(file_get_contents('php://input'), true);
              
              $this->load->model('Model_User');
              $result = $this->Model_User->Get_user_ad_with_line_uid($data);  
         
              $user_ad_code = $result[0]["user_ad_code"]; 

              $this->load->model('Model_Member');
              $result = $this->Model_Member->GetProfile($user_ad_code);  
              echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
       }


       public function Member_Training_by_year_Post(){

              $data = json_decode(file_get_contents('php://input'), true);
              // echo json_encode($data,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();
           
              $user_ad_code = $data["user_ad_code"];
              $year = $data["TrainingbyYear"];
              

              $this->load->model('Model_Member');
              $result = $this->Model_Member->GetTrainingbyYear($user_ad_code,$year);  
              // echo json_encode($result,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); exit();
              

              // print_r($result["result"]["training"]); exit();
              if ($result["result"]["training"] != null && $result["result"]["training"][0]->CourseDecsc != ""){

       
                     $index = 0;
                     foreach ($result["result"]["training"] as $value) {     
                     
                            $row = $index+1;

                            echo '<table class="table table-sm table-responsive table-borderless d-flex justify-content-between flex-wrap mt-1">
                                   <tr>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  50px;">'.$row.'</td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  140px;">หัวข้ออบรม</td>
                                          <td colspan="6"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->CourseDecsc.'</b></td>
                                   </tr>
                                   <tr>
                                          <td></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ปีงบประมาณ</td>
                                          <td style="min-width:  150px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->Year.'</b></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ระหว่างวันที่</td>
                                          <td style="min-width:  170px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->StartDate.'</b></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">เวลา</td>
                                          <td style="min-width:  150px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->StartTime.'</b></td>
                                   </tr>
                                   <tr>
                                          <td></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">รุ่นที่</td>
                                          <td style="min-width:  100px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->ClassNo.'</b></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ถึงวันที่</td>
                                          <td style="min-width:  170px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->EndDate.'</b></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  70px;">ถึง</td>
                                          <td style="min-width:  150px;"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->EndTime.'</b></td>
                                   </tr>
                                   <tr>
                                          <td></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">ระยะเวลา</td>
                                          <td colspan="5"><label class="mr-2">:</label>รวมทั้งหมด&nbsp;<b>'.$result["result"]["training"][$index]->PeriodDay.'</b>&nbsp;วัน&nbsp;<b>'.$result["result"]["training"][$index]->PeriodHour.'</b>&nbsp;ชม.</td>
                                   </tr>
                                   <tr>
                                          <td></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">สถานที่อบรม</td>
                                          <td colspan="5"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->Location.'</b></td>
                                   </tr>
                                   <tr>
                                          <td></td>
                                          <td class="text-dark-50 font-weight-bolder" style="min-width:  110px;">อบรมโดย</td>
                                          <td colspan="5"><label class="mr-2">:</label><b>'.$result["result"]["training"][$index]->ArrangedBy.'</b></td>
                                   </tr>
                            </table> ';

                            $index++;
                     }
              }
              
              
       
       }


}
