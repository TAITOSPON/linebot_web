<!DOCTYPE html>
<html>
<head>
<title>Help center</title>
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

.buttonradius {
  border-radius: 8px;
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

p {
  border: 0px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 20px;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

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
        <form action="<?php echo site_url($site_url); ?>" method="post">
          <div class="container">

                <input type="hidden" id="intent" name="intent" >
                <input type="hidden" id="os" name="os" >
                <input type="hidden" id="user_line_uid" name="user_line_uid" >
                <input type="hidden" id="user_line_name" name="user_line_name" >
                <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >

           
                <button type="submit" class="buttonradius" onclick="Info()">คู่มือการใช้งาน</button>
                <button type="submit" class="buttonradius" onclick="sendfeedback()">รายงานปัญหา , ส่งความคิดเห็นข้อเสนอแนะ</button>

          </div>

          
          <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
          <script>



            
            function Info(){
                document.getElementById('intent').value = "info"
            }

            function sendfeedback(){
                document.getElementById('intent').value = "sendfeedback"
            }


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
                        // window.alert("กรุณาเข้าทำรายการ Line mobile เท่านั้น");
                        window.close();           
                        
                    }
                }

            main()


          </script>
        </form>
    </body>
</html>
