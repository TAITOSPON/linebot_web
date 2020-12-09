<!DOCTYPE html>
<html>
<head>
<title>รายละเอียดเวลาเข้า-ออกงาน</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password],input[type=number],input[type=date] ,input[type=month] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  background-color: #FFFFFF;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #D39D2B;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

.buttonradius {
    border-radius: 8px;
    width: 100%;
    margin: 8px 0; 
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #D39D2B;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.selectfull {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 8px;
    color: #FFFFFF;
    background-color: #D39D2B;
    border-color: #fff transparent transparent transparent;
}
table {
  border: 1px solid #ccc;
  border-radius: 8px;
  width: 100%;
}

.table_hide {
  border: 0px solid #FFFFFF;
  border-radius: 8px;
  width: 100%;
}

th {
  text-align: center;
  background-color: #D39D2B;  
  color: white;
  
}

td {
  text-align: center;
  padding: 2px;

}

tr:nth-child(even) {background-color: #f2f2f2;}

p {
  text-align: center;
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  background-color: #FFFFFF;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

</head>
    <body>
    
        <form action="<?php echo site_url("TimeAt/time_at_select_month"); ?>" method="post">
            <div class="container ">
                <p><?php echo $result_user["user_ad_name"]?></p>
    

                <input placeholder="<?php 
                        $month;
                        foreach($result_detail_time_feed as $key => $val) {
                          $month["month"] = $key;

                        } 
                    
                        $date = getDate(strtotime($month["month"]));  
                        print_r ($date["month"]." ".$date["year"]);?>
                        "id="select_month" class="buttonradius" type="month" required>


                <button id="bt_" onclick="send_data()"  class="buttonradius" >ค้นหา</button>
                        
                <label for="month"><b><?php 
                        $month;
                        foreach($result_detail_time_feed as $key => $val) {
                          $month["month"] = $key;

                        } 
                    
                        $date = getDate(strtotime($month["month"]));  
                        print_r ($date["month"]." ".$date["year"]);?></b>
                </label>
                

                <table id="table_detail">
                    <tr>
                        <th style="border-top-left-radius: 8px;">วัน-เดือน-ปี</th>
                        <th>เวลาเข้างาน</th>
                        <th style="border-top-right-radius: 8px;">เวลาออกงาน</th>
                    </tr>

             

               
                <?php foreach($result_detail_time_feed as $key => $val) { 
                        if($result_detail_time_feed[$key]["DAY_OF_WEEK_SDESC"] == "SAT" 
                        || $result_detail_time_feed[$key]["DAY_OF_WEEK_SDESC"] == "SUN"){?>


                    <tr style="background-color: #F9C4B8">
                    
                        <td><?php echo $key;?></td>
                        <td colspan="2" style='font-size:30%'> <?php print_r($result_detail_time_feed[$key]["DAY_NAME"]);?></td>

                    </tr> 
                  
                    
                <?php }else if($result_detail_time_feed[$key]["GBHL_HOL_NAME"] != ""){  ?>

                    <tr style="background-color: #C1F57F">

                        <td><?php echo $key;   ?></td>
                        <td colspan="2" style='font-size:30%'><?php print_r($result_detail_time_feed[$key]["GBHL_HOL_NAME"]);?></td>
                
                    </tr> 



                <?php }else{  ?>

                    <tr>
                            
                        <td><?php echo $key;?></td>
                        <td><?php print_r($result_detail_time_feed[$key]["in_stamp"]);?></td>
                        <td><?php print_r( $result_detail_time_feed[$key]["out_stamp"]);?></td>
                                
                    </tr> 
                
                <?php  }
                    }?>

                </table>
              



                <input type="hidden" id="user_line_uid" name="user_line_uid" >
                <input type="hidden" id="user_line_name" name="user_line_name" >
                <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >
                <input type="hidden" id="month_select" name="month_select" >

                <!-- <input type="text" id="user_line_uid" name="user_line_uid" >
                <input type="text" id="user_line_name" name="user_line_name" >
                <input type="text" id="user_line_pic_url" name="user_line_pic_url" >
                <input type="text" id="month_select" name="month_select" > -->
                                
                                    
                <!-- <button id="btnLogOut" onclick="logOut()">Log Out line</button> -->

            </div>
          
         
          
            <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
            <script type="text/javascript"> 
                function preventBack() {
                  window.history.forward();
                }  
                setTimeout("preventBack()", 0);  
                window.onunload = function () {null};
            </script>
            <script>
                function send_data() {  
                  var monthControl = document.getElementById('select_month').value;
                  document.getElementById('month_select').value = monthControl;
                }



                function logOut(){
                    liff.logout() 
                    window.location.reload()
                }

                function logIn(){ 
                    liff.login({ redirectUri: window.location.href }) 
                }

                function CloseWindow(){
                    liff.closeWindow()
                }

                async function getUserProfile() {
                    const profile = await liff.getProfile()
                    
                    const user_id = profile.userId;
                    const name = profile.displayName;
                    const user_line_pic_url = profile.pictureUrl;

                    if(user_id!=null && name != null){
                        document.getElementById('user_line_uid').value = user_id;
                        document.getElementById('user_line_name').value = name;
                        document.getElementById('user_line_pic_url').value = user_line_pic_url;
                    }
              
                } 


                async function main() {
           
                    var liff_id="<?php echo $liff_id;?>";
                    await liff.init({ liffId: liff_id })
                    
                    if(liff.isInClient()){

                        getUserProfile()

                    }else{

                        if(liff.isLoggedIn()) {
                            getUserProfile()
                        }else{
                            logIn()
                        }
                    }
                }
              main()
              
            </script>
        </form>
    </body>
</html>
