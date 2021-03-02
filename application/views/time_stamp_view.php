<!DOCTYPE html>
<html>
<head>
<title>LINEBOT TIMESTAMP SYSTEM</title>
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
  font-size: 50px;
  text-align: center;
  padding-top: 30px;
  padding-bottom: 30px;
}

#date {
  border: 0px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 20px;
  text-align: center;
  padding-top: 4px;
  padding-bottom: 10px;
}

#p_ {
  border: 0px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 10px;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}


#latlon {
  border: 0px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 10px;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}


#feed_time {
  border: 0px solid #ccc;
  box-sizing: border-box;
  border-radius: 8px;
  font-size: 15px;
  text-align: center;
  padding-top: 10px;
  padding-bottom: 10px;
}


</style>


<style type="text/css">
  /* Set the size of the div element that contains the map */
  #map {
    height: 300px;
    /* The height is 400 pixels */
    width: 100%;
    /* The width is the width of the web page */
  }
</style>


  </head>
  <body>
    <!-- <form action="" method="post"> -->
    <form action="<?php echo site_url($site_url); ?>" method="post">
      <div class="container ">
        <!-- <p>ตามเวลาประเทศไทย โดยกรมอุกทกศาสตร์กองทัพเรือและระบบเซอร์เวอร์ของการยาสูบแห่งประเทศไทย</p>  -->
        <div id="date"></div>
 
        <p><?php echo $result_user["user_ad_name"] ?></p> 

        <input type="hidden" id="timestamp" name="timestamp" >
        <input type="hidden" id="category" name="category" value="<?php echo $status_time_stamp['status']['category'] ?>" >
        <input type="hidden" id="user_ad_code" name="user_ad_code"  value="<?php echo $result_user["user_ad_code"] ?>" >
        <input type="hidden" id="ip" name="ip"  value="<?php echo$status_time_stamp['status']['ip'] ?>" >

        <input type="hidden" id="latlong" name="latlong" >
        <input type="hidden" id="os" name="os" >

        <input type="hidden" id="user_line_uid" name="user_line_uid" >
        <input type="hidden" id="user_line_name" name="user_line_name" >
        <input type="hidden" id="user_line_pic_url" name="user_line_pic_url" >

        <!-- <div id="map"></div> -->
        <br>
        <!-- <p><?php echo $status_time_stamp['ip'] ?></p>  -->
      
        <div id="clock"></div>
        <div id="p_"></div>
        <div id="latlon"></div>
        <button type="submit" id="togglee" class="buttonradius" >บันทึกเวลา</button>
        <div id="feed_time"></div>
       
      </div> 

    
                
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
              // navigator.geolocation.getCurrentPosition(showPosition);

              navigator.geolocation.getCurrentPosition(showPosition, error, options);
            } else { 
              // getLocation()
              x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
          
          // document.getElementById('latlon').innerText = "latlng : "+position.coords.latitude+" , "+position.coords.longitude;
          document.getElementById('latlong').value = position.coords.latitude+","+position.coords.longitude; 
  

          initMap(position.coords.latitude,position.coords.longitude)
        }

        function error(err) {
          console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        async function httpGet(){
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    
                    var date = xmlhttp.responseText.split( ":" );
                    var Hour = date[0];
                    var Min = date[1];
                    var Sec = date[2];
                    var Ymd = date[3];
                    var date = date[4];
                  
                    RunTime(Hour,Min,Sec,Ymd,date);
                 
                    
                }
            }
            xmlhttp.open("GET", "https://webhook.toat.co.th/linebot/webhook/datenow", false );
            xmlhttp.send();    
        }

        function RunTime(Hour,Min,Sec,Ymd,date){
     

            Sec = parseInt(Sec) + 1;
            if(parseInt(Sec) == 60){
                Sec = 0;
                Min = parseInt(Min) + 1;
                if(parseInt(Min) == 60){
                    Min  = 0;
                    Hour = parseInt(Hour) + 1;
                    if(parseInt(Hour) == 24){
                        Hour = 0;
                        Min  = 0;
                        Sec  = 0;
                       
                    }
                }
            }

            Hour = updateTime(Hour);
            Min = updateTime(Min);
            Sec = updateTime(Sec);


            document.getElementById('clock').innerText = Hour.toString() + " : " + Min.toString() + " : " + Sec.toString() ;
            document.getElementById("date").innerText = date;
            document.getElementById('timestamp').value = Ymd+" "+ Hour.toString() + ":" + Min.toString() + ":" + Sec.toString(); 
            
            document.getElementById("p_").innerText = "ตามเวลาประเทศไทย โดยกรมอุกทกศาสตร์กองทัพเรือและระบบเซอร์เวอร์ของ\nการยาสูบแห่งประเทศไทย";
            
            setTimeout(function() {RunTime(Hour,Min,Sec,Ymd,date) }, 1000);

        }


        function updateTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

    
        async function CheckStatusTimeStamp() {
          var status = "<?php  echo $status_time_stamp['status']['statuscheck_wifi']?>";
          var feed_time = "<?php echo $status_time_stamp['status']['feed_time'] ?>";
          var category = "<?php echo $status_time_stamp['status']['category'] ?>";

          document.getElementById("feed_time").innerHTML = feed_time;

          if(status == "true"){
            document.getElementById('togglee').style.visibility = 'visible';
            if(category == "LINE_WFH"){
                document.getElementById('togglee').innerText = 'บันทึกเวลา (WFH)';
            }
       
          }else{
            document.getElementById('togglee').style.visibility = 'hidden';
            window.alert("กรุณาบันทึกเวลาด้วย wifi ของการยาสูบแห่งประเทศไทย");
            liff.closeWindow()
          }
         

         
        }

        
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
                      CheckStatusTimeStamp();
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
        httpGet()
        getLocation()

      </script>
    </form>
  </body>
</html>