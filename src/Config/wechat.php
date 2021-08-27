<?php
return [
    'attendance' => env('ATTENDANCE_TEMPL', 'OPENTM412135843'), //考勤打卡通知模板编号
    'consumer' => env('CONSUMER_TEMPL','OPENTM417749300'),   //消费后通知模板编号
    'visitor_apply' =>  env('APPLY_TEMPL','OPENTM417830400'),    //访客申请通知模板编号
    'visitor_ahead' =>  env('AUDIT_TEMPL','OPENTM418190904') //访客预约审核提醒
];
