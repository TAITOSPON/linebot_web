<!DOCTYPE html>
<html>
<head>
  <title>TOAT | Timestamp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    .buttonradius {
        background-color: #D39D2B;
        border-radius: 8px;
        width: 100%;
        margin: 8px 0; 
    }

    .buttonradius_wfh {
        background-color: #2C62D4;
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

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
      border-radius: 8px;
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

    #p_alert {
      border: 0px solid #ccc;
      box-sizing: border-box;
      border-radius: 8px;
      /* color: red; */
      font-size: 15px;
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

        <div id="date"></div>
 
        <p><?php echo $result_user["user_ad_name"] ?></p> 
        <!-- <p><?php print_r($result_user); ?></p>  -->

        <input type="hidden" id="timestamp" name="timestamp" >
        <input type="hidden" id="category" name="category"  >
        <input type="hidden" id="user_ad_code" name="user_ad_code"  value="<?php echo $result_user["user_ad_code"] ?>" >
        <input type="hidden" id="ip" name="ip"  value="<?php echo$status_time_stamp['status']['ip'] ?>" >
        <input type="hidden" id="status_wfh" name="status_wfh"  value="<?php echo $status_time_stamp['status']['status_wfh'] ?>" >
        <input type="hidden" id="statuscheck_wifi" name="statuscheck_wifi"  value="<?php  echo $status_time_stamp['status']['statuscheck_wifi']?>" >
        
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
        <button type="submit" id="togglee" class="buttonradius" onclick="HideSubmit();" hidden >บันทึกเวลา</button>
        <!-- <p>คุณกำลังเชื่อมต่อ Wifi <i class="fa fa-wifi" style="font-size:24px;color:green;"></i> ของการยาสูบแห่งประเทศไทย</p> -->
        <div id="p_alert"></div>
        <div id="feed_time"></div>
      
        <img src="https://www.thaitobacco.or.th/p2090.jpg" class="center">
        <!-- <img src="https://webhook.toat.co.th/linebot/web/src/Capture_12-21.PNG" class="center"> -->
        <!-- <img src="https://webhook.toat.co.th/linebot/web/src/Inkedlinerichmessage_fix_11.06.64_LI-.jpg" class="center"> -->
        
      </div> 

      

           
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMJt2oRKYCBQ7ZO-_kI-EVXV18ko8Dzu0&callback=initMap&libraries=&v=weekly" defer ></script>
      <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfOvtvlozbKZ7bzhbRv6Kqj5o9IlzdpUk&callback=initMap&libraries=&v=weekly" defer ></script> -->

      <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
      <script>

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
            switch(error.code) {
              case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
              case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
              case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
              case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
            }
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
            xmlhttp.open("GET", "https://webhook.toat.co.th/linebot/web/index.php/api/Api_TimeStamp/TimeStamp_DataNow", false );
            xmlhttp.send();    
        }

        async function currentTime() {
          var offset = +7;
          var date_thai =  new Date(new Date().getTime() + offset * 3600 * 1000 )
          var Hour = date_thai.getUTCHours();          
          var Min = date_thai.getUTCMinutes(); 
          var Sec = date_thai.getUTCSeconds();

            Hour = updateTime(parseInt(Hour));
            Min = updateTime(parseInt(Min));
            Sec = updateTime(parseInt(Sec));
           
            var date = new Date(); 
            var datestamp = date.toLocaleDateString('th-TH', {
              year: 'numeric',
              month: 'long',
              day: 'numeric',
            })

            var Ymd = "<?php echo date("Y-m-d");?>";
            document.getElementById('clock').innerText = Hour.toString() + " : " + Min.toString() + " : " + Sec.toString() ;
            document.getElementById("date").innerText = datestamp;
            document.getElementById('timestamp').value = Ymd+" "+ Hour.toString() + ":" + Min.toString() + ":" + Sec.toString(); 
            
            document.getElementById("p_").innerText = "ตามเวลาประเทศไทย โดยกรมอุกทกศาสตร์กองทัพเรือและระบบเซอร์เวอร์ของ\nการยาสูบแห่งประเทศไทย";
            var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */

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
            var date_ = date.split( "-" );
            var y = date_[0];
            var m = date_[1];
            var d = date_[2];

            var date_th = new Date(y,m-1,d); 
            var datestamp = date_th.toLocaleDateString('th-TH', {
              year: 'numeric',
              month: 'long',
              day: 'numeric',
              weekday: 'long',
            })

            Hour = updateTime(parseInt(Hour));
            Min = updateTime(parseInt(Min));
            Sec = updateTime(parseInt(Sec));


            document.getElementById('clock').innerText = Hour.toString() + " : " + Min.toString() + " : " + Sec.toString() ;
            document.getElementById("date").innerText = datestamp;
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

            document.getElementById("category").value = category;
            document.getElementById('togglee').hidden = false;
            document.getElementById("p_alert").innerHTML = "<i class='fa fa-wifi' style='font-size:24px;color:#88E742;'></i> คุณกำลังเชื่อมต่อ wifi ของการยาสูบแห่งประเทศไทย ("+category+")";

            if(category == "LINE_WFH"){
                WFH();
            }
       
            

          }else{
            
            WFH();
         
            // NotAllowTimeStamp();

          }
         

         
        }

        function WFH(){
            document.getElementById("category").value = "LINE_WFH";
      
            document.getElementById('togglee').hidden = false;     
            document.getElementById("p_alert").innerHTML = "<i class='fa fa-wifi' style='font-size:24px;color:red;'></i> คุณไม่ได้เชื่อมต่อ wifi ของการยาสูบแห่งประเทศไทย \nระบบจะบันทึกเวลาด้วย Work from home ";
            document.getElementById("togglee").className = "buttonradius_wfh";
            document.getElementById('togglee').innerText = 'บันทึกเวลา (WFH)';
        }

        function NotAllowTimeStamp(){
            document.getElementById('togglee').hidden = true;
            window.alert("กรุณาบันทึกเวลาด้วย wifi ของการยาสูบแห่งประเทศไทย");
            liff.closeWindow()
        }

        function HideSubmit() {
          document.getElementById('togglee').hidden = true;
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


                  // getUserProfile()
                  // CheckStatusTimeStamp();


                if(liff.isInClient()){
                      getUserProfile()
                      CheckStatusTimeStamp();
                }else{
                    window.alert("กรุณาเข้าทำรายการ Line mobile เท่านั้น");
                    window.close();           
                    
                }
        }

        main()
        httpGet()
        // currentTime()
        getLocation()

      </script>
    </form>
  </body>
</html>