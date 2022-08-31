<!DOCTYPE html>
<html>
<head>

<title>TOAT | ใบนัด รพ. สวนเบญจกิติฯ</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,500;1,300;1,400&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Kanit', sans-serif;
        background-color: white;
    }

    * {
    box-sizing: border-box;
    }

    /* Add padding to containers */
    .container {
    padding: 16px;
    background-color: white;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] ,input[type=number] ,input[type=tel]{
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus ,input[type=number]:focus ,input[type=tel]:focus{
    background-color: #ddd;
    outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
    }

    /* Set a style for the submit button */
    .registerbtn {
    background-color: #3e77af;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    }

    .registerbtn:hover {
    opacity: 1;
    }

    /* Add a blue text color to links */
    a {
    color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
    background-color: #f1f1f1;
    text-align: center;
    }

    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid white;
    background-color: #d9ebce
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){
        background-color: #d9ebce
    }

 

</style>
</head>
<body>
<?php
    // echo "<pre>".print_r($UserDoctorAppointmentStart,true)."</pre>";
    // echo "<pre>".print_r($user_result,true)."</pre>";



?>
<form action="">
    <div class="container">
        <img src="https://webhook.toat.co.th/linebot/web/src/hos_1.jpg" width="100%" height="10%" >
        <h3 style="color: #1DB446"><?php echo 'ใบนัด รพ. สวนเบญจกิติฯ' ?></h3>
        <p><?php echo "HN : ".$UserDoctorAppointmentStart[0]['HN'] ?><br><?php echo $user_result['user_ad_name']?></p> 
        <hr>

        
           
        <table>
            <?php 
                $month_name = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
                
                for($i=0; $i<sizeof( $UserDoctorAppointmentStart); $i++){  
                    $AppointDateTime    = $UserDoctorAppointmentStart[$i]['AppointDateTime'];
                    $date_time_str      = explode(' ',$AppointDateTime);
                    $date               = $date_time_str[0];
                    $date               = explode('-',$date);
                    $year    = $date[0];
                    $month   = $date[1];
                    $day     = $date[2];


                    $thai_year = intval($year) + 543;
                    $time_str = $date_time_str[1];
                    $time_str = explode(':',$time_str);
                    $time_str = strval(strval($time_str[0]).":".strval($time_str[1]));
                
                    $AppointDateTime = strval(strval($day)." ".strval($month_name[intval($month)-1])." ".strval($thai_year));

                    $ClinicName         = $UserDoctorAppointmentStart[$i]['ClinicCode']." ".$UserDoctorAppointmentStart[$i]['ClinicName'];
                    $DocName            = $UserDoctorAppointmentStart[$i]['DocName'];
                    $DocName = explode('\\',$DocName);
                    $DocName = $DocName[1].$DocName[0];
            
            ?>
                <tr>
                    
                        <td>
                            
                            <div >
                            
                                <p>
                                    วันที่นัด : <?php echo $AppointDateTime." เวลา ".strval($time_str)." น."?><br>
                                    คลีนิค : <?php echo $ClinicName ?><br>
                                    แพทย์ : <?php echo $DocName ?><br>
                                
                                </p>
                             
                            </div>
                            <hr style = " border: 0.5px solid white; margin-bottom: 0px;">
                        </td>
          
                    
            
                  

                    
                </tr>
        
            
            <?php } ?>
        </table>

    
        <br>

    </div>
        

        <div hidden class="container signin">
            <p>สหกรณ์ออมทรัพย์พนักงานยาสูบจำกัด จำกัด.</p>
            <p>Copyright © 2022</p>

        </div>
</form>

<!-- Modal -->
<div class="modal fade" id="ModelAlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แจ้งเตือน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="text_alert"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="registerbtn" data-dismiss="modal">ตกลง</button>
      </div>
    </div>
  </div>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  

<script>

   

   
</script>
 
       
</body>
</html>
