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
    <title>Admin Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>
<body>

<?php include('util/header.php'); ?>

<div class="row second-body">
    <div class="col-md-2" style="position: fixed; width: 16%">
        <?php include('util/profileCard.php'); ?>
    </div>

    <div class="col-md-8" style="margin-left: 16%">
        <div style="background: #fff; border-radius: 5px;height: 90%">
            <?php
            if (isset($others) && isset($followers)) {
                if(count($followers) == 0 && count($others) == 0){
                    echo '<p style="padding: 15px 15px 0 15px;font-size: 20px;margin: 0 !important;text-align: center">';
                    echo "No users found !";
                    echo "</p>";
                }else{
                    echo '<p style="padding: 15px 15px 0 15px;font-size: 20px;margin: 0 !important;">Following</p>';
                    foreach ($followers as $follower) {
                        echo '<div class="col-md-6" style="padding-top: 15px">';
                        echo '<div class="col-md-12 profile-container" style="padding: 15px">';
                        echo '<div class="col-md-3">';
                        echo '<img src="' . $follower->getUserAvatar() . '" style="height: 60px;width: 60px;border-radius: 100%">';
                        echo '</div>';
                        echo '<div class="col-md-9">';
                        echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;">';
                        echo '<div style="cursor: pointer" onclick="location.href=\'/CWOne/index.php/ProfileController/loadUserPage?USERID='.$follower->getUserId().'&USERNAME='.$follower->getUserName().'\'">';
                        echo $follower->getUserName();
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-12" style="text-align: left">';
                        echo $follower->getFirstName() . " " . $follower->getLastName();
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    echo '<hr style="background: #fff"/>';
                    echo '<p style="padding: 15px 15px 0 15px;font-size: 20px;margin: 0 !important;">Others</p>';
                    foreach ($others as $follower) {
                        echo '<div class="col-md-6" style="padding-top: 15px;">';
                        echo '<div class="col-md-12 profile-container" style="padding: 15px">';
                        echo '<div class="col-md-3">';
                        echo '<img src="' . $follower->getUserAvatar() . '" style="height: 60px;width: 60px;border-radius: 100%">';
                        echo '</div>';
                        echo '<div class="col-md-9">';
                        echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;">';
                        echo '<div style="cursor: pointer" onclick="location.href=\'/CWOne/index.php/ProfileController/loadUserPage?USERID='.$follower->getUserId().'&USERNAME='.$follower->getUserName().'\'">';
                        echo $follower->getUserName();
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="col-md-12" style="text-align: left">';
                        echo $follower->getFirstName() . " " . $follower->getLastName();
                        echo '</div>';
                        echo '<br/>';
                        echo '<div class="col-md-12" style="text-align: left">';
                        echo '<button onclick="location.href=\'/CWOne/index.php/HomePageController/followUser?USERID='.$userId.'&FOLLOWEDID='.$follower->getUserId().'\'" class="follow-btn">Follow</button>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }

            }else{
                echo '<p style="padding: 15px 15px 0 15px;font-size: 20px;margin: 0 !important;text-align: center">';
                echo "No users found !";
                echo "</p>";
            }
            ?>
        </div>
    </div>

    <div class="col-md-2" style="position: fixed;margin-left: 84%">
        <?php include('util/networkManagerCard.php'); ?>
    </div>
</div>
</body>
</html>