<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    redirect("UserController/login");
}
?>
<head>
    <title>Home Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php include('util/header.php'); ?>

<div class="row second-body">
    <div class="col-md-2" style="position: fixed; width: 16%">
        <?php include('util/profileCard.php'); ?>
        <br>
        <?php
        if(isset($recentFollowers) && count($recentFollowers) > 0){
            include('util/recentFollowersCard.php');
        }
        ?>
    </div>

    <div class="col-md-8" style="margin-left: 16%">
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
                    echo '<div style="cursor: pointer" onclick="location.href=\'/CWOne/index.php/ProfileController/loadUserPage?USERID='.$value->getUserId().'&USERNAME='.$value->getUserName().'\'">';
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
                    $filterUrl = "~https?://(?![^\" ]*(?:jpg|png|gif))[^\" ]+~";
                    $filterAll = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    $imageUrlFilter = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+(\/\S*)?\.(?:jpg|jpeg|gif|png|JPG|JPEG|PNG|GIF)/";
                    if (preg_match($filterUrl, $value->getContent(), $url)) {
                        echo preg_replace($filterAll, "", $postedContent);
                        echo "<a href='{$url[0]}' target='_blank' rel='noopener noreferrer'>{$url[0]}</a> ";
                        if (preg_match($imageUrlFilter,$value->getContent(), $url)) {
                            echo  "<img style='height: 300px;margin-left: auto;margin-right: auto;display: block' src='{$url[0]}'/>";
                        }
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

    <div class="col-md-2" style="position: fixed;margin-left: 84%">
        <?php include('util/networkManagerCard.php'); ?>
        <br>
        <div class="side-skirt" style="display: block;margin: auto;">
            <div style="background-image: url('https://specials-images.forbesimg.com/imageserve/5d72899544f2b2000803dadc/960x0.jpg'); height: 400px">
                <div class="col-md-12" style="font-weight: bold;background: rgba(58,58,58,0.6);color: #fff;height: 400px">
                    <div style="">
                        <div style="text-align: center;font-size: 25px;padding-top: 10px">Summer Party</div>
                        <div style="text-align: left;font-size: 15px;padding: 10px">Dec 17' Sat</div>
                        <div style="text-align: left;font-size: 15px;padding: 10px">Mt.Lavinia</div>
                        <div style="text-align: center;font-size: 15px;padding: 10px">with</div>
                        <div style="text-align: center;font-size: 25px;padding-top: 10px">Best DJs</div>
                        <div style="text-align: center;font-size: 25px;padding-top: 10px;margin-top: 79%">077123456</div>
                    </div>
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