<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    redirect("UserController/login");
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

<?php include('util/header.php'); ?>

<div class="row second-body">
    <div class="col-md-2">
        <div class="side-skirt" style="margin-left: 15px">
            <?php
            $profilepic = $this->session->userdata['logged_in']['Avatar'];
            echo '<div class="col-md-12" style="text-align: center;padding: 5px;">';
            echo '<img src="' . $profilepic . '" style="height: 150px;width: 150px;border-radius: 100%">';
            echo '</div>';
            $userName = $this->session->userdata['logged_in']['UserName'];
            echo '<hr style="margin-top: 5px !important; margin-bottom: 5px !important;"/>';
            echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;text-align: center;padding: 5px;">';
            echo $userName;
            echo '</div>';
            echo '<hr style="margin-top: 5px !important; margin-bottom: 5px !important;"/>';
            echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;text-align: center;padding: 5px;">';
            echo 'Favorites';
            echo '</div>';
            echo '<div class="col-md-12" style="font-size: medium;text-align: center;padding: 5px;">';
            $musicsTypes = $this->session->userdata['logged_in']['MusicsTypes'];
            foreach ($musicsTypes as $genre){
                echo $genre;
                echo '<br/>';
            }
            echo '</div>';
            ?>
        </div>
        <br>
        <div class="side-skirt" style="height: 100px;margin-left: 15px">

        </div>
    </div>

    <div class="col-md-8">
        <div class="wrapper-post" style="margin-left: 5px">
            <form action="/CWOne/index.php/HomePageController/addPost" method=POST>
                <?php echo form_open(); ?>
                <div class="header-post">Create Post</div>
                <div class="body-post form-group">
                    <textarea type=text class="input form-control" id="postContent" style="border: none" name=POSTCONTENT
                              placeholder="What's on your mind, <?php echo $username ?>?"></textarea>
                    <div style="color: #990000">
                        <?php echo form_error('POSTCONTENT'); ?>
                    </div>
                </div>
                <div class="footer-post form-group">
                    <button disabled class="submit-post pull-right" id="postMe" type="submit">Post</button>
                </div>
                <?php echo form_close(); ?>
            </form>
        </div>

        <?php
        if (isset($postsFound)) {
            if (count($postsFound) > 0) {
                foreach ($postsFound as $value) {
                    echo '<div class="posted-content" style="margin-left: 5px">';
                    echo '<div style="padding:10px 25px 10px 25px">';
                    echo '<div class="row">';
                    echo '<div class="col-md-6">';
                    echo '<div class="row">';
                    echo '<div class="col-md-1">';
                    echo '<img src="' . $value->getUserAvatar() . '" style="height: 30px;width: 30px;border-radius: 100%">';
                    echo '</div>';
                    echo '<div class="col-md-10" style="font-weight: bold;font-size: medium">';
                    echo '<div style="cursor: pointer" onclick="location.href=\'/CWOne/index.php/HomePageController/loadUserPage?USERID='.$value->getUserId().'&USERNAME='.$value->getUserName().'\'">';
                    echo $value->getUserName();
                    echo '</div>';
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
                        echo preg_replace($filterUrl, "<a href='{$url[0]}' target='_blank' rel='noopener noreferrer'>{$url[0]}</a> ", $postedContent);
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
        <div class="side-skirt">
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
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById("postContent").addEventListener("keyup", function() {
        var nameInput = document.getElementById('postContent').value;
        if (nameInput != "") {
            document.getElementById('postMe').removeAttribute("disabled");
            document.getElementById('postMe').style.backgroundColor = "#3b5998";

        } else {
            document.getElementById('postMe').setAttribute("disabled", null);
            document.getElementById('postMe').style.backgroundColor = "#525252";

        }
    });
</script>
</body>
</html>