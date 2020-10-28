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
  background-color: #D39D2B;
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

       

        <form id="myform" action="" method="post">
     
            <div class="container">
            
                <label> <?php  $data = json_decode($Leave_select_year_detail, true); echo $data["result"]["user"]["user_ad_name"];?></label>   
                <p></p>

                <label for="psw"><b>ข้อมูลสรุปโดยรวม ประจำปี <?php echo $leave_year_select; ?> </b></label>
                <p></p>
                <label for="psw"><b> <?php echo $Leave_select_year_detail; ?></b></label>
                

            
            </div>
         
        </form>
    </body>
</html>
