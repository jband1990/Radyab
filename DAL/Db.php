<?php
/**
 * Created by PhpStorm.
 * User: msi
 * Date: 11/27/2019
 * Time: 10:43 PM
 */
function connectToDb(){
    $connection= mysqli_connect('localhost','root','');
    mysqli_select_db($connection,'radyab');
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    return $connection;
}
function execQuery($query){
    mysqli_query(connectToDb(),$query);
}
function LoadData($query){
    $data = mysqli_query(connectToDb(),$query);
    return $data;
}