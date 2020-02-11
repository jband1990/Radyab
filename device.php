<?php
    session_start();
    if (!isset($_SESSION['id'])) {
    header('location:login.php');
                                  }
    require_once 'DAL/Db.php';
    if (isset($_POST['submit'])) {
    $query = LoadData('SELECT * FROM `device` WHERE code="' . $_POST['code'] . '"');
    if (mysqli_num_rows($query) > 0) {
        $res = mysqli_fetch_assoc($query);
        $deviceId = $res['id'];
    } else {
        execQuery("INSERT INTO `device` (`id`, `code`, `name`)
             VALUES 
                  (NULL,'" . $_POST['code'] . "', '" . $_POST['name'] . "');");
    }
    $deviceId = mysqli_insert_id(connectToDb());
    $query = LoadData('SELECT * FROM `User-device` WHERE UserId="' . $_SESSION['id'] . '" AND deviceId="' . $deviceId . '"');
    if (mysqli_num_rows($query) > 0) {
        $success = 'این شناسه قبلا برای شما ثبت شده است';
    } else {
        execQuery("INSERT INTO `user-device`(
            `userId`, `deviceId`
            ) 
            VALUES (
                   '" . $_SESSION['id'] . "','" . $deviceId . "'
                   );");
        $success = 'دستگاه مورد نظر با موفقیت ثبت شد';
    }
}
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
            margin-right: 230px;
            border-radius: 5px;

        }
    </style>
    <script type="text/javascript">
        function isvalid(e) {
            var errormessage = '';
            var code = document.getElementById('txtcode');
            var name = document.getElementById('txtname');
            if (code.value == '')
                errormessage = 'لطفا کد دستگاه را وارد نمایید \n';

            if (name.value == '')
                errormessage += 'لطفا نام دستگاه را وارد نمایید';

            if (errormessage != '') {
                alert(errormessage);
                e.preventDefault();
                return false;

            }
            return true;
        }

    </script>
 </head>

<body>
<div class="menu">
    <a href="signup.php">ثبت نام</a>
    <a href="login.php">ورود به سیستم</a>
</div>

<div style="margin:20px auto;background-color:#fff;border:1px solid #777;box-shadow: 14px 13px 10px #999;padding-bottom:20px;position:absolute;top:60px;bottom:60px;left:0px;right:0px;direction:rtl">
    <form method="POST" onsubmit="isvalid">
        <table style="border:3px solid #ccc;width:600px;margin-top:40px;margin-right:20px;padding:10px;font-size: 25px;">
            <tr>
                <td class="success"><?php if (isset($success)) echo $success ?></td>
            </tr>
            <tr>
                <td>کد دستگاه</td>
                <td><input type="text" id="txtcode" name="code"</td>
            </tr>
            <tr>
                <td>نام دستگاه</td>
                <td><input type="text" id="txtname" name="name"</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input style="margin-right:250px; font-size:20px;" onclick="isvalid(event)" type="submit"
                           value="ذخیره اطلاعات" name="submit"></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>