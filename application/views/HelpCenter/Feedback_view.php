<!DOCTYPE html>
<html>
<head>
<title>TOAT | Feedback</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

input[type=submit] {
  background-color: #D39D2B;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
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
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
</head>
<body>


<div class="container">
  <form action="<?php echo site_url($site_url); ?>" method="post">
     
        <textarea id="subject" name="subject" required placeholder="ความคิดเห็นข้อเสนอแนะหรือรายงานปัญหาเกี่ยวกับ LINE OA TOAT..." style="height:300px"></textarea>
        <button type="submit" class="buttonradius" >ส่ง</button>

        <input type="hidden" id="user_ad_code" name="user_ad_code"  value="<?php echo $result_user["user_ad_code"] ?>" >
        
        <input type="hidden" id="os" name="os" >
        <input type="hidden" id="user_line_uid" name="user_line_uid" >
        <input type="hidden" id="user_line_name" name="user_line_name" >
        <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >
    
    <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
          <script>


            function logIn(){  liff.login({ redirectUri: window.location.href })  }

            function logOut(){ liff.logout() }
          
            async function closeWindow() {
                liff.closeWindow()  
                logOut()
            } 

            async function getUserProfile() {
                const profile = await liff.getProfile()
                
                const user_id = profile.userId;
                const name = profile.displayName;
                const user_line_pic_url = profile.pictureUrl;

                const os = liff.getOS()

                if(user_id!=null && name != null){
                    document.getElementById('os').value = os;
                    document.getElementById('user_line_uid').value = user_id;
                    document.getElementById('user_line_name').value = name;
                    document.getElementById('user_line_pic_url').value = user_line_pic_url;
                    // document.getElementById("myform").submit();
                }

            } 


            async function main() {
  
                var liff_id="<?php echo $liff_id;?>";

                await liff.init({ liffId: liff_id })
  
                    if(liff.isInClient()){
                        getUserProfile()
                           
                    }else{
                        window.alert("กรุณาเข้าทำรายการ Line mobile เท่านั้น");
                        window.close();           
                        
                    }
                }

            main()


          </script>
  </form>
</div>

</body>
</html>
