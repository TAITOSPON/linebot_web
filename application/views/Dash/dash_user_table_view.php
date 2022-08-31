<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>


    <!-- <p><?php 

        echo "<pre>";
        print_r($data);
        echo "</pre>";

    ?></p> -->

<table id="customers">
            <?php if(isset($data)){ ?>               
                <?php if(sizeof($data) > 0){ ?>
                    <tr>        
                        <th>วัน-เวลา ที่บันทึกเวลา</th>
                        <th>ประเภทการลงเวลา</th>
                        <th>Location</th>
                        <th>IP</th>
                        <th>OS</th>
                        <th>ชื่อ</th>
                        <th>หนาวยงาน</th>
                    
                    </tr>
                    <?php  for($index = 0; $index < sizeof($data); $index++){  ?>
                    
                        <tr>
                            <!-- <td hidden ><?php echo $result[$index]['ls_shop_id']  ?></td> -->
                
                            <td><?php echo $data[$index]['time_stamp_log_datetime']  ?></td>
                            <td><?php echo $data[$index]['time_stamp_log_status_wifi']  ?></td>
                            <?php
                                if($data[$index]['time_stamp_log_lat_lon_url'] =="https://maps.google.com/?q="){
                            ?>
                                <td>ไม่มีข้อมูล</td>
                            <?php 
                                }else{  
                            ?>
                                <td><a href="<?php echo $data[$index]['time_stamp_log_lat_lon_url']  ?>" target="_blank"><?php echo $data[$index]['time_stamp_log_lat_lon']  ?></a></td>
                            <?php  
                                }
                            ?>
                  
                        
                            <td><?php echo $data[$index]['time_stamp_log_ip']  ?></td>
                            <td><?php echo $data[$index]['time_stamp_log_os']  ?></td>
                            <td><?php echo $data[$index]['PersonalName']  ?></td>
                            <td><?php echo $data[$index]['Department']  ?></td>
                        </tr>
                        
                    <?php }  ?>

                <?php }else{ ?>
                    <label>ไม่มีข้อมูล</label><br>
                <?php } ?>
            
            <?php } ?>
                            
</table>

</body>
</html>


