<div class="side-skirt" style="background: #ffffff;margin-left: 15px">
    <p style="text-align: center;padding-top: 5px;">Recent Followers</p>
    <hr style="margin-top: 0px"/>
    <div class="pull-left" style="margin-top: 25%;font-size: 20px"><i class="fa fa-arrow-circle-left" onclick="plusDivs(-1)"></i></div>
    <div class="pull-right" style="margin-top: 25%;font-size: 20px"><i class="fa fa-arrow-circle-right" onclick="plusDivs(1)"></i></div>

    <?php
    if(isset($recentFollowers)){
        foreach ($recentFollowers as $user){
            echo '<div class="followers" style="padding: 20px">';
            $profilepic = $user->getUserAvatar();
            echo '<div class="col-md-12" style="text-align: center;">';
            echo '<img src="' . $profilepic . '" style="height: 100px;width: 100px;border-radius: 100%">';
            echo '</div>';
            $userName = $user->getUserName();
            echo '<div class="col-md-12" style="font-weight: bold;font-size: medium;text-align: center;padding: 5px;">';
            echo $userName;
            echo '</div>';
            echo '</div>';
        }
    }
    ?>

</div>

<script>
    var slideIndex = 1;

    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("followers");
        console.log(x.length);
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
    }
</script>