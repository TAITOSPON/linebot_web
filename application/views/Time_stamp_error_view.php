<!DOCTYPE html>
<html>
<head>
<title>login linebot system</title>
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
      <!-- <form > -->
          <div class="container">
                <p><?php echo $msg ?></p> 
                <button type="submit" class="buttonradius" onclick="SendMessage()" id="togglee">ตรวจสอบเวลา</button>
                <button type="submit" class="buttonradius" onclick="closeWindow()">ปิด</button>
          </div>

          
          <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
          <script>

            function logIn(){  liff.login({ redirectUri: window.location.href })  }

            function logOut(){
                      liff.logout() 
                      // window.location.reload()
            }
          
          async function closeWindow() {
            liff.closeWindow()  
            logOut()
          } 

          async function SendMessage(){

              var text_status="<?php echo $text_status;?>";

              if(text_status == "time_stamp_true"){

                  liff.sendMessages([{
                      type : "text",
                      text : "ตรวจสอบเวลาเข้างาน",
                  }]

                  ).then(function () {
                      // window.alert("Message sent");
                      console.log('message sent');
                      liff.closeWindow()  
                      logOut()
                  }).catch(function (error) {
                      // window.alert("Error sending message: " + error);
                      console.log('error', err);
                      liff.closeWindow()  
                      logOut()
                  });   
              
              }else{
                  liff.closeWindow()  
                  logOut()
              }
              
          }



            async function main() {

                var liff_id="<?php echo $liff_id;?>";
                await liff.init({ liffId: liff_id })
                // await liff.init({ liffId: "1655109480-NdbD97GK" })
                  if(liff.isInClient()){
                      // closeWindow()
                  }else{
                      window.close(); 
                  }


                  var text_status="<?php echo $text_status;?>";


                  if(text_status == "error"  ){
                      document.getElementById('togglee').style.visibility = 'hidden';
                    
                  }else if(text_status == "statuscheck_wifi_false"){
                      document.getElementById('togglee').style.visibility = 'hidden';
                      window.alert("<?php echo $msg ?>");
                      closeWindow()
               
                  }
          
            }
            main()
          </script>
        <!-- </form> -->
    </body>
</html>
