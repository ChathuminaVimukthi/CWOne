<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    redirect("UserController/login");
}
?>
<head>
    <title>Musics</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php include('util/header.php'); ?>

<div class="row second-body">
    <div class="col-md-2" style="background: #98bcce;"></div>

    <div class="col-md-8">
        <div class="header-cover">
            <div class="cover-image">
                <div class="col-md-3">
                    <?php
                    if(isset($userData)){
                        $profilepic = $userData->getUserAvatar();
                        echo '<img src="' . $profilepic . '" class="profile-pic">';
                        echo '<h4 class="username-style">';
                        echo $userData->getUserName();
                        echo '</h4>';
                    }
                    ?>
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
            if (isset($postData)) {
                if(count($postData) > 0){
                    foreach ($postData as $value) {
                        echo '<div class="posted-content">';
                        echo '<div style="padding:10px 25px 10px 25px">';
                        echo '<div class="row">';
                        echo '<div class="col-md-6">';
                        echo '<div class="row">';
                        echo '<div class="col-md-1">';
                        $profilepic = $userData->getUserAvatar();
                        echo '<img src="' . $profilepic . '" style="height: 30px;width: 30px;border-radius: 100%">';
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
                }else{
                    echo '<div class="posted-content">';
                    echo '<div style="padding:10px 25px 10px 25px">';
                    echo '<textarea type=text style="border: none" 
                    placeholder="User has not posted anything !">';
                    echo '</textarea>';
                    echo '</div>';
                    echo '</div>';
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
</body>
</html>