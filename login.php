<?php
    session_start();
     require_once 'DAL/Db.php';
     if (isset($_POST['submit'])) {
         $query = LoadData('SELECT * FROM user WHERE Username="' . $_POST['Username'] . '" AND password="' . $_POST['password'] . '"');
         if (isset($query) && mysqli_num_rows($query) > 0) {
             $result = mysqli_fetch_assoc($query);
             session_start();
             $_SESSION['id'] = $result['id'];
             header('location:dashboard.php');

         } else {

             $error = 'نام کاربری یا کلمه عبور شما اشتباه می باشد';
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
            font-size: 25px;
        }
    </style>

</head>

<body>
<div class="menu">
    <a href="signup.php">ثبت نام</a>
    <a href="login.php">ورود به سیستم</a>
</div>

<form method="post">
    <div style="margin:150px auto;width:400px;background-color:#fff;border:1px solid #777;box-shadow: 14px 13px 10px #999;padding-bottom: 2px">
        <h1>ورود به سیستم</h1>
        <div class="error">
            <?php if (isset($error)) echo $error ?>
        </div>
        <table width="100%">
            <tr>
                <td><input type="text" placeholder="نام کاربری" name="Username"
                           value="<?php if (isset($_POST['Username'])) echo $_POST['Username'] ?>"></td>
            </tr>
            <tr>
                <td><input type="password" placeholder="کلمه ی عبور" name="password"></td>
            </tr>
            <td>
                <input type="submit" value="ورود" name="submit">
            </td>
            </tr>

        </table>

    </div>
</form>
</body>
</html>