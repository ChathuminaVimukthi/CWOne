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