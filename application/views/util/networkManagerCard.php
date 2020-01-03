<div class="side-skirt">
    <div class="followers-btn" style="">
        <p style="text-align: center;padding-top: 5px;">Manage your network</p>
        <hr style="margin-top: 0px"/>
        <div class="col-md-12">
            <form action="/CWOne/index.php/NetworkController/displayFriends">
                <button class="network-buttons" type="submit">Friends</button>
            </form>
            <div style="text-align: center">
                <?php
                if(isset($friendsCount)){
                    echo $friendsCount;
                }
                ?>
            </div>
        </div>
        <div class="col-md-12">
            <hr/>
            <form action="/CWOne/index.php/NetworkController/displayFollowers">
                <button id="followersBtnHp" class="network-buttons" type="submit">Followers</button>
            </form>
            <div style="text-align: center">
                <?php
                if(isset($followersCount)){
                    echo $followersCount;
                }
                ?>
            </div>
        </div>
        <div class="col-md-12">
            <hr/>
            <form action="/CWOne/index.php/NetworkController/displayFollowing">
                <button class="network-buttons" type="submit">Following</button>
            </form>
            <div style="text-align: center">
                <?php
                if(isset($followingCount)){
                    echo $followingCount;
                }
                ?>
            </div>
            <br>
        </div>
    </div>
</div>