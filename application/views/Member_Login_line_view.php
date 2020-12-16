<!DOCTYPE html>
<html>
<head>
<title>login linebot system</title>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=0.9, maximum-scale=0.9, width=device-width, user-scalable=no" />
<link rel="stylesheet" href="<?PHP echo base_url("assets/style.css"); ?>">


</head>
    <body>
        <?PHP echo $template['menu_left']; ?>
    

        <form id="myform" action="<?php echo site_url($site_url); ?>" method="post">
 
            <div style="text-align: center; font-size: large;" >

                <label for="loading"><b>loading...</b></label>
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
