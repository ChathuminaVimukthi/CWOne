<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    header("location: http://192.168.64.2/CWOne/index.php/UserController/login");
}
?>
<head>
    <title>Musics</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <img src="<?php echo $this->session->userdata['logged_in']['Avatar'] ?>" class="avatar img-circle">
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
        <div class="header-cover">
            <div class="cover-image">
                <div class="col-md-3">
                    <?php
                    $profilepic = $this->session->userdata['logged_in']['Avatar'] ;
                    echo '<img src="'.$profilepic.'" class="profile-pic">'
                    ?>
                    <h4 class="username-style">
                        <?php
                        echo $username;
                        ?>
                    </h4>
                </div>
                <div class="col-md-9">
                    User Infor
                </div>
            </div>
            <div class="navbar navbar-light navbar-cover">
                <ul class="nav navbar-nav navbar-cover-nav">
                    <li class="active" id="timeLineBtn">
                        <a href="<?php echo base_url(); ?>index.php/PublicHomePageController/displayPosts"
                           style="color: #959595">
                            Timeline
                        </a>
                    </li>
                    <li class="active" id="followingBtn"><a href="#" style="color: #959595">Following</a></li>
                    <li class="active" id="followersBtn"><a href="#" style="color: #959595">Followers</a></li>
                </ul>
            </div>
        </div>

        <div class="timeline-body" id="timeLine">
            <?php
            if ($postsFound == 0) {
                echo '<div class="wrapper-post" style="margin-top: 5px">';
                echo '<form action="/CWOne/index.php/HomePageController/addPost" method=POST>';
                echo '<?php echo form_open(); ?>';
                echo '<div class="header-post">Create Post</div>';
                echo '<div class="body-post form-group">';
                echo '<textarea type=text class="input form-control" style="border: none" name=POSTCONTENT 
                    placeholder="You have not posted anything :| ...Post something...">';
                echo '</textarea>';
                echo '</div>';
                echo '<div class="footer-post form-group">';
                echo '<button class="submit-post pull-right" type="submit">Post</button>';
                echo '</div>';
                echo '<?php echo form_close(); ?>';
                echo '</form>';
                echo '</div>';
            } else {
                if (count($postsFound) > 0) {
                    foreach ($postsFound as $value) {
                        echo '<div class="posted-content">';
                        echo '<div style="padding:10px 25px 10px 25px">';
                        echo '<div class="row">';
                        echo '<div class="col-md-6">';
                        echo '<div class="row">';
                        echo '<div class="col-md-1">';
                        $profilepic = $this->session->userdata['logged_in']['Avatar'] ;
                        echo '<img src="'.$profilepic.'" style="height: 30px;width: 30px;border-radius: 100%">';
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
                } else {
                    echo 'No posts available';
                }
            }
            ?>
        </div>

        <div class="followers-body" id="followers" style="display: none">
            <div class="posted-content">

            </div>
        </div>

        <div class="followers-body" id="following" style="height: 300px;background: #91991b; display: none">

        </div>

    </div>

    <div class="col-md-2" style="background: #98bcce;"></div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#timeLineBtn").click(function () {
            $("#followers").css("display", "none");
            $("#following").css("display", "none");
            $("#timeLine").css("display", "block");
        });

        $("#followingBtn").click(function () {
            $("#followers").css("display", "none");
            $("#following").css("display", "block");
            $("#timeLine").css("display", "none");
        });

        $("#followersBtn").click(function () {
            $("#followers").css("display", "block");
            $("#following").css("display", "none");
            $("#timeLine").css("display", "none");
        });
    });
</script>
</body>
</html>