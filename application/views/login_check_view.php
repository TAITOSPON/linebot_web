<!DOCTYPE html>
<html>
<head>
<title>Line TOAT</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
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

        <form id="myform" action="<?php echo site_url($site_url); ?>" method="post">

          
            <div class="container">

                <label for="loading"><b>loading</b></label>
                <!-- <label for="uname"><b>ชื่อผู้ใช้งาน</b></label>
                <input type="text" placeholder="กรอกชื่อผู้ใช้งาน" name="user" required>
                
                <label for="psw"><b>รหัสผ่าน</b></label>
                <input type="password" placeholder="กรอกรหัสผ่าน" name="pass" required> -->
        
                <input type="hidden" id="user_line_uid" name="user_line_uid" >
                <input type="hidden" id="user_line_name" name="user_line_name" >
                <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >
                <!-- <input type="text" id="user_line_uid" name="user_line_uid" >
                <input type="text" id="user_line_name" name="user_line_name" >
                <input type="text" id="user_line_pic_url" name="user_line_pic_url" > -->
                
                <!-- <button type="submit" >เข้าสู่ระบบ</button> -->
                <!-- <button id="btnLogOut" onclick="logOut()">Log Out line</button>  -->

            </div>

      
            <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
            <script>

                function logIn(){  liff.login({ redirectUri: window.location.href })  }


                function logOut(){
                    liff.logout() 
                    window.location.reload()
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
                        document.getElementById("myform").submit();
                    }
        
                } 

                async function main() {
                    var liff_id="<?php echo $liff_id;?>";
                    var site_url="<?php echo $site_url;?>";

                    await liff.init({ liffId: liff_id })

                        if(liff.isInClient()){
                            getUserProfile()
                        }else{
                            if(site_url == "TimeAt/time_at_select_month" ){
                                window.open("https://change.toat.co.th/timeatt/","_blank");
                                window.close(); 
                            }else if(site_url == "Logout/Confirm_logout"){
                                window.alert("กรุณาออกจากระบบผ่าน Line mobile เท่านั้น");
                                window.close(); 
                            }else if(site_url == "Login/Check_login"){
                                window.alert("กรุณาเข้าสู่ระบบผ่าน Line mobile เท่านั้น");
                                window.close(); 
                            }else if(site_url == "TimeStamp/TimeStamp"){
                                window.alert("กรุณาเข้าทำรายการ Line mobile เท่านั้น");
                                window.close(); 
                            }else if(site_url == "HelpCenter/Help"){
                                window.alert("กรุณาเข้าทำรายการ Line mobile เท่านั้น");
                                window.close(); 
                            }else if(site_url == "Covid19/Covid19_emp_form" ||site_url == "Covid19/Covid19_boss_form" ){
                                window.open("https://change.toat.co.th/covid19/index.php/","_blank");
                                window.close(); 
                            }else{
                                if(liff.isLoggedIn()) {
                                    getUserProfile()
                                }else{
                                    logIn()
                                }
                            }
                            
                        }
                }
                main()
              
      
            </script>
        </form>
    </body>
</html>
