<!DOCTYPE html>
<html>
<head>
<title>login linebot system</title>
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


#clock {
  border: 1px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 56px;
  text-align: center;
  padding-top: 40px;
  padding-bottom: 40px;
}

</style>


<style type="text/css">
  /* Set the size of the div element that contains the map */
  #map {
    height: 400px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }
</style>


  </head>
  <body>
    <!-- <form action="" method="post"> -->

      <div class="container ">
        
        <div id="map"></div>
        <br>
        <p><?php echo $ip ?></p> 
        <div id="clock"></div>
        <p><?php echo $result_user["user_ad_name"] ?></p> 
   
        <button class="buttonradius" onclick="logOut()">ลงเวลาเข้างานด้วยตำแหน่งของคุณ</button>
      </div> 

      <!-- <input type="text" id="user_line_uid" name="user_line_uid" >
      <input type="text" id="user_line_name" name="user_line_name" >
      <input type="text" id="user_line_pic_url" name="user_line_pic_url" > -->
                
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMJt2oRKYCBQ7ZO-_kI-EVXV18ko8Dzu0&callback=initMap&libraries=&v=weekly" defer ></script>
      <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
      <script>
        // Initialize and add the map
        function initMap(lat,lng) {
          // The location of latlng

          const latlng = { lat:lat, lng: lng};
          // The map, centered at latlng

          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: latlng,
          });

          // The marker, positioned at latlng
          const marker = new google.maps.Marker({
            position: latlng,
            map: map,
          });
        }

    
        async function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
              // getLocation()
              x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
          initMap(position.coords.latitude,position.coords.longitude)
        }

       


        async function currentTime() {
          var date = new Date(); /* creating object of Date class */
          var hour = date.getHours();
          var min = date.getMinutes();
          var sec = date.getSeconds();
          hour = updateTime(hour);
          min = updateTime(min);
          sec = updateTime(sec);
          document.getElementById("clock").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
            var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
        }

        function updateTime(k) {
          if (k < 10) {
            return "0" + k;
          }
          else {
            return k;
          }
        }

        currentTime(); 


       

       
        function logIn(){  liff.login({ redirectUri: window.location.href })  }


        function logOut(){
           liff.closeWindow()
           liff.logout() 
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
                    // if(liff.isLoggedIn()) {
                    //     getUserProfile()
                    // }else{
                    //     logIn()
                    // }
                    
                    
                }
        }

        main()
        getLocation()

      </script>
    <!-- </form> -->
  </body>
</html>