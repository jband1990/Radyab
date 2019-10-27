<?php
//file_get_contents('device/00001.txt');
var_dump(file_get_contents('device/00001.txt'));
$list= scandir('device');
unset($list[0]);
unset($list[1]);
var_dump($list);
/**
 * Created by PhpStorm.
 * User: msi
 * Date: 10/25/2019
 * Time: 2:48 PM
 */