<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_TimeAt extends CI_Model
{       
    


    public function get_time_feed($user_ad_code){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://change.toat.co.th/timeatt/index.php/api/chk_inout/getfeedtimeByUser');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( array('user_id' => $user_ad_code)) );
        $result = curl_exec($ch);
        curl_close($ch);
        return  $result;
    }

    
    public function get_detail_time_feed($user_ad_code,$date_start,$date_end){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://change.toat.co.th/timeatt/index.php/api/chk_inout/DetailbyDate');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( 
            array(
                'user_id' => $user_ad_code,
                'mnt1' => $date_start,
                'mnt2' => $date_end
            )) 
        );
        $result = curl_exec($ch);
        curl_close($ch);

        // $result = '{
        //     "msg": {
        //         "17-11-2020": {
        //             "DATE_TIME_START": "17-11-2020",
        //             "DAY_OF_MONTH_NUMBER": "17",
        //             "DAY_OF_WEEK_SDESC": "TUE",
        //             "DAY_NAME": "วันอังคาร",
        //             "MONTH_VALUE": "11",
        //             "MONTH_DESC": "November ",
        //             "MONTH_SDESC": "NOV",
        //             "MONTH_BUDGET_VALUE": "02",
        //             "MONTH_NAME": "พ.ย.",
        //             "DAYS_IN_MONTH": "30",
        //             "YEAR_VALUE": "2020",
        //             "YEAR_BUDGET": "2021",
        //             "YEAR_BUDDHA_BUDGET": "2564",
        //             "GBHL_HOL_DATE": null,
        //             "GBHL_HOL_NAME": null,
        //             "Emp_Code": "003599",
        //             "Stamp_Date": "17-11-2020",
        //             "in_stamp": "07:04:30",
        //             "in_location": 28,
        //             "in_channel": "FACE",
        //             "inRR": "1",
        //             "inStatus": "OK",
        //             "in_datetime": "2020-11-17 07:04:30.000",
        //             "out_stamp": "16:13:49",
        //             "out_location": 25,
        //             "out_channel": "FACE",
        //             "outRR": "1",
        //             "outStatus": "Before",
        //             "out_datetime": "2020-11-17 16:13:49.000",
        //             "time_diff": 31429,
        //             "time_diff_h": 7,
        //             "time_diff_m": 43,
        //             "PNPS_PSNL_NO": "003599",
        //             "TRAN_NO": "",
        //             "PNLT_TYPE": "",
        //             "DATE_FROM": "",
        //             "DATE_TO": "",
        //             "TOTAL_LEAVE_DAY": "",
        //             "REMARK": "",
        //             "APPROVE_BY": "",
        //             "LEAVE_DAY_TYPE": "",
        //             "LEAVE_HALF_TYPE": "",
        //             "PNLT_NAME": "",
        //             "rangeDate": "17-11-2020",
        //             "TRAN_STATUS": "",
        //             "cnt": 0
        //         },
        //         "18-11-2020": {
        //             "DATE_TIME_START": "18-11-2020",
        //             "DAY_OF_MONTH_NUMBER": "18",
        //             "DAY_OF_WEEK_SDESC": "WED",
        //             "DAY_NAME": "วันพุธ",
        //             "MONTH_VALUE": "11",
        //             "MONTH_DESC": "November ",
        //             "MONTH_SDESC": "NOV",
        //             "MONTH_BUDGET_VALUE": "02",
        //             "MONTH_NAME": "พ.ย.",
        //             "DAYS_IN_MONTH": "30",
        //             "YEAR_VALUE": "2020",
        //             "YEAR_BUDGET": "2021",
        //             "YEAR_BUDDHA_BUDGET": "2564",
        //             "GBHL_HOL_DATE": null,
        //             "GBHL_HOL_NAME": null,
        //             "Emp_Code": "003599",
        //             "Stamp_Date": "18-11-2020",
        //             "in_stamp": "07:21:18",
        //             "in_location": 25,
        //             "in_channel": "FACE",
        //             "inRR": "1",
        //             "inStatus": "OK",
        //             "in_datetime": "2020-11-18 07:21:18.000",
        //             "out_stamp": "16:15:34",
        //             "out_location": 25,
        //             "out_channel": "FACE",
        //             "outRR": "1",
        //             "outStatus": "OK",
        //             "out_datetime": "2020-11-18 16:15:34.000",
        //             "time_diff": "OK",
        //             "time_diff_h": "8",
        //             "time_diff_m": "00",
        //             "PNPS_PSNL_NO": "003599",
        //             "TRAN_NO": "",
        //             "PNLT_TYPE": "",
        //             "DATE_FROM": "",
        //             "DATE_TO": "",
        //             "TOTAL_LEAVE_DAY": "",
        //             "REMARK": "",
        //             "APPROVE_BY": "",
        //             "LEAVE_DAY_TYPE": "",
        //             "LEAVE_HALF_TYPE": "",
        //             "PNLT_NAME": "",
        //             "rangeDate": "18-11-2020",
        //             "TRAN_STATUS": "",
        //             "cnt": 0
        //         },
        //         "19-11-2020": {
        //             "DATE_TIME_START": "19-11-2020",
        //             "DAY_OF_MONTH_NUMBER": "19",
        //             "DAY_OF_WEEK_SDESC": "THU",
        //             "DAY_NAME": "วันพฤหัสบดี",
        //             "MONTH_VALUE": "11",
        //             "MONTH_DESC": "November ",
        //             "MONTH_SDESC": "NOV",
        //             "MONTH_BUDGET_VALUE": "02",
        //             "MONTH_NAME": "พ.ย.",
        //             "DAYS_IN_MONTH": "30",
        //             "YEAR_VALUE": "2020",
        //             "YEAR_BUDGET": "2021",
        //             "YEAR_BUDDHA_BUDGET": "2564",
        //             "GBHL_HOL_DATE": "19-NOV-20",
        //             "GBHL_HOL_NAME": "วันหยุดปฏิบัติงานของ ยสท.เพิ่มเติมเป็นกรณีพิเศษ",
        //             "Emp_Code": "",
        //             "Stamp_Date": "",
        //             "in_stamp": "",
        //             "in_location": "",
        //             "in_channel": "",
        //             "inRR": "",
        //             "inStatus": "",
        //             "in_datetime": "",
        //             "out_stamp": "",
        //             "out_location": "",
        //             "out_channel": "",
        //             "outRR": "",
        //             "outStatus": "",
        //             "out_datetime": "",
        //             "time_diff": "",
        //             "time_diff_h": "",
        //             "time_diff_m": "",
        //             "PNPS_PSNL_NO": "003599",
        //             "TRAN_NO": "",
        //             "PNLT_TYPE": "",
        //             "DATE_FROM": "",
        //             "DATE_TO": "",
        //             "TOTAL_LEAVE_DAY": "",
        //             "REMARK": "",
        //             "APPROVE_BY": "",
        //             "LEAVE_DAY_TYPE": "",
        //             "LEAVE_HALF_TYPE": "",
        //             "PNLT_NAME": "",
        //             "rangeDate": "19-11-2020",
        //             "TRAN_STATUS": "",
        //             "cnt": 0
        //         },
        //         "20-11-2020": {
        //             "DATE_TIME_START": "20-11-2020",
        //             "DAY_OF_MONTH_NUMBER": "20",
        //             "DAY_OF_WEEK_SDESC": "FRI",
        //             "DAY_NAME": "วันศุกร์",
        //             "MONTH_VALUE": "11",
        //             "MONTH_DESC": "November ",
        //             "MONTH_SDESC": "NOV",
        //             "MONTH_BUDGET_VALUE": "02",
        //             "MONTH_NAME": "พ.ย.",
        //             "DAYS_IN_MONTH": "30",
        //             "YEAR_VALUE": "2020",
        //             "YEAR_BUDGET": "2021",
        //             "YEAR_BUDDHA_BUDGET": "2564",
        //             "GBHL_HOL_DATE": "20-NOV-20",
        //             "GBHL_HOL_NAME": "วันหยุดปฏิบัติงานของ ยสท.เพิ่มเติมเป็นกรณีพิเศษ",
        //             "Emp_Code": "",
        //             "Stamp_Date": "",
        //             "in_stamp": "",
        //             "in_location": "",
        //             "in_channel": "",
        //             "inRR": "",
        //             "inStatus": "",
        //             "in_datetime": "",
        //             "out_stamp": "",
        //             "out_location": "",
        //             "out_channel": "",
        //             "outRR": "",
        //             "outStatus": "",
        //             "out_datetime": "",
        //             "time_diff": "",
        //             "time_diff_h": "",
        //             "time_diff_m": "",
        //             "PNPS_PSNL_NO": "003599",
        //             "TRAN_NO": "",
        //             "PNLT_TYPE": "",
        //             "DATE_FROM": "",
        //             "DATE_TO": "",
        //             "TOTAL_LEAVE_DAY": "",
        //             "REMARK": "",
        //             "APPROVE_BY": "",
        //             "LEAVE_DAY_TYPE": "",
        //             "LEAVE_HALF_TYPE": "",
        //             "PNLT_NAME": "",
        //             "rangeDate": "20-11-2020",
        //             "TRAN_STATUS": "",
        //             "cnt": 0
        //         },
        //         "21-11-2020": {
        //             "DATE_TIME_START": "21-11-2020",
        //             "DAY_OF_MONTH_NUMBER": "21",
        //             "DAY_OF_WEEK_SDESC": "SAT",
        //             "DAY_NAME": "วันเสาร์",
        //             "MONTH_VALUE": "11",
        //             "MONTH_DESC": "November ",
        //             "MONTH_SDESC": "NOV",
        //             "MONTH_BUDGET_VALUE": "02",
        //             "MONTH_NAME": "พ.ย.",
        //             "DAYS_IN_MONTH": "30",
        //             "YEAR_VALUE": "2020",
        //             "YEAR_BUDGET": "2021",
        //             "YEAR_BUDDHA_BUDGET": "2564",
        //             "GBHL_HOL_DATE": null,
        //             "GBHL_HOL_NAME": null,
        //             "Emp_Code": "",
        //             "Stamp_Date": "",
        //             "in_stamp": "",
        //             "in_location": "",
        //             "in_channel": "",
        //             "inRR": "",
        //             "inStatus": "",
        //             "in_datetime": "",
        //             "out_stamp": "",
        //             "out_location": "",
        //             "out_channel": "",
        //             "outRR": "",
        //             "outStatus": "",
        //             "out_datetime": "",
        //             "time_diff": "",
        //             "time_diff_h": "",
        //             "time_diff_m": "",
        //             "PNPS_PSNL_NO": "003599",
        //             "TRAN_NO": "",
        //             "PNLT_TYPE": "",
        //             "DATE_FROM": "",
        //             "DATE_TO": "",
        //             "TOTAL_LEAVE_DAY": "",
        //             "REMARK": "",
        //             "APPROVE_BY": "",
        //             "LEAVE_DAY_TYPE": "",
        //             "LEAVE_HALF_TYPE": "",
        //             "PNLT_NAME": "",
        //             "rangeDate": "21-11-2020",
        //             "TRAN_STATUS": "",
        //             "cnt": 0
        //         }
        //     },
        //     "stat": true
        // }';
        return  $result;
    }

} 