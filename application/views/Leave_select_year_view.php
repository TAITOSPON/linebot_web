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
  background-color: #d3af04;
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
  background-color: #d3af04;
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

.text_right {
    text-align:right;
}

.right{
    float:right;
}

.left{
    float:left;
}


.selectbox {
  background-color: #d3af04;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  /* width: 30%; */
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

        <form id="myform" action="<?php echo site_url('Leave/Leave_select_year_detail'); ?>" method="post">
            
        

            <div class="container">

                <label  id="user_ad_name"></label>   
                <p></p>
                <label for="psw"><b>ปีงบประมาณ</b></label>

                <!-- <select onchange="SetData()|this.form.submit()" name="select_leave_year" id="select_leave_year" class="selectbox"> -->
                
                <select onchange="SetData()" name="select_leave_year" id="select_leave_year" class="selectbox buttonradius">

                    <?PHP for ($i = 0; $i < sizeof($leave_year); $i++) {?> 
                            <option value=<?PHP echo $leave_year[$i]["Value"];?>> <?PHP echo $leave_year[$i]["Value"];?></option>
                    <?PHP }?>

                </select>
                
            ​
                <input type="hidden" id="Leave_select_year_detail" name="Leave_select_year_detail" >
                <input type="hidden" id="user_line_uid" name="user_line_uid" >
                <input type="hidden" id="user_ad_code" name="user_ad_code" >
                <input type="hidden" id="leave_year_select" name="leave_year_select" >


                <!-- <input type="text" id="data" name="data" >
                <input type="text" id="user_line_uid" name="user_line_uid" >
                <input type="text" id="user_ad_code" name="user_ad_code" >
                <input type="text" id="leave_year_select" name="leave_year_select" > -->

               
                <p></p>
                <label>จำนวนวันลาพักร้อนที่โอนมาจากปีที่แล้ว </label>
                <label id="SumLeaveYear"></label>
                <label>วัน</label>
                <p></p>

                <label>จำนวนวันลาพักร้อนในปีนี้ </label>
                <label id="TotalLeave"></label>
                <label>วัน</label>
                <p></p>

                <label>จำนวนวันลาพักร้อนคงเหลือ</label>
                <label id="TotalLeaveAvailable"></label>
                <label>วัน</label>
                <p></p>

             
               <!-- <button type="submit" >เข้าสู่ระบบ</button> -->
                <button type="submit" id="btndetail" class="buttonradius" >ดูข้อมูลโดยรวม</button> 

          


            </div>
         

            <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
            <script>


                async function liff_logout() {

                    var liff_id="<?php echo $liff_id;?>";
                    await liff.init({ liffId: liff_id }) 
                      if(liff.isInClient()){
                          liff.logout() 
                      }else{

                          if(liff.isLoggedIn()) {
                              liff.logout() 
                          }
                      }
                }



                async function SetData() {
              
                    const api_Leave_year = "<?php echo site_url('api/Api_Leave/Leave_year'); ?>";
                    const user_line_uid = "<?php echo $user_line_uid;?>";
                    const user_ad_code = "<?php echo $user_ad_code;?>";
                    const leave_year_select = document.getElementById("select_leave_year").value;

                    document.getElementById('user_line_uid').value = user_line_uid;
                    document.getElementById('user_ad_code').value = user_ad_code;
                    document.getElementById('leave_year_select').value = leave_year_select;

                    var http = new XMLHttpRequest();
                    var url = api_Leave_year;
                    var params = 'user_line_uid='+user_line_uid+'&user_ad_code='+user_ad_code+'&leave_year='+leave_year_select;
                    http.open('POST', url, true);

                    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    http.onreadystatechange = function() {
                        if(http.readyState == 4 && http.status == 200) {
                            // alert(http.responseText);

                            // var myArr = JSON.parse(this.responseText);
                            // document.getElementById("SumLeaveYear").innerHTML = myArr["status"];
                           
                            document.getElementById("Leave_select_year_detail").value = this.responseText;
                            
                            var json = JSON.parse(this.responseText);           
                            document.getElementById("user_ad_name").innerHTML = json.result.user.user_ad_name;

                            document.getElementById("SumLeaveYear").innerHTML = json.result.leave_head.SumLeaveYear;
                            document.getElementById("TotalLeave").innerHTML = json.result.leave_head.TotalLeave;
                            document.getElementById("TotalLeaveAvailable").innerHTML = json.result.leave_head.TotalLeaveAvailable;
                  
                        }
                    }
                    http.send(params);
                   
                } 

                liff_logout()      
                SetData()
              
           
            </script>
        </form>
    </body>
</html>
