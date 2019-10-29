<?php
//phpinfo();
//connect to the database
$connection= mysqli_connect('localhost','root','');
mysqli_select_db($connection,'radyab');
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
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
    foreach ($listPosition as $index => $position) {


        // print ($position);
        $listPosition [$index] = explode(',', $position);
        //print_r ($listPosition[$index]);
        //print ("<br/>");
        //seprate date and time with preg_match

        preg_match('/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/', $listPosition [$index][4], $result);
        //print_r($result);
        $date = $result[1] . '-' . $result[2] . '-' . $result[3] . ' ' . $result[4] . ':' . $result[5] . ':' . $result[6];
        // die();

        mysqli_query($connection, "INSERT INTO `position`(

            `longitude`,
            `latitiude`,
            `speed`,
            `createDate`
    )
    VALUES (
        '" . $listPosition[$index][1] . "','" . $listPosition[$index][2] . "','" . $listPosition[$index][7] . "','" . $date . "');
        ");
    }

    //var_dump($listPosition);
    //die();
}
