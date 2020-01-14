<nav class="navbar navbar-light navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header col-md-1">
            <a class="navbar-brand" style="color: #ffffff"
               href="<?php echo base_url(); ?>index.php/HomePageController/">BEBOP</a>
        </div>
        <form class="navbar-form navbar-left" id="navBarSearchForm" action="/CWOne/index.php/HomePageController/search"
              method=POST>
            <?php echo form_open(); ?>
            <div class="input-group">
                <input type="text" id="searchMe" class="form-control" placeholder="Search" name=SEARCHTXT>
                <div class="input-group-btn form-group">
                    <button disabled class="btn btn-default" id="searchBtn" style="height: 100%;padding: 9px" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </form>
        <ul class="nav navbar-nav col-md-1">
            <li class="active pointer-nav" style="color: #fff"
                onclick="window.location='<?php echo base_url(); ?>index.php/ProfileController/loadUserPage?USERID=<?php echo $this->session->userdata['logged_in']['UserId'] ?>&USERNAME=<?php echo $this->session->userdata['logged_in']['UserName'] ?>'">
                <?php
                $profilepic = $this->session->userdata['logged_in']['Avatar'] ;
                echo '<img src="'.$profilepic.'" class="avatar img-circle">'
                ?>
                <?php
                echo $username
                ?>
            </li>
        </ul>
        <ul class="nav navbar-nav">
            <li class="active"><a style="color: #ffffff"
                                  href="<?php echo base_url(); ?>index.php/Contacts">Contact List</a></li>
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

<script type="text/javascript">
    document.getElementById("searchMe").addEventListener("keyup", function() {
        var nameInput = document.getElementById('searchMe').value;
        if (nameInput != "") {
            document.getElementById('searchBtn').removeAttribute("disabled");
        } else {
            document.getElementById('searchBtn').setAttribute("disabled", null);
        }
    });
</script>