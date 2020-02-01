<?php
    //phpinfo();
    //connect to the database
    $connection= mysqli_connect('localhost','root','');
    mysqli_select_db($connection,'radyab');
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //file_get_contents('device/00001.txt');
    //file_get_contents('device/00001.txt'));
    $list= scandir('device');
    unset($list[0]);
    unset($list[1]);
    //seperate recivied locations
    foreach ($list as $file){
        $fileExpolde=explode('.',$file);
        $query = mysqli_query($connection,'select * from device where code='.$fileExpolde[0]);
        $device = mysqli_fetch_assoc($query);
        if(!$device){
            mysqli_query($connection,"INSERT INTO `device` (
                         `id`,
                        `code`
                           )
                    VALUES(
                      NULL,'".$fileExpolde[0]."');");
          $device['id'] = mysqli_insert_id($connection);
        }

        //var_dump($device);
        //(pathinfo($file, PATHINFO_FILENAME));
        $content=file_get_contents('device/'.$file);
        $listPosition=explode('---',$content);

        //var_dump($fileExpolde);
        var_dump($listPosition);
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
            var_dump($result[1]);
            //change lat & lang to google coordination
            $longitude = substr($listPosition[$index][1],0,2)+substr($listPosition[$index][1],2,6)/60;
            $latitude = substr($listPosition[$index][2],0,2)+substr($listPosition[$index][2],2,6)/60;
            var_dump(round($longitude,5));
            var_dump(round($latitude,5));


            mysqli_query($connection, "INSERT INTO `position`(
                `deviceId`,
                `longitude`,
                `latitude`,
                `speed`,
                `createDate`
        )
        VALUES (
           '".$device['id']."','".round($longitude,5)."','".round($latitude,5)."','" . $listPosition[$index][7] . "','" . $date . "');
            ");
        }
        unlink('device/'.$file);
        //var_dump($listPosition);
        //die();
    }
