<?php
require_once 'DAL/Db.php';
require_once 'persian_calendar.php';
function getAllPosition($deviceId)
{
    $query = 'SELECT *,Time(createDate) AS `createTime`,date(createDate) AS `createDate` FROM position WHERE deviceId=' . $deviceId;
    return LoadData($query);
}

function lastrecord($deviceId)
{
    $query = 'SELECT  *,Time(createDate) AS
    `createTime`,date(createDate) AS
     `createDate` FROM `position` WHERE `deviceId` = ' . $deviceId . ' ORDER BY `createDate` DESC  limit 1';
    $data = LoadData($query);
    return ($data);
}

function TodayTime($deviceid)
{
    $query = LoadData('SELECT * ,Time(createDate) AS `createTime`,date(createDate) AS
    `createDate` FROM `position` WHERE date(createdate)="' . date('yy-d-m') . '"');
    return ($query);
    $list = array();
    while ($res = mysqli_fetch_assoc($query)) {
        $list[] = array('lat' => $res['latitude'], 'long' => $res['longitude']);
    }
//    var_dump(json_encode($list));
//    return($list);
}

function getPositionByDate($startdate, $enddate)
{
    $query = LoadData('SELECT *,Time(createDate) AS
    `createTime`,date(createDate) AS
     `createDate` FROM `position` WHERE date(createdate)>="' . $startdate . '" AND date(createdate)<= "' . $enddate . '"');
    return $query;
}

function getPositionAsJson($positions)
{
    $positionsStr = '';
    $i = 0;
    while ($row = mysqli_fetch_assoc($positions)) {
//        { latLng: { lat: 32.62217, lng: 51.66471 }}
        $positionsStr .= '{ latLng: { lat: ' . $row["latitude"] . ', lng:' . $row["longitude"] . '}},';
        $i++;
    }
    $positionsStr = '[' . rtrim($positionsStr, ',') . ']';
    return $positionsStr;
}

function getPositionDetailsAsJson($positions)
{

    $positionsStr = '';
    $i = 0;
    mysqli_data_seek($positions, 0);
    while ($row = mysqli_fetch_assoc($positions)) {
//        { latLng: { lat: 32.62217, lng: 51.66471 }}
        $positionsStr .= '{ createDate:"' . getShamsidate($row["createDate"]) . '",createTime:"' . $row["createTime"] . '",speed:' . $row["speed"] . '},';
        $i++;
    }
    $positionsStr = '[' . rtrim($positionsStr, ',') . ']';
    $persian_calendar = null;
    return $positionsStr;
}


function getShamsidate($mdate)
{
    $persian_calendar = new persian_calendar();
    $dateParts = explode('-', $mdate);
    $pdate = $persian_calendar->g2p($dateParts[0], $dateParts[1], $dateParts[2]);
    $persian_calendar = null;
    return $pdate[0] . '/' . $pdate[1] . '/' . $pdate[2];

}





