<?php
/**
 * Created by PhpStorm.
 * User: msi
 * Date: 11/27/2019
 * Time: 10:42 PM
 */
require_once 'DAL/Db.php';
function getAllPosition($deviceId){
    $query='select * from position where deviceId='.$deviceId;
    return LoadData($query);
}
function lastrecord($deviceId){
    $query='SELECT * FROM `position` WHERE `deviceId` = '.$deviceId.' ORDER BY `createDate` DESC';
    $data= LoadData($query);
    $result=mysqli_fetch_assoc($data);
    return($result);
}

function TodayTime($deviceid){
    $query = LoadData('SELECT * FROM `position`where date(createdate)="'.date('y-m-d').'"');
//    $result=mysqli_query(mysqli_connect('localhost','root',''),'SELECT * FROM `position` where date(createdate)="'.date('y-m-d').'"');
//   echo(mysqli_num_rows($query));
//    var_dump(mysqli_fetch_assoc($query));
}
