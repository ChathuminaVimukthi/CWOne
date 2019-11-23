<!DOCTYPE html>
<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    redirect("UserController/login");
}
?>
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/loginPage.css">
</head>
<body class="body-background">
<div class="form-wrapper">
    <div class="headline-login">
        <h1>Welcome to Musics</h1>
        <h3>Registration</h3>
    </div>
    <div class="col-md-12">
        <form action="/CWOne/index.php/UserController/register" method=POST>
            <?php echo form_open(); ?>
            <div>
                <div class="col-md-6">
                    <div class="wrap-input form-group">
                        <input type=text class="input form-control" name=USERNAME placeholder="User Name"
                               value="<?php echo set_value('USERNAME'); ?>">
                        <div style="color: #990000">
                            <?php
                            echo form_error('USERNAME');
                            if (isset($error_message)) {
                                echo $error_message;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="wrap-input form-group">
                        <input type=password class="input form-control" name=PASSWORD placeholder="Password">
                        <div style="color: #990000">
                            <?php echo form_error('PASSWORD'); ?>
                        </div>
                    </div>
                    <div class="wrap-input form-group">
                        <input type=password class="input form-control" name=CONFIRMPASSWORD
                               placeholder="Confirm Password">
                        <div style="color: #990000">
                            <?php echo form_error('CONFIRMPASSWORD'); ?>
                        </div>
                    </div>
                    <div class="wrap-input form-group">
                        <input type=text class="input form-control" name=IMAGEURL
                               placeholder="Profile Image URL"  value="<?php echo set_value('IMAGEURL'); ?>">
                        <div style="color: #990000">
                            <?php echo form_error('IMAGEURL'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="wrap-input form-group">
                        <input type=text class="input form-control" name=FIRSTNAME placeholder="First Name"
                               value="<?php echo set_value('FIRSTNAME'); ?>">
                        <div style="color: #990000">
                            <?php echo form_error('FIRSTNAME'); ?>
                        </div>
                    </div>
                    <div class="wrap-input form-group">
                        <input type=text class="input form-control" name=LASTNAME placeholder="Last Name"
                               value="<?php echo set_value('LASTNAME'); ?>">
                        <div style="color: #990000">
                            <?php echo form_error('LASTNAME'); ?>
                        </div>
                    </div>
                    <div class="wrap-input form-group">
                        <label>Select your favorite music genre </label>
                        <select id="company" class="form-control">
                            <?php
                            foreach ($musicGenre as $value){
                                echo '<option value="'.$value->getId().'">';
                                echo $value->getGenre();
                                echo '</option>';
                            }
                            ?>

                        </select>
                        <div style="color: #990000">
                            <?php echo form_error('CITY'); ?>
                        </div>
                    </div>
                </div>


            </div>
            <div class="form-group container-login-form-btn">
                <button class="login-form-btn" style="width: 50%" type="submit">
                    Register
                </button>
            </div>
            <?php echo form_close(); ?>
        </form>
        <hr/>
        <div class="container-navigate-btn">
            <button class="navigate-btn" style="width: 50%"
                    onclick="location.href='/CWOne/index.php/UserController/showLogin'">
                Login
            </button>
        </div>
    </div>
</div>
</body>
</html>
