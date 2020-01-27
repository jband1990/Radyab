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
    $query = LoadData('SELECT * FROM `position`WHERE date(createdate)="' . date('y-m-d') . '"');

    $list=array();
    while($res=mysqli_fetch_assoc($query)){
        $list[]=array('lat'=>$res['latitude'],'long'=>$res['longitude']);
        $listAllDetail=$res;
    }
//    var_dump(json_encode($list));
//    return($list);
}

function getPositionByDate($startdate,$enddate){
    $query = LoadData('SELECT * FROM `position`WHERE date(createdate)>="'.$startdate .'" and date(createdate)<= "'.$enddate.'"');
    return $query;
}

function getPositionAsJson ($positions){
    $positionsStr = '';
    $i=0;
    while ($row = mysqli_fetch_assoc($positions)) {
//        { latLng: { lat: 32.62217, lng: 51.66471 }}
        $positionsStr .= '{ latLng: { lat: ' .$row["latitude"].', lng:'.$row["longitude"].'}},';
        $i++;
    }
    $positionsStr ='['.rtrim($positionsStr,',').']';
    return $positionsStr;
}

function getPositionDetailsAsJson ($positions){
    $positionsStr = '';
    $i=0;
    mysqli_data_seek ($positions,0);
    while ($row = mysqli_fetch_assoc($positions)) {
//        { latLng: { lat: 32.62217, lng: 51.66471 }}
        $positionsStr .= '{ createDate:"' .$row["createDate"].'", speed:'.$row["speed"].'},';
        $i++;
    }
    $positionsStr ='['.rtrim($positionsStr,',').']';
    return $positionsStr;
}






