<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    header("location: http://192.168.64.2/CWOne/index.php/UserController/login");
}
?>
<head>
    <title>Admin Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-light navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header col-md-1">
            <a class="navbar-brand" style="color: #ffffff"
               href="<?php echo base_url(); ?>index.php/HomePageController/">MUSICS</a>
        </div>
        <form class="navbar-form navbar-left" id="navBarSearchForm" action="/CWOne/index.php/HomePageController/search"
              method=POST>
            <?php echo form_open(); ?>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name=SEARCHTXT>
                <div class="input-group-btn form-group">
                    <button class="btn btn-default" style="height: 100%;padding: 9px" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </form>
        <ul class="nav navbar-nav col-md-2">
            <li class="active pointer-nav" style="color: #fff"
                onclick="window.location='<?php echo base_url(); ?>index.php/PublicHomePageController/'">
                <?php
                $profilepic = $this->session->userdata['logged_in']['Avatar'];
                echo '<img src="' . $profilepic . '" class="avatar img-circle">'
                ?>
                <?php
                echo $username
                ?>
            </li>
        </ul>
        <!--        <ul class="nav navbar-nav">-->
        <!--            <li class="active"><a href="#" style="color: #ffffff">Home</a></li>-->
        <!--            <li><a href="#" style="color: #ffffff">Page 1</a></li>-->
        <!--            <li><a href="#" style="color: #ffffff">Page 2</a></li>-->
        <!--        </ul>-->
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a style="color: #ffffff"
                                  href="<?php echo base_url(); ?>index.php/UserController/logoutUser">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="row second-body">
    <div class="col-md-2"></div>

    <div class="col-md-8">
        <div style="margin-top: -15px; ">
            <?php
            if (isset($followers)) {
                foreach ($followers as $follower) {
                    echo '<form action="/CWOne/index.php/HomePageController/loadUserPage" method="POST">';
                    echo '<div class="col-md-6 profile-container" style="padding: 20px; margin: 0px 0px 5px 0px">';
                    echo '<div class="col-md-3">';
                    echo '<img src="' . $follower->getUserAvatar() . '" style="height: 60px;width: 60px;border-radius: 100%">';
                    echo '</div>';
                    echo '<div class="col-md-9">';
                    echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;">';
                    echo '<input class="form-control" name=USERNAME value="'. $follower->getUserName() .'" type="hidden" readonly>';
                    echo '<input class="form-control" name=USERID value="'. $follower->getUserId() .'" type="hidden" readonly>';
                    echo '<input class="form-control" style="border-radius: 30px;color: #3b5998;border:1px solid #eee" type="submit" name=USERNAME value="' . $follower->getUserName() . '">';
                    echo '</div>';
                    echo '<div class="col-md-12" style="text-align: center">';
                    echo $follower->getFirstName() . " " . $follower->getLastName();
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</form>';
                }
            }
            ?>
        </div>
    </div>

    <div class="col-md-2">
        <div class="side-skirt affix">
            <div class="followers-btn" style="">
                <p style="text-align: center;padding-top: 5px;">Manage your network</p>
                <hr style="margin-top: 0px"/>
                <div class="col-md-12">
                    <form action="/CWOne/index.php/HomePageController/displayFollowers">
                        <button class="network-buttons" type="submit">Followers</button>
                    </form>
                    <div style="text-align: center">
                        1250
                    </div>
                </div>
                <div class="col-md-12">
                    <hr/>
                    <form action="/CWOne/index.php/HomePageController/displayFollowing">
                        <button class="network-buttons" type="submit">Following</button>
                    </form>
                    <div style="text-align: center">
                        1250
                    </div>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>