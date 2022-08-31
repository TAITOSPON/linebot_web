<!DOCTYPE html>
<html>
<head>
<title>รายงานการบันเวลา</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body onload="SetUserDept()">

<h2>รายงานการบันเวลาผ่าน LINE TOAT</h2>
<p>ฝ่ายขาย แยกตามกอง (เฉพาะเดือนมีนาคม-เมษายน 2565)</p>

<div class="container">
  <form action="/action_page.php">


  <div class="row">
    <div class="col-25">
      <label for="dept">หน่วยงาน</label>
    </div>
    <div class="col-75">
        <select name="select_dept" id="select_dept" onchange="SetUserName()">
            <option >เลือกหน่วยงาน</option>
        </select>
    </div>
  </div>




  <div class="row">
    <div class="col-25">
      <label for="emp">ชื่อพนักงาน</label>
    </div>
    <div class="col-75">
      <select id="select_name" name="select_name"  onchange="GetDataLog()">
        <option value=""> กรุณาเลือกหน่วยงานก่อน </option>
  
      </select>
    </div>
  </div>

  <br>
  
  <div class="row">
    <div id="list_log"></div>
  </div>

 

  </form>
</div>

<script>

    var data = [
        {
            "dept":"ผู้บริหาร",
            "detail":[
                {
                    "user_ad_code":"000893",
                    "name":"นายณัฐพงศ์ สุทธารมณ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"000924",
                    "name":"นายสมพร หมอเรือง (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002008",
                    "name":"นางศิริมา บุตรน้อย (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002111",
                    "name":"นางจิตราภรณ์ ท่าไม้สุข (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002321",
                    "name":"นางอุมาภรณ์ ไชยรัตน์ (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"กองบริหารขาย",
            "detail":[
                {
                    "user_ad_code":"001921",
                    "name":"นายพิษณุ เจริญพระ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"000901",
                    "name":"ว่าที่ ร.ตสุกัญญา คุ้มครอง (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002079",
                    "name":"นายเผดิม วรรณะศิลปิน (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002640",
                    "name":"น.ส.ชิดชญา กสิบุตร (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002773",
                    "name":"นายภาวิน คัมภีรญาณนนท์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002784",
                    "name":"นายณรงค์ นราภักดิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002862",
                    "name":"นางพรรณิภา ธีระศรี (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002871",
                    "name":"น.ส.กาญจนา ห่วงสวัสดิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002963",
                    "name":"นายจิรพงศ์ วงษ์กัณหา (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002973",
                    "name":"นายทศพร นุชสา (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003082",
                    "name":"นางมยุรี ศิวาภรณ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003337",
                    "name":"น.ส.รัตนา มยุฤทธิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203537",
                    "name":"น.ส.พันธ์ธิภา พุ่มเพ็ชร์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203677",
                    "name":"นายธนะรัตน์ เทศพานิช (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"300006",
                    "name":"น.ส.รัศมี ฉัตรทอง (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"100521",
                    "name":"นายวรเชษฐ์ ยังให้ผล (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"กองบริหารทั่วไป",
            "detail":[
                {
                    "user_ad_code":"002151",
                    "name":"นายวรวุฒิ บุญคุ้ม (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002707",
                    "name":"น.ส.พรทิมา พุฒนาค (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002796",
                    "name":"น.ส.วรรณชณี ห่วงสวัสดิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002571",
                    "name":"นางศิริลักษณ์ หัสคุณ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002733",
                    "name":"น.ส.นิธิพร วรวิบูลย์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003007",
                    "name":"น.ส.ธัญรวีร์ อัครรุ่งประดิษฐ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003072",
                    "name":"นายชยพศักดิ์ เกิดสนอง (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"300036",
                    "name":"นายไพศาล มะหะหมัด (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"กองปฏิบัติการขาย",
            "detail":[
                {
                    "user_ad_code":"002329",
                    "name":"นายพรเทพ เกตุรามฤทธิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002863",
                    "name":"นายธรรมรัตน์ กุลภวัต (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002890",
                    "name":"นายอัครพันธ์ ไชยสุต (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002631",
                    "name":"นางณัฏฐ์นุดี เสงี่ยมพงษ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002860",
                    "name":"นายภิญโญ แก้วลอยมา (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002895",
                    "name":"นายปริญญา รัชชุศิริ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002942",
                    "name":"นายกรัณฑ์ รัชชะกิตติ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002943",
                    "name":"นายกฤศวัฏ หุ่นสาระ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002985",
                    "name":"นายดำรัส เจริญสวัสดิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002998",
                    "name":"นายธนโชติ แก้ววงกต (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003002",
                    "name":"นายจักรพัชร์ พลเคน (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003209",
                    "name":"นายณัฐพล เพ็งนารีย์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003336",
                    "name":"นายธีวรา การะโชติ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003393",
                    "name":"นายชิงทุน ทองจำรูญ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003406",
                    "name":"นายกัณณ์ วีระกรพานิช (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203481",
                    "name":"นายเจริญ สุขสุศักดิ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203847",
                    "name":"ว่าที่ ร.ตเจตนัตว์ สุขเจริญ (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"กองลูกค้าสัมพันธ์",
            "detail":[
                {
                    "user_ad_code":"002622",
                    "name":"น.ส.รฐา วรปริยกุล (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003035",
                    "name":"น.ส.ชไมพร รื่นเอม (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"000875",
                    "name":"นางสมาพร มณีนิล (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003184",
                    "name":"นายลือชา แก้วพินิจ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003354",
                    "name":"น.ส.รตีรัศมิ์ ธรรมพิทักษ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003403",
                    "name":"นายบัญชา จักร์กร (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203763",
                    "name":"นายคณินณัฐ ช้างน้อย (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"กองวางแผนกลยุท",
            "detail":[
                {
                    "user_ad_code":"003047",
                    "name":"นายชาย ทัศนาญชลี (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"002968",
                    "name":"น.ส.ศรีไพร นาคสนิท (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003038",
                    "name":"น.ส.ขวัญกมล โปสัยะคุปต์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003098",
                    "name":"นายบุรินทร์ วัชรวโรภาส (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003356",
                    "name":"น.ส.รุ่งรัษฎา ลพานุสรณ์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003357",
                    "name":"น.ส.นฤมล ซามงค์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003535",
                    "name":"นายพิสุทธิ์ ศรีเคน (พนักงานรายเดือน)"
                }
            ]
        },
        {
            "dept":"งบน.",
            "detail":[
                {
                    "user_ad_code":"500964",
                    "name":"นายพุทโธ คำประเสริฐ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003340",
                    "name":"นายสุทธิชัย ปันวงค์ (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"003382",
                    "name":"นายพงษ์สิริ ตาวุ่น (พนักงานรายเดือน)"
                },
                {
                    "user_ad_code":"203700",
                    "name":"นางนิตยา อินฟู (พนักงานรายเดือน)"
                }
            ]
        }
    ];

    function SetUserDept(){

        var i = 0;
        while(i < data.length){

            document.getElementById("select_dept").innerHTML = document.getElementById("select_dept").innerHTML + 
            "<option value='"+data[i]["dept"]+"'>"+data[i]["dept"]+"</option>";
            i++;

        }
 
    }

    function SetUserName(){
        // document.getElementById("list_log").style.display = "block";
        document.getElementById("select_name").innerHTML = "";

        var select_dept = document.getElementById("select_dept").value;
        var select_dept_data;


        var i = 0;
        while(i < data.length){

           if(data[i]["dept"] == select_dept ){

                select_dept_data = data[i]['detail'];
               
                var select_dept_data_index = 0;
                while(select_dept_data_index < select_dept_data.length){

                    document.getElementById("select_name").innerHTML = document.getElementById("select_name").innerHTML + 
                    "<option value='"+select_dept_data[select_dept_data_index]["user_ad_code"]+"'>"+select_dept_data[select_dept_data_index]["name"]+"</option>";
                    
                    select_dept_data_index++;

                }


          
           }
           i++;
        }

        // alert(select_dept_data[0]["name"])
       
    }

    function GetDataLog(){
        var select_name = document.getElementById("select_name").value;
       
        var obj_param = '{"user_ad_code" : ""}';
        var obj_param = JSON.parse(obj_param);

         obj_param.user_ad_code = select_name;


        var url = "<?php echo site_url('/Dash/Dash/GetUser'); ?>";
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url);
        xhr.setRequestHeader("Accept", "application/json");
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {

            // alert(xhr.responseText);
            // document.getElementById("list_log").style.display = "none";
            document.getElementById("list_log").innerHTML = xhr.responseText;


        }};

        xhr.send(JSON.stringify(obj_param));
    }

</script>


</body>
</html>


