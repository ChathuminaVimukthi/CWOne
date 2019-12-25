<html>
<?php
if(isset($this->session->userdata['logged_in'])){
    $username = ($this->session->userdata['logged_in']['UserName']);
}else{
    redirect("UserController/login");
}
?>
<head>
    <title>Contact List Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/contactsList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/underscore-min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backbone-min.js" ></script>
</head>
<body>
<?php include('util/header.php'); ?>
<div class="row second-body">
    <div class="col-md-2" style="width: 16%">
        <div class="side-skirt" style="margin-left: 15px">
        </div>
    </div>
    <div class="col-md-10 contacts-background" style="padding: 0 !important;">
        <div>
            <nav class="contacts-header navbar-light">
                <div class="container-fluid">
                    <div class="navbar-header col-md-4" style="padding: 0 !important;">
                        <a class="navbar-brand" style="color: #fff; background: #8B9DC3;border-radius: 30px" id="contactListBtn"
                           href="<?php echo base_url(); ?>index.php/ContactsController/">Contacts List</a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active" id="addContactBtn"><a href="#" style="color: #000"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add Contact</a></li>
<!--                        <li><a href="#" style="color: #ffffff">Page 1</a></li>-->
<!--                        <li><a href="#" style="color: #ffffff">Page 2</a></li>-->
                    </ul>
                    <form class="navbar-form navbar-right" id="contactsSearchForm" action="/CWOne/index.php/HomePageController/search"
                          method=POST>
                        <?php echo form_open(); ?>
                        <div class="input-group">
                            <input type="text" id="searchContacts" class="form-control" placeholder="Search contacts..." name=SEARCHTXT>
                            <div class="input-group-btn form-group">
                                <button disabled class="btn btn-default" id="searchContactsBtn" style="height: 100%;padding: 9px; border: 1px solid #000" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </form>
                </div>
            </nav>
        </div>
        <hr style="margin-top: 5px !important;margin-bottom: 5px !important;"/>

        <div class="displayContacts" id="displayContacts" style="padding: 10px">
            <div class="row">
                <div class="col-md-1">
                    avatar
                </div>
                <div class="col-md-3">
                    firstname lastname
                </div>
                <div class="col-md-3">
                    email
                </div>
                <div class="col-md-2">
                    mobile number
                </div>
                <div class="col-md-2">
                    tags
                </div>
                <div class="col-md-1">
                    <button><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit</button>
                </div>
            </div>
        </div>

        <div class="addEditContact" id="addEditContact" style="display: none">
            <form action="/CWOne/index.php/UserController/register" method=POST>
                <?php echo form_open(); ?>
                <div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-6" style="margin: 10px 0 15px 0;border-radius:5px;border: 1px solid #eee">
                        <div class="wrap-input form-group">
                            <label>First Name</label>
                            <input type=text class="input form-control" name=FIRSTNAME placeholder="First Name"
                                   value="<?php echo set_value('FIRSTNAME'); ?>">
                            <div style="color: #990000">
                                <?php echo form_error('FIRSTNAME'); ?>
                            </div>
                        </div>
                        <div class="wrap-input form-group">
                            <label>Last Name</label>
                            <input type=text class="input form-control" name=LASTNAME placeholder="Last Name"
                                   value="<?php echo set_value('LASTNAME'); ?>">
                            <div style="color: #990000">
                                <?php echo form_error('LASTNAME'); ?>
                            </div>
                        </div>
                        <div class="wrap-input form-group">
                            <label>Email</label>
                            <input type=text class="input form-control" name=EMAIL placeholder="Email">
                            <div style="color: #990000">
                                <?php echo form_error('EMAIL'); ?>
                            </div>
                        </div>
                        <div class="wrap-input form-group">
                            <label>Mobile Number</label>
                            <input type=text class="input form-control" name=MOBILENUMBER
                                   placeholder="Mobile Number">
                            <div style="color: #990000">
                                <?php echo form_error('MOBILENUMBER'); ?>
                            </div>
                        </div>
                        <div class="wrap-input form-group">
                            <label>Select contact category </label>
<!--                            <select style="border-radius: 10px" name="genre[]" id="musicGenre" multiple >-->
<!--                                --><?php
//                                foreach ($musicGenre as $value){
//                                    echo '<option value="'.$value->getId().'">';
//                                    echo $value->getGenre();
//                                    echo '</option>';
//                                }
//                                ?>
<!--                            </select>-->
<!--                            <div style="color: #990000">-->
<!--                                --><?php //echo form_error('genre'); ?>
<!--                            </div>-->
                        </div>
                    </div>

                    <div class="col-md-3">

                    </div>
                </div>
                <hr/>
                <div class="form-group container-login-form-btn">
                    <button class="login-form-btn" style="width: 20%" type="submit">
                        Save Contact
                    </button>
                </div>
                <?php echo form_close(); ?>
            </form>
            <hr/>
        </div>
    </div>
</div>
<script>
    document.getElementById("searchContacts").addEventListener("keyup", function() {
        var nameInput = document.getElementById('searchContacts').value;
        if (nameInput != "") {
            document.getElementById('searchContactsBtn').removeAttribute("disabled");
        } else {
            document.getElementById('searchContactsBtn').setAttribute("disabled", null);
        }
    });

    $(document).ready(function () {
        $("#addContactBtn").click(function () {
            $("#displayContacts").css("display", "none");
            $("#addEditContact").css("display", "block");
        });

        $("#contactListBtn").click(function () {
            $("#addEditContact").css("display", "none");
            $("#displayContacts").css("display", "block");
        });
    });
</script>
</body>
</html>