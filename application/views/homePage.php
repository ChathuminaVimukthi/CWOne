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
                $profilepic = $this->session->userdata['logged_in']['Avatar'] ;
                echo '<img src="'.$profilepic.'" class="avatar img-circle">'
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
    <div class="col-md-2" style="background: #98bcce;"></div>

    <div class="col-md-8">
        <div class="wrapper-post">
            <form action="/CWOne/index.php/HomePageController/addPost" method=POST>
                <?php echo form_open(); ?>
                <div class="header-post">Create Post</div>
                <div class="body-post form-group">
                    <textarea type=text class="input form-control" style="border: none" name=POSTCONTENT
                              placeholder="What's on your mind, <?php echo $username ?>?"></textarea>
                    <div style="color: #990000">
                        <?php echo form_error('POSTCONTENT'); ?>
                    </div>
                </div>
                <div class="footer-post form-group">
                    <button class="submit-post pull-right" type="submit">Post</button>
                </div>
                <?php echo form_close(); ?>
            </form>
        </div>

        <?php
        if (isset($postsFound)) {
            if (count($postsFound) > 0) {
                foreach ($postsFound as $value) {
                    echo '<div class="posted-content">';
                    echo '<div style="padding:10px 25px 10px 25px">';
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<div class="row">';
                    echo '<div class="col-md-1">';
                    echo '<img src="'.$value->getUserAvatar().'" style="height: 30px;width: 30px;border-radius: 100%">';
                    echo '</div>';
                    echo '<div class="col-md-10" style="font-weight: bold;font-size: medium">';
                    echo $value->getUserName();
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-md-6 pull-right" style="font-size: small">';
                    echo 'Posted on : ';
                    echo $value->getDate();
                    echo '</div>';
                    echo '</div>';
                    echo '<hr/>';
                    $postedContent = $value->getContent();
                    $filterUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    if (preg_match($filterUrl, $postedContent, $url)) {
                        echo preg_replace($filterUrl, "<a href='{$url[0]}'>{$url[0]}</a> ", $postedContent);
                    } else {
                        echo $postedContent;
                    }
                    echo '<hr/>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }

        ?>
    </div>

    <div class="col-md-2">
        <div class="side-skirt affix">
            <div class="followers-btn" style="">
                <p style="text-align: center;padding-top: 5px;">Manage your network</p>
                <hr style="margin-top: 0px"/>
                <div class="col-md-12">
                    <form action="/CWOne/index.php/HomePageController/displayFollowers">
                        <button id="followersBtnHp" class="network-buttons" type="submit">Followers</button>
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