<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
    $userId = ($this->session->userdata['logged_in']['UserId']);
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
    <div class="col-md-2"></div>

    <div class="col-md-8">
        <div class="header-cover">
            <div class="cover-image">
                <div class="col-md-3">
                    <?php
                    if (isset($userData) && isset($friendFlag)) {
                        $profilepic = $userData->getUserAvatar();
                        if ($userData->getUserId() != $userId) {
                            $profileId = $userData->getUserId();
                            $profileUserName = $userData->getUserName();
                            echo "<div class='col-md-12' style=''>";
                            echo "<img src=" . $profilepic . " style='z-index:1;position: absolute' class='profile-pic pull-left'>";
                            switch ($friendFlag) {
                                case 'friends':
                                    echo "<div class='friend-circle'>F</div>";
                                    echo '<div class="unfollow-circle" style="margin-top: 55px" onclick="location.href=\'/CWOne/index.php/ProfileController/unfollowFromProfile?USERID=' . $userId . '&FOLLOWEDID=' . $profileId . '&USERNAME=' . $profileUserName . '\'">';
                                    echo "Unfollow";
                                    echo "</div>";
                                    break;
                                case 'following':
                                    echo '<div class="unfollow-circle" style="margin-top: 105px" onclick="location.href=\'/CWOne/index.php/ProfileController/unfollowFromProfile?USERID=' . $userId . '&FOLLOWEDID=' . $profileId . '&USERNAME=' . $profileUserName . '\'">'.'Unfollow'.'</div>';
                                    break;
                                case 'not-following':
                                    echo '<div class="unfollow-circle" style="margin-top: 105px" onclick="location.href=\'/CWOne/index.php/ProfileController/followFromProfile?USERID=' . $userId . '&FOLLOWEDID=' . $profileId . '&USERNAME=' . $profileUserName . '\'">Follow</div>';
                                    break;
                            }
                            echo "</div>";
                            echo "<div class='col-md-12'>";
                            echo '<h4 class="username-style">';
                            echo $userData->getUserName();
                            echo '</h4>';
                            echo "</div>";
                        } else {
                            echo '<img src="' . $profilepic . '" class="profile-pic">';
                            echo '<h4 class="username-style">';
                            echo $userData->getUserName();
                            echo '</h4>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="navbar navbar-light navbar-cover">
                <ul class="nav navbar-nav navbar-cover-nav">
                    <li class="active" id="timeLineBtn">
                        <a href="#"
                           style="color: #959595">
                            Timeline
                        </a>
                    </li>
                    <li class="active" id="informationBtn"><a href="#" style="color: #959595">Info</a></li>
                </ul>
            </div>
        </div>

        <div class="timeline-body" id="timeLine">
            <?php
            if (isset($postData)) {
                if (count($postData) > 0) {
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
                        echo '<div class="col-md-6" style="font-size: small">';
                        echo '<div class="col-md-11 pull-left">';
                        echo 'Posted on : ';
                        echo $value->getDate();
                        echo '</div>';
                        if ($userId == $userData->getUserId()) {
                            echo '<div class="col-md-1 pull-right">';
                            echo '<div onclick="location.href=\'/CWOne/index.php/ProfileController/deletePost?ID=' . $value->getPostId() . '\'"><i class="fa fa-trash"></i></div>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '<hr/>';
                        $postedContent = $value->getContent();
                        $filterUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                        if (preg_match($filterUrl, $postedContent, $url)) {
                            echo preg_replace($filterUrl, "<a href='$0' target='_blank' rel='noopener noreferrer'>$0</a><br> ", $postedContent);
                            $count=preg_match_all($filterUrl, $value->getContent(), $url);
                            for ($x=0; $x<$count; $x++){

                                $imgTypesArr = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
                                $urlExt = pathinfo($url[0][$x], PATHINFO_EXTENSION);
                                if (in_array($urlExt, $imgTypesArr)) {
                                    echo  "<br><img style='height: 300px;margin-left: auto;margin-right: auto;display: block' src='{$url[0][$x]}'/>";
                                    $img_from_url=true;
                                    break;
                                }
                                else{
                                    $img_from_url=false;
                                }

                            }

                        } else {
                            echo $postedContent;
                        }
                        echo '<hr/>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
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

        <div class="followers-body"
             style="display: none;background: #fff; border-radius: 5px;border: 1px solid #eee;margin-top:-12px"
             id="information">
            <div style="padding:10px 25px 10px 25px">
                <div class="" style="font-weight:bold;font-size: medium">
                    <i class="fa fa-globe pull-left" style="font-size: 25px"></i>
                    <div style="font-size: 18px">User Info</div>
                    <hr/>
                </div>
                <div>
                    <?php
                    if (isset($musicGenre) && isset($userData)) {
                        $firstName = $userData->getFirstName();
                        $lastName = $userData->getLastName();
                        echo '<div>';
                        echo '<i class="fa fa-user-circle-o pull-left" style="font-size: 20px"></i>';
                        echo '<div style="font-size: 15px">' . $firstName . ' ' . $lastName . '</div>';
                        echo '</div>';
                        echo '<br/>';
                        echo '<div>';
                        echo '<i class="fa fa-headphones pull-left" style="font-size: 20px"></i>';
                        echo '<div style="font-size: 15px">Favorite Genres</div>';
                        echo '</div>';
                        echo '<br/>';
                        foreach ($musicGenre as $genre) {
                            echo '<div style="padding-left: 20px">';
                            echo '<i class="fa fa-music pull-left" style="font-size: 20px"></i>';
                            echo '<div style="font-size: 15px">' . $genre . '</div>';
                            echo '</div>';
                            echo '<br/>';
                        }

                        echo '<hr/>';
                    }
                    ?>
                    <div class="" style="font-weight:bold;font-size: medium">
                        <i class="fa fa-users pull-left" style="font-size: 22px"></i>
                        <div style="font-size: 18px">Network Info</div>
                        <hr/>
                    </div>
                    <?php
                    if (isset($followersCount) && isset($followingCount)) {
                        echo '<div>';
                        echo '<i class="fa fa-hand-o-right pull-left" style="font-size: 20px"></i>';
                        echo '<div style="font-size: 15px">Following  ' . $followingCount . '</div>';
                        echo '</div>';
                        echo '<br>';
                        echo '<div>';
                        echo '<i class="fa fa-hand-o-left pull-left" style="font-size: 20px"></i>';
                        echo '<div style="font-size: 15px">Followers  ' . $followersCount . '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-2"
    ">
</div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#timeLineBtn").click(function () {
            $("#information").css("display", "none");
            $("#timeLine").css("display", "block");
        });

        $("#informationBtn").click(function () {
            $("#information").css("display", "block");
            $("#timeLine").css("display", "none");
        });
    });
</script>
</body>
</html>