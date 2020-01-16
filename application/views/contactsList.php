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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/contactsList.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/multiselect.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/underscore-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/backbone-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/multiselect.js"></script>

</head>
<body>
<?php include('util/header.php'); ?>
<div class="row second-body">
    <div class="col-md-2" style="position: fixed; width: 16%">
        <?php include('util/profileCard.php'); ?>
        <br/>
        <div class="side-skirt" id="favoriteContacts" style="margin-left: 15px;overflow-y:auto;max-height: 200px">

        </div>

    </div>
    <div class="col-md-10 contacts-background" style="margin-left: 16%;padding: 0 !important;height: 100%">
        <div>
            <nav class="contacts-header navbar-light">
                <div class="container-fluid">
                    <div class="navbar-header col-md-4" style="padding: 0 !important;">
                        <a class="navbar-brand" style="color: #fff; background: #8B9DC3;border-radius: 30px"
                           id="contactListBtn"
                           href="<?php echo base_url(); ?>index.php/ContactsController/">Contacts List</a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active" id="addContactBtn" data-toggle="collapse" data-target="#addEditContact"><a
                                    href="#" style="color: #000"><i
                                        class="fa fa-chevron-down" aria-hidden="true"></i>
                                Add Contact</a></li>
                        <!--                        <li><a href="#" style="color: #ffffff">Page 1</a></li>-->
                        <!--                        <li><a href="#" style="color: #ffffff">Page 2</a></li>-->
                    </ul>
                    <div class="navbar-form navbar-right" id="contactsSearchForm">
                        <div class="input-group">
                            <input type="text" id="searchContacts" class="form-control" placeholder="Search contacts by Last Name or Tag Name..."
                                   name=SEARCHTXT>
                            <div class="input-group-btn form-group">
                                <button disabled class="btn btn-default" id="searchContactsBtn"
                                        style="height: 100%;padding: 9px; border: 1px solid #000" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <hr style="margin-top: 5px !important;margin-bottom: 5px !important;"/>

        <div class="addEditContact collapse" id="addEditContact">
            <div style="margin: 0 10px 15px 10px;">
                <div class="col-md-6">
                    <div class="wrap-input form-group">
                        <label>First Name</label>
                        <input type=text class="input form-control" id="firstName" name=FIRSTNAME
                               placeholder="First Name">
                    </div>
                    <div class="wrap-input form-group">
                        <label>Last Name</label>
                        <input type=text class="input form-control" id="lastName" name=LASTNAME placeholder="Last Name">
                    </div>
                    <div class="wrap-input form-group">
                        <label>Email</label>
                        <input type=text class="input form-control" id="email" name=EMAIL placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wrap-input form-group">
                        <label>Mobile Number</label>
                        <input type=text class="input form-control" id="mobileNumber" name=MOBILENUMBER
                               placeholder="Mobile Number">
                    </div>
                    <div class="wrap-input form-group">
                        <label>Select contact category </label>
                        <br/>
                        <select style="border-radius: 10px" name="tags[]" id="contactTags" multiple="multiple">
                            <?php
                            foreach ($tags as $value) {
                                echo '<option value="' . $value->getId() . '">';
                                echo $value->getGenre();
                                echo '</option>';
                            }
                            ?>
                        </select>
                        <div id="drpErr">
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="form-group container-login-form-btn">
                <button class="login-form-btn" id="saveContactBtn" style="width: 20%">
                    Save Contact
                </button>
            </div>
            <hr style="margin-bottom: 5px"/>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="background: #3b5998;color: #fff">
                        <button type="button" style="color: #fff" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Contact</h4>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label>First Name</label>
                            <input type="hidden" id="contactId">
                            <input type=text class="input form-control" id="editFirstName" name=EDITFIRSTNAME
                                   placeholder="First Name">
                            <label>Last Name</label>
                            <input type=text class="input form-control" id="editLastName" name=EDITLASTNAME placeholder="Last Name">
                            <label>Email</label>
                            <input type=text class="input form-control" id="editEmail" name=EDITEMAIL placeholder="Email">
                            <label>Mobile Number</label>
                            <input type=text class="input form-control" id="editMobileNumber" name=EDITMOBILENUMBER
                                   placeholder="Mobile Number">
                            <label>Select contact category </label>
                            <br/>
                            <select style="border-radius: 10px" name="editTags[]" id="editContactTags" multiple="multiple">
                                <?php
                                foreach ($tags as $value) {
                                    echo '<option value="' . $value->getId() . '">';
                                    echo $value->getGenre();
                                    echo '</option>';
                                }
                                ?>
                            </select>
                            <div id="drpErr">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" style="background: #57b846 !important;" class="btn btn-primary" id="saveEditedData">Save changes</button>
                    </div>
                </div>

            </div>
        </div>

        <div style="background: #fff">
            <div class='col-md-12' style='margin-bottom: 5px'>
                <div style='text-align: center' class='col-md-3'><i class="fas fa-address-card icons"></i></div>
                <div style='text-align: center' class='col-md-2'><i class="fa fa-envelope icons" aria-hidden="true"></i></div>
                <div style='text-align: center' class='col-md-2'><i class="fas fa-phone icons" aria-hidden="true"></i></div>
                <div style='text-align: center' class='col-md-2'><i class="fas fa-tag icons" aria-hidden="true"></i></div>
            </div>
            <hr style='margin-top: 10px !important;margin-bottom: 0px !important;'/>
        </div>
        <div id="showAlert" style="display: none"></div>
        <div class="displayContacts" id="displayContacts" style="padding: 10px;background: #fff">

        </div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $('#contactTags').multiselect();
    });

    document.getElementById("searchContacts").addEventListener("keyup", function () {
        var nameInput = document.getElementById('searchContacts').value;
        if (nameInput != "") {
            document.getElementById('searchContactsBtn').removeAttribute("disabled");
        } else {
            document.getElementById('searchContactsBtn').setAttribute("disabled", null);
        }
    });

    $('#addContactBtn').click(function () {
        $("i", this).toggleClass("fa-chevron-up fa-chevron-down");
        $('.error').html("");
    });
    let checkValidity = true;

    //validate add contact form
    $(document).ready(function () {
        $('#saveContactBtn').click(function (e) {
            e.preventDefault();
            var first_name = $('#firstName').val();
            var last_name = $('#lastName').val();
            var email = $('#email').val();
            var password = $('#mobileNumber').val();
            var dropDown = $('#contactTags').val();

            let firstNameValid = true;
            let lastNameValid = true;
            let emailValid = true;
            let mobileNumberValid = true;
            let dropDownValid = true;

            $(".error").remove();

            if (first_name.length < 1) {
                $('#firstName').after('<span style="color: #990000" class="error">This field is required</span>');
                firstNameValid = false;
            }
            if (last_name.length < 1) {
                $('#lastName').after('<span style="color: #990000" class="error">This field is required</span>');
                lastNameValid = false;
            }
            if (email.length < 1) {
                $('#email').after('<span style="color: #990000" class="error">This field is required</span>');
                emailValid = false;
            } else {
                var regEx = /\S+@\S+\.\S+/;
                var validEmail = regEx.test(email);
                if (!validEmail) {
                    $('#email').after('<span style="color: #990000" class="error">Enter a valid email</span>');
                    emailValid = false;
                }
            }
            if (password.length < 10 || password.length > 10) {
                $('#mobileNumber').after('<span style="color: #990000" class="error">Mobile Number must be 10 characters long</span>');
                mobileNumberValid = false;
            }
            if(!dropDown.length > 0){
                $('#drpErr').after('<span style="color: #990000" class="error">Select at least one option</span>');
                dropDownValid = false;
            }

            checkValidity = !(firstNameValid === false || lastNameValid === false || emailValid === false || mobileNumberValid === false || dropDownValid === false);
        });

    });

    let checkValidityOfAddTag = true;

    $(document).ready(function () {
        $('#saveTag').click(function (e) {
            e.preventDefault();
            var tagName = $('#tagName').val();
            $(".error").remove();
            if (tagName.length < 1) {
                $('#tagName').after('<div><span style="color: #990000" class="error">This field is required</span></div>');
                checkValidityOfAddTag = false;
            }
        });
    });

    let checkValidityOfEditedData = true;

    //validate update contact form
    $(document).ready(function () {
        $('#saveEditedData').click(function (e) {
            e.preventDefault();
            var first_name = $('#editFirstName').val();
            var last_name = $('#editLastName').val();
            var email = $('#editEmail').val();
            var password = $('#editMobileNumber').val();
            var dropDown = $('#editContactTags').val();

            let firstNameValid = true;
            let lastNameValid = true;
            let emailValid = true;
            let mobileNumberValid = true;
            let dropDownValid = true;

            $(".error").remove();

            if (first_name.length < 1) {
                $('#editFirstName').after('<div><span style="color: #990000" class="error">This field is required</span></div>');
                firstNameValid = false;
            }
            if (last_name.length < 1) {
                $('#editLastName').after('<div><span style="color: #990000" class="error">This field is required</span></div>');
                lastNameValid = false;
            }
            if (email.length < 1) {
                $('#editEmail').after('<div><span style="color: #990000" class="error">This field is required</span></div>');
                emailValid = false;
            } else {
                var regEx = /\S+@\S+\.\S+/;
                var validEmail = regEx.test(email);
                if (!validEmail) {
                    $('#editEmail').after('<div><span style="color: #990000" class="error">Enter a valid email</span></div>');
                    emailValid = false;
                }
            }
            if (password.length < 10 || password.length > 10) {
                $('#editMobileNumber').after('<div><span style="color: #990000" class="error">Mobile Number must be 10 characters long</span></div>');
                mobileNumberValid = false;
            }

            if(!dropDown.length > 0){
                $('#editContactTags').before('<span style="color: #990000" class="error">Select at least one option</span>');
                dropDownValid = false;
            }

            checkValidityOfEditedData = !(firstNameValid === false || lastNameValid === false || emailValid === false || mobileNumberValid === false || dropDownValid === false);
        });

    });


    $('#closeAlert').click(function () {
        document.getElementById("showAlert").style.display="none";
    });
    //    --------------------------------------------------------------Backbone Part------------------------------------------------------------------

    //Main Model
    let searchResponse = "";
    let isSearch = false;

    let Contacts = Backbone.Model.extend({
        url: function () {
            return "<?php echo base_url() ?>index.php/ContactsController/contact";
        },
        idAttribute: 'id',
        defaults:{
            id:null,
            firstName:null,
            lastName:null
        },
        fetchByName:function () {
            let self = this;
            contactCollection.fetch({
                async:false,
                data: $.param({caseId: this.get('caseId'),lastName: this.get('lastName')}),
                success: function (contacts,response) {
                    searchResponse = response;
                }
            })
        },
        deleteById:function () {
            let self = this;
            this.destroy({
                async:false,
                data: $.param({id: this.get('id')})
            })
        }
    });

    //Collection model
    let ContactCollection = Backbone.Collection.extend({
        model:Contacts,
        url: function () {
            return "<?php echo base_url() ?>index.php/ContactsController/contact";
        }
    });

    let contactCollection = new ContactCollection();
    let contact = new Contacts();

    contactCollection.comparator = function (model) {
        return model.get("firstName");
    };

    //List view
    let ContactView = Backbone.View.extend({
        el:"#displayContacts",
        model:contactCollection,
        initialize: function () {
            contactCollection.fetch({async:false});
            this.byNameAscd();
            this.render();
            this.listenTo(contactCollection, 'add remove change sort', this.render);
        },
        byNameAscd: function () {
            contactCollection.sort();
        },
        events:{
            "click #deleteContactBtn": "deleteContact",
            "click #updateContactBtn" : "updateContact"
        },
        deleteContact: function (e){
            let contactId =  $(e.currentTarget).attr('value');
            if(isSearch){
                let dupContId = parseInt(contactId) + 0.5;
                let deleteSvrContact =  new Contacts({id:dupContId});
                contactCollection.remove(deleteSvrContact);
            }
            let deleteSvrContact =  new Contacts({id:contactId});
            contactCollection.remove(deleteSvrContact);
            deleteSvrContact.deleteById();
        },
        updateContact: function (e){
            let contactId =  $(e.currentTarget).attr('value');
            let cont = contactCollection.get({id: contactId});

            $('#contactId').val(contactId);
            $('#editFirstName').val(cont.get('firstName'));
            $('#editLastName').val(cont.get('lastName'));
            $('#editEmail').val(cont.get('email'));
            $('#editMobileNumber').val("0"+cont.get('mobileNumber'));
            $('#editContactTags').val(cont.get('tagIds'));

            let valArr = cont.get('tagIds');
            let size = valArr.length;

            $("#editContactTags").multiselect("refresh");
            for(let i = 0; i < size; i++){
                $("#editContactTags").multiselect("widget").find(":checkbox[value='"+valArr[i]+"']").attr("checked","checked");
                $("#editContactTags option[value='" + valArr[i] + "']").attr("selected", 1);
            }

        },
        render: function () {
            let self = this;
            $("#displayContacts").html("");
            $('#favoriteContacts').html("");
            let favorties = '<p style="text-align: center;padding-top: 5px;font-weight: bold">Favorite Contacts</p>\n' +
                '<hr style="margin-top: 0px;margin-bottom: 0px"/>';
            let contByTag = '<p style="text-align: center;padding-top: 5px;font-weight: bold">Contacts By Tag</p>\n' +
                '<hr style="margin-top: 0px;margin-bottom: 5px"/>';
            let contByName = '<p style="text-align: center;padding-top: 5px;font-weight: bold">Contacts By Name</p>\n' +
                '<hr style="margin-top: 0px;margin-bottom: 5px"/>';
            let isName = false;
            let isTag = false;
            let contCount = 0;
            contactCollection.each(function (c) {
                let randomColor = "#000000".replace(/0/g,function(){return (~~(Math.random()*16)).toString(16);});
                let name = c.get('firstName');
                if(name != null){
                    document.getElementById("showAlert").style.display="none";
                    contCount ++;
                    let contact =" <div class='col-md-12' style='margin-bottom: 5px'>" +
                        "<div style='"+"background:"+c.get('color')+"' class='col-md-1 contactAvatar'>"+name[0].toUpperCase()+"</div>" +
                        "<div style='' class='col-md-3 contactName' id='names'>"+c.get('firstName')+" "+c.get('lastName')+"</div>"+
                        "<div style='' class='col-md-2 otherNames'>"+c.get('email')+"</div>"+
                        "<div style='' class='col-md-2 otherNames'>"+c.get('mobileNumber')+"</div>"+
                        "<div style='' class='col-md-2 otherNames' id='tags'>"+c.get('tagNames')+"</div>"+
                        "<button class='col-md-1 contactManageBtn' value='"+c.get('id')+"' id='updateContactBtn' style='padding-top: 10px' data-toggle='modal' data-target='#myModal'><i class='col-md-12 fas fa-edit' aria-hidden='true'></i></button>"+
                        "<button class='col-md-1 contactManageBtn' value='"+c.get('id')+"' id='deleteContactBtn'><i class='col-md-12 fa fa-trash contactManageBtn' aria-hidden='true'></i></button>"+
                        "</div>"+
                        "<hr style='margin-top: 10px !important;margin-bottom: 10px !important;'/>"

                    ;

                    let flag = c.get('flag');

                    // switch (flag) {
                    //     case "1":
                    //         isName = true;
                    //         let contId = c.get('id');
                    //         if(!Number.isInteger(contId)){
                    //             contId -= 0.5;
                    //         }
                    //         let conts =" <div class='col-md-12' style='margin-bottom: 5px'>" +
                    //             "<div style='"+"background:"+c.get('color')+"' class='col-md-1 contactAvatar'>"+name[0].toUpperCase()+"</div>" +
                    //             "<div style='' class='col-md-3 contactName'>"+c.get('firstName')+" "+c.get('lastName')+"</div>"+
                    //             "<div style='' class='col-md-2 textClass'>"+c.get('email')+"</div>"+
                    //             "<div style='' class='col-md-2 textClass'>"+c.get('mobileNumber')+"</div>"+
                    //             "<div style='' class='col-md-2 textClass'>"+c.get('tagNames')+"</div>"+
                    //             "<button class='col-md-1 contactManageBtn' value='"+contId+"' id='updateContactBtn' style='padding-top: 10px' data-toggle='modal' data-target='#myModal'><i class='col-md-12 fas fa-edit' aria-hidden='true'></i></button>"+
                    //             "<button class='col-md-1 contactManageBtn' value='"+contId+"' id='deleteContactBtn'><i class='col-md-12 fa fa-trash contactManageBtn' aria-hidden='true'></i></button>"+
                    //             "</div>"+
                    //             "<hr style='margin-top: 10px !important;margin-bottom: 10px !important;'/>"
                    //
                    //         ;
                    //         contByName += conts;
                    //         break;
                    //     case "2":
                    //         isTag = true;
                    //         contByTag += contact;
                    //         break;
                    //     default:
                    //         break;
                    //
                    //
                    // }
                    self.$el.append(contact);

                    let tNames = c.get('tagNames');
                    if(tNames.includes('Favorite')){
                        let favoriteContacts =
                            "<div style='padding: 5px'>"+
                            "<div style='"+"background:"+c.get('color')+";margin-top: 10px' class='col-md-4 contactAvatar'>"+name[0].toUpperCase()+"</div>"+
                            "<div class='col-md-8'>"+
                            "<div style='' class='col-md-12 contactName'>"+c.get('firstName')+"</div>"+
                            "<div style='' class='col-md-12 textClass'>"+c.get('mobileNumber')+"</div>"+
                            "</div>"+
                            "</div>";
                        favorties += favoriteContacts;
                    }
                }
            });
            if(isName === true){
                $('#displayContacts').append(contByName);
            }
            if(isTag === true){
                $('#displayContacts').append(contByTag);
            }
            if(contCount === 0 && !isSearch){
                document.getElementById("showAlert").style.display="block";
                let alert = "<div style='margin: 10px' class='alert alert-info alert-dismissible' role='alert'>" +
                    "<button type='button' id='closeAlert' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                    "<strong>You have not entered any contacts yet!</strong></div>";
                let div = document.getElementById("showAlert");
                div.innerHTML += alert;
            }
            $('#favoriteContacts').append(favorties);
        }
    });

    let contactView = new ContactView();

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1);
    };

    //Add contact View
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
            let tags = $('#contactTags').val();
            let tagName = $('#contactTags option:selected').toArray().map(item => item.text).join();
            let randomColor = "#000000".replace(/0/g,function(){return (~~(Math.random()*16)).toString(16);});

            console.log(checkValidity);
            if (checkValidity) {
                let contact = new Contacts({
                    firstName: firstName.capitalize(),
                    lastName: lastName.capitalize(),
                    email: email,
                    mobileNumber: mobileNumber,
                    tags: tags,
                    color: randomColor
                });
                let contactId = 0;
                contact.save(null,{
                    async: false,
                    success: function (contact,response) {
                        contactId = response;
                    }
                });
                let contacts = new Contacts({
                    id:contactId,
                    firstName: firstName.capitalize(),
                    lastName: lastName.capitalize(),
                    email: email,
                    mobileNumber: parseInt(mobileNumber),
                    tagIds: tags,
                    tagNames: tagName,
                    color: randomColor
                });
                $('#displayContacts').empty();
                contactCollection.add(contacts);

                $('#firstName').val('');
                $('#lastName').val('');
                $('#email').val('');
                $('#mobileNumber').val('');

            }
        }
    });

    let addContactBtn = new AddContactBtn();

    //update contact button
    let UpdateContactBtn = Backbone.View.extend({
        el: "#myModal",
        initialize: function () {

        },
        render: function () {
            return this;
        },
        events: {
            "click #saveEditedData": "updateContact"
        },
        updateContact:function () {
            let contactId = $('#contactId').val();
            let firstName = $('#editFirstName').val();
            let lastName = $('#editLastName').val();
            let email = $('#editEmail').val();
            let mobileNumber = $('#editMobileNumber').val();
            let tags = $('#editContactTags').val();
            let tagName = $('#editContactTags option:selected').toArray().map(item => item.text).join();

            if(checkValidityOfEditedData){
                let contact = new Contacts({
                    id: contactId,
                    firstName: firstName.capitalize(),
                    lastName: lastName.capitalize(),
                    email: email,
                    mobileNumber: parseInt(mobileNumber),
                    tags: tags
                });
                contact.save();

                let cont = contactCollection.get(contactId);
                cont.set({
                    id: contactId,
                    firstName: firstName.capitalize(),
                    lastName: lastName.capitalize(),
                    email: email,
                    mobileNumber: parseInt(mobileNumber),
                    tagIds: tags,
                    tagNames: tagName
                });
            }
        }
    });

    let updateContactBtn = new UpdateContactBtn();

    //search button
    let SearchContactsBtn =  Backbone.View.extend({
        el: "#contactsSearchForm",
        initialize: function () {

        },
        render: function () {
            return this;
        },
        events: {
            "click #searchContactsBtn": "searchContacts"
        },
        searchContacts: function () {
            isSearch = true;
            contactCollection.reset();
            let searchString = $('#searchContacts').val();
            let strSplit = searchString.split(" ");

            $("#searchResults").html("");
            let contactsByName = new Contacts({caseId:1,lastName:strSplit});
            contactsByName.fetchByName();
            let noResult = "No search results found for ";
            let validity = searchResponse['emptyMsg'];
            if(validity === "false"){
                document.getElementById("showAlert").style.display="block";
                let alert = "<div style='margin: 10px' class='alert alert-danger alert-dismissible' role='alert'>" +
                    "<button type='button' id='closeAlert' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" +
                    "<strong>"+noResult+searchString +"</strong></div>";
                let div = document.getElementById("showAlert");
                div.innerHTML += alert;
                contactCollection.fetch({async:false});
            }else{
                isSearch = true;
                for (let i = 0; i < strSplit.length; i++){
                    var src_str = $("#displayContacts").html();
                    var term = strSplit[i];
                    term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
                    var pattern = new RegExp("("+term+")", "gi");

                    // var color = "hsl(" + Math.random() * 360 + ", 100%, 75%)";
                    let color = "#d21f99";

                    src_str = src_str.replace(pattern, "<mark style='"+"color:"+color+";background: none;padding: unset'>$1</mark>");
                    //src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");

                    $("#displayContacts").html(src_str);
                }
            }
        }
    });

    let searchContactsBtn = new SearchContactsBtn();

</script>
</body>
</html>