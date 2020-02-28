<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
require_once 'DAL/Db.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            background-color: #ccc;
            margin: 0px;
            pading = 0px;
        }

        h1 {
            font-family: tahoma;
            color: #eee;
            text-align: center;
            text-shadow: 2px 2px 2px #777;
        }

        input[type="text"], [type="password"] {
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 90%;
            height: 40px;
            margin: 10px;
            direction: rtl;
            padding: 0px 15px;
        }

        td {
            text-align: center;
        }

        input[type="submit"] {
            color: #fff;
            background-color: blue;
            border: none;
            padding: 10px 20px;
            box-shadow: 5px 5px 5px #ccc;
            border-radius: 5px;

        }

        .error {
            color: red;
            direction: rtl;
            padding: 10px;
            line-height: 25px;
        }

        .success {
            color: green;
            direction: rtl;
            padding: 10px;
            line-height: 25px;
        }

        .menu {
            height = 40px;
            box-shadow = 6px 0px 6px #666;
            background-color: #fff;
            text-align: right;
            padding-right: 100px;
            padding-top: 10px;
        }

        a {
            text-decoration: none;
            margin-left: 20px;
            color: blue;
            font-size: 20px;
        }

        .btn {
            text-align: center;
            padding-top: 8px;
            display: block;
            width: 200px;
            height: 35px;
            margin: 10px;
            background-color: green;
            color: #fff;
            font-size: 25px;
            margin-right: 400px;
            border-radius: 5px;

        }
    </style>

</head>

<body>
<div class="menu">
    <a href="signup.php">ثبت نام</a>
    <a href="login.php">ورود به سیستم</a>
    <a href="logout.php" title="Logout">خروج از سیستم</a>

</div>

<<<<<<< HEAD
<div style="margin:20px auto;background-color:#fff;border:1px solid #777;box-shadow: 14px 13px 10px #999;padding-bottom:20px;position:absolute;top:60px;bottom:60px;left:0px;right:0px;direction:rtl">
    <table style="border:3px solid #ccc;width:900px;height:150px;margin-top:40px;margin-right:20px;padding:10px;font-size: 25px;">
=======
    <div style="margin:20px auto;background-color:#fff;border:1px solid #777;box-shadow: 14px 13px 10px #999;padding-bottom:20px;position:absolute;top:60px;bottom:60px;left:0px;right:0px;direction:rtl">
        <table style="border:3px solid #ccc;width:900px;height:150px;margin-top:40px;margin-right:20px;padding:10px;font-size: 25px;">
>>>>>>> 18d2229a3d62a79ba992b6a693539e15c65c34b9
        <tr style="font-size: 23px;">
            <th>شماره</th>
            <th>شناسه</th>
            <th>نام دستگاه</th>
            <th>گزارش خارج از محدوده</th>
            <th>گزارش محل فعلی</th>
            <th> گزارش تردد</th>
        </tr>
        <?php
        $query = LoadData('SELECT * FROM `user-device`,device WHERE `user-device`.userid="' . $_SESSION['id'] . '" AND
         `user-device`.deviceid=device.id');
        $i = 0;
        while ($res = mysqli_fetch_assoc($query)) {
            $i++;
            echo '<tr>
<<<<<<< HEAD
                      <td>' . $i . '</td>
                      <td>' . $res['code'] . '</td>
                      <td>' . $res['name'] . '</td>
                      <td><a href="/radyab/mapbox.php?deviceId=' . $res['id'] . '&action=0">گزارش خارج از محدوده</a></td>
                      <td><a href="/radyab/mapbox.php?deviceId=' . $res['id'] . '&action=1">گزارش محل فعلی</a></td>
                      <td><a href="/radyab/mapbox.php?deviceId=' . $res['id'] . '&action=2">گزارش تردد</a></td>
=======
                      <td>'.$i.'</td>
                      <td>'.$res['code'].'</td>
                      <td>'.$res['name'].'</td>
                      <td><a href="/radyab/mapbox.php?deviceId='.$res['id'].'&action=0">گزارش خارج از محدوده</a></td>
                      <td><a href="/radyab/mapbox.php?deviceId='.$res['id'].'&action=1">گزارش محل فعلی</a></td>
                      <td><a href="/radyab/mapbox.php?deviceId='.$res['id'].'&action=2">گزارش تردد</a></td>
>>>>>>> 18d2229a3d62a79ba992b6a693539e15c65c34b9
                  </tr>
            ';
        }

        ?>
    </table>
    <a href="device.php" class="btn">ثبت دستگاه جدید</a>
</div>
</body>
</html>