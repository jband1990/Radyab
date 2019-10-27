<?php
//connect to the database
$connection= mysqli_connect('localhost','root','');
mysqli_select_db($connection,'radyab');
//file_get_contents('device/00001.txt');
//file_get_contents('device/00001.txt'));
$list= scandir('device');
unset($list[0]);
unset($list[1]);
//var_dump($list);
//seperate recivied locations
foreach ($list as $file){
    $content=file_get_contents('device/'.$file);
        $listPosition=explode('---',$content);
        //var_dump($content);
    //var_dump($listPosition);
    //die();
    foreach ($listPosition as $index => $position){
        $listPosition [$index]= explode(',',$position);
    }
    var_dump($listPosition);
    die();
}
