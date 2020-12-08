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
        <!-- <form action="" method="post"> -->
        <form>
            <div class="container ">
                <p><?php echo $result_user["user_ad_name"]?></p>

                <!-- <label for="uname"><b>*กรุณาระบุวันเริ่มต้น</b></label> -->
                <label for="uname"><b> <?php 
                      $month = "";
                      $json = json_decode($result_detail_time_feed,true);
                      foreach($json as $key => $val) {
                       
                        $month = $json[$key]["MONTH_NAME"];
                      } 
                      echo "เดือน "; print_r($month);
                      ?>
                      
                      </b></label>
                      <br><br>
                <!-- <input  id="select_month" placeholder="เลือกเดือน" class="buttonradius" type="text" onfocus="(this.type='month')" value="<?=date('m-Y')?>" > -->
  
                <!-- <label for="uname"><b>*กรุณาระบุวันสิ้นสุด</b></label>
                <input placeholder="เลือกเดือน" class="buttonradius" type="text" onfocus="(this.type='month')" required> -->
              
                <!-- <button id="bt_submit"  onclick="send_data()" class="buttonradius" >บันทึกใบลา</button> -->

                <table id="table_detail">
                  <tr>
                    <th style="border-top-left-radius: 8px;">วัน-เดือน-ปี</th>
                    <th>เวลาเข้างาน</th>
                    <th style="border-top-right-radius: 8px;">เวลาออกงาน</th>
                    <!-- <th>ชม.ทำงาน</th> -->
                  </tr>

               
                <?php 
                      $json = json_decode($result_detail_time_feed,true);
                      foreach($json as $key => $val) { ?>
                  <tr>
                    <td>
                    <?php echo "$key<br/>";   ?>
                    </td>

                    <td> 
                    <?php print_r( $json[$key]["in_stamp"]);   echo "<br/>";  ?>
                    </td>
                    
                    <td>
                    <?php  print_r( $json[$key]["out_stamp"]);   echo "<br/>"; ?>
                    </td>
                    
                    <!-- <td>
                    <?php  print_r( $json[$key]["time_diff"]);   echo "<br/>"; ?>
                    </td> -->
                              
                  </tr>   
                <?php  } ?>

                </table>



                <input type="hidden" id="user_line_uid" name="user_line_uid" >
                <input type="hidden" id="user_line_name" name="user_line_name" >
                <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >

                <!-- <input type="text" id="user_line_uid" name="user_line_uid" >
                <input type="text" id="user_line_name" name="user_line_name" >
                <input type="text" id="user_line_pic_url" name="user_line_pic_url" > -->
                
                <!-- <button id="bt_submit"  onclick="send_data()" class="buttonradius" >ตกลง</button> -->
        
                    <!-- <button id="btnLogOut" onclick="logOut()">Log Out line</button> -->

            </div>
          

          <!-- <img id="pictureUrl"> -->
         
          
            <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
            <script>
                function send_data() {  
                  // window.alert("กำลังพัฒนา");
                  var monthControl = document.getElementById('select_month').value;
                  window.alert(monthControl);
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
              
                  
                    // liff.sendMessages([{
                    //     type: 'text',
                    //     text: "ลางาน"
                    // }]).then(function () {
                    //     // window.alert("Message sent");
                    //     console.log('message sent');
                    // }).catch(function (error) {
                    //     // window.alert("Error sending message: " + error);
                    //     console.log('error', err);
                    // });
                                  

                  // document.getElementById("pictureUrl").src = profile.pictureUrl           
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
