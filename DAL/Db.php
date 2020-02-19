<?php
$connection = connectToDb();
function connectToDb()
{
    global $connection;
    if (!isset($connection)) {
        $connection = mysqli_connect('localhost', 'root', '');
        mysqli_select_db($connection, 'radyab');
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_set_charset($connection, 'utf8');
    }
    return $connection;
}

function execQuery($query)
{
    mysqli_query(connectToDb(), $query);
}

function LoadData($query)
{
    $data = mysqli_query(connectToDb(), $query);
    return $data;
}