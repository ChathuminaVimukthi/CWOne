<!DOCTYPE html>
<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    header("location: http://192.168.64.2/CWOne/index.php/UserController/login");
}
?>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/loginPage.css">
</head>
<body class="body-background">
<!--<div>-->
<!--    --><?php
//    if(isset($logout_message)){
//        echo "<script type='text/javascript'>alert('$logout_message');</script>";
//    }
//    ?>
<!--</div>-->
<div class="form-wrapper">
    <div class="headline-login">
        <h1>Welcome to Musics</h1>
        <h3>Login</h3>

    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <form action="/CWOne/index.php/UserController/login" method=POST>
            <?php echo form_open(); ?>
            <div>
                <div class="wrap-input form-group">
                    <input type=text class="input form-control" name=USERNAME placeholder="User Name"
                           value="<?php echo set_value('FIRSTNAME'); ?>">
                    <div style="color: #990000">
                        <?php echo form_error('USERNAME'); ?>
                    </div>
                </div>
                <div class="wrap-input form-group">
                    <input type=password class="input form-control" name=PASSWORD placeholder="Password">
                    <div style="color: #990000">
                        <?php echo form_error('PASSWORD'); ?>
                    </div>
                </div>
                <div class="form-group container-login-form-btn">
                    <button class="login-form-btn" type="submit">
                        Login
                    </button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </form>
        <div>
            <?php
            echo "<div class='error_msg' style='color: #990000'>";
            if (isset($error_message)) {
                echo $error_message;
            }
            ?>
        </div>
        <hr/>
        <div class="container-navigate-btn">
            <button class="navigate-btn" onclick="location.href='/CWOne/index.php/UserController/showRegistration'">
            New User
            </button>
        </div>
    </div>
</div>
</body>
</html>
