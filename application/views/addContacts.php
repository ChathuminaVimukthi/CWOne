<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['UserName']);
} else {
    redirect("UserController/login");
}
?>
<head>
    <title>Contact List Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/contactsList.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backbone-min.js"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light" style="width: 100%;height: 50px;color: #fff">
    <a class="navbar-brand my-lg-0" style="text-align:center;color: #fff;width: 110px" href="<?php echo base_url(); ?>index.php/HomePageController/">BEBOP</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0" action="/CWOne/index.php/HomePageController/search" method=POST>
            <input class="form-control mr-sm-2" id="searchGenre" type="search" name="SEARCHTXT" placeholder="Search" style="width: 430px;" aria-label="Search">
            <button disabled class="btn btn-default" id="searchGenreBtn" style="height: 100%;padding: 9px;background: #fff;margin-left: -10px" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active mr-auto" style="margin-left: 10px"
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

    </div>
</nav>

<div class="row second-body">
    <div class="col-md-2">
        <div class="side-skirt" style="margin-left: 15px">
        </div>
    </div>
    <div class="col-md-10" style="padding: 0 !important;">
        <div class=" contacts-background" style="margin-right: 15px">
            <div>
                <nav class="navbar navbar-expand-lg navbar-light" style="background:#fff;width: 100%;height: 50px;color: #fff">
                    <a class="navbar-brand my-lg-0 col-md-2" style="text-align:center;color: #fff;width: 110px;background: #8B9DC3;border-radius: 30px"
                       href="<?php echo base_url(); ?>index.php/ContactsController/" id="contactListBtn">Contacts List</a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="col-md-7 "></div>
                        <form class="form-inline my-2 my-lg-0 col-md-3" action="/CWOne/index.php/HomePageController/search" method=POST>
                            <input class="form-control mr-sm-2" id="searchContacts" type="search" placeholder="Search" style="width: 150px;border: 1px solid #000" aria-label="Search">
                            <button disabled class="btn btn-default" id="searchContactsBtn" style="height: 100%;padding: 9px;background: #fff;border: 1px solid #000" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <ul class="navbar-nav mr-auto col-md-2">
                            <button  id="addContactBtn" style="border: 1px solid #000;border-radius: 30px;padding: 6px;text-align: center">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                Add Contact
                            </button>
                        </ul>

                    </div>
                </nav>
            </div>
            <hr style="margin-top: 5px !important;margin-bottom: 5px !important;"/>

            <div id="addEditContact" style="display: none">
                <form id="someForm" class="needs-validation" novalidate>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">First name</label>
                            <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                </div>
                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                                <div class="invalid-feedback">
                                    Please choose a username.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">City</label>
                            <input type="text" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">State</label>
                            <select class="custom-select" id="validationCustom04" required>
                                <option selected disabled value="">Choose...</option>
                                <option>...</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Zip</label>
                            <input type="text" class="form-control" id="validationCustom05" required>
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="saveContact" type="submit">Submit form</button>
                </form>

            </div>

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
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#addContactBtn").click(function () {
            console.log("schsdvhvdshvsdvhsj")
            $("#displayContacts").css("display", "block");
            $("#addEditContact").css("display", "block");
        });

        $("#contactListBtn").click(function () {
            $("#addEditContact").css("display", "none");
            $("#displayContacts").css("display", "block");
        });
    });

    document.getElementById("searchContacts").addEventListener("keyup", function () {
        var nameInput = document.getElementById('searchContacts').value;
        if (nameInput != "") {
            document.getElementById('searchContactsBtn').removeAttribute("disabled");
        } else {
            document.getElementById('searchContactsBtn').setAttribute("disabled", null);
        }
    });

    document.getElementById("searchGenre").addEventListener("keyup", function () {
        var nameInput = document.getElementById('searchGenre').value;
        if (nameInput != "") {
            document.getElementById('searchGenreBtn').removeAttribute("disabled");
        } else {
            document.getElementById('searchGenreBtn').setAttribute("disabled", null);
        }
    });

    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    $("#someForm").submit(function(e) {
        e.preventDefault();
    });

    //    -------------Backbone Part--------------

    let Contacts = Backbone.Model.extend({
        url: function () {
            return "<?php echo base_url() ?>index.php/ContactsController/contact";
        },
        idAttribute: 'id',
        defaults: {
            firstName: null,
            lastName: null,
            email: null,
            mobileNumber: 0
        }
    });

    let contact = new Contacts();

    let AddContactBtn = Backbone.View.extend({
        el: "#addEditContact",
        initialize: function () {

        },
        render: function () {
            return this;
        },
        events: {
            "click #saveContactBtn": "saveContact"
        },
        saveContact: function () {
            let firstName = $('#firstName').val();
            let lastName = $('#lastName').val();
            let email = $('#email').val();
            let mobileNumber = $('#mobileNumber').val();
            console.log(firstName);
            if(firstName === "" || lastName === "" || email === "" || mobileNumber === ""){
                // this.$el.find('#firstName_error').html('First Name field is required.').show();
                // this.$('#firstName').css('border', '1px solid #990000');
                // this.$el.find('#firstName_error').html('First Name field is required.').show();
                // this.$('#firstName').css('border', '1px solid #990000');
                // this.$el.find('#firstName_error').html('First Name field is required.').show();
                // this.$('#firstName').css('border', '1px solid #990000');
                // this.$el.find('#firstName_error').html('First Name field is required.').show();
                // this.$('#firstName').css('border', '1px solid #990000');
            }else{

                //catCollection.add(cat);
            }
            let contact = new Contacts({
                firstName: firstName,
                lastName: lastName,
                email: email,
                mobileNumber: mobileNumber
            });
            //let catDeatils = {'name': catName};
            console.log(contact.get('email'));
            contact.save();
        }
    });

    let addContactBtn = new AddContactBtn();
</script>
</body>
</html>