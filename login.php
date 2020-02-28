<?php
    session_start();
     require_once 'DAL/Db.php';
if (isset($_POST['submit'])) {
    $password = md5($_POST['password']);
    $query = LoadData("SELECT * FROM user WHERE Username='" . $_POST['Username'] . "' AND password='$password'");
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="contents/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="contents/css/util.css">
    <link rel="stylesheet" type="text/css" href="contents/css/main.css?a=22">
    <!--===============================================================================================-->
</head>
<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-43">
                        خداوکیلی تو منو امتحان کن
                        <?php if (isset($error)) echo $error ?>

					</span>

                <div style="text-align: right" class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="Username">
                    <span class="focus-input100"></span>
                    <span style="padding-right: 15px;font-family:'B Nazanin';font-weight:bold;" class="label-input100">نام کاربری</span>
                </div>


                <div style="text-align: right" class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                    <span style="padding-right:15px;font-family:'B Nazanin';font-weight:bold;" class="label-input100">رمز عبور</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label style="font-family:'B Nazanin';font-weight:bold;font-size: 18px;" class="label-checkbox100" for="ckb1">
                               مرا به خاطر بسپار
                        </label>
                    </div>

                    <div>
                        <a style="font-family:'B Nazanin';font-weight:bold;font-size: 18px;padding-right: 15px;" href="RetrieveAccount.php" class="txt1">
                              فراموشی رمز عبور
                        </a>
                    </div>
                </div>


                <div class="container-login100-form-btn">
                    <input style="font-family:'B Nazanin';font-weight:bold;font-size: 22px" type="submit" value="ورود" class="login100-form-btn" name="submit">
                    </input>
                </div>
                <div class="container-login100-form-btn">
                    <a style="font-family:'B Nazanin';font-weight:bold;font-size: 18px;margin-top:10px;font-size: 20px" href="signup.php" class="login100-form-btn">ثبت نام
                    </a>
                </div>

                <div class="text-center p-t-46 p-b-20">
						<span class="txt2">
						</span>
                </div>

                <div class="login100-form-social flex-c-m">
                    <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                        <i class="fa fa-facebook-f" aria-hidden="true"></i>
                    </a>

                    <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('contents/images/bg-01.jpg');">
            </div>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="contents/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="contents/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="contents/vendor/bootstrap/js/popper.js"></script>
<script src="contents/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="contents/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="contents/vendor/daterangepicker/moment.min.js"></script>
<script src="contents/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="contents/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="contents/js/main.js"></script>

</body>
</html>







<!--        <table width="100%">-->
<!--            <tr>-->
<!--                <td><input type="text" placeholder="نام کاربری" name="Username"-->
<!--                           value="--><?php //if (isset($_POST['Username'])) echo $_POST['Username'] ?><!--"></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td><input type="password" placeholder="کلمه ی عبور" name="password"></td>-->
<!--            </tr>-->
<!--            <td>-->
<!--                <input type="submit" value="ورود" name="submit">-->
<!--            </td>-->
<!--            </tr>-->
<!---->
<!--        </table>-->


