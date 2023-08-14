<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("includes/head")?>
</head>
<body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <?php $this->load->view("includes/sidebar")?>
            <!-- End of Sidebar -->
  
                <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                    <div id="content">
                        <?php $this->load->view("includes/topbar")?>
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">User Profile</h1>
                            <p class="mb-4"><?php $userName=$this->session->userdata['logedData']['userName'];echo $userName;?>'s details</p>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <Center><img width="150px" class=" img-profile rounded-circle"src="<?php echo base_url()?>assets/img/undraw_profile.svg"><Center>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group" id="user_data">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 mb-6 mb-sm-0 ">
                                                            <label>Full Name</label>
                                                            <input type="text" class="form-control form-control-user" id="userfullName" placeholder="Full Name" value="<?php echo $userFullname; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mobile number </label>
                                                        <input type="text" class="form-control form-control-user" id="inputtp" placeholder="Mobile number" value= "<?php echo $mobileenum;?>" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email </label>
                                                        <input type="email" class="form-control form-control-user" id="inputEmail"placeholder="Email Address" value= <?php echo $useremail;?> disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>startDate </label>
                                                        <input type="date" class="form-control form-control-user" id="startDate"placeholder="Start Date" value= <?php echo $userStartdate;?> disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address </label>
                                                        <textarea class="form-control form-control-user" placeholder="Address" id="studentAddress"><?php echo $useraddress; ?></textarea>
                                                    </div>
                                                    <button class="btn btn-primary btn-user btn-block" onclick='updateuser()'>Update details</button>
</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <Center><p>Password Reset</p><Center>
                                            </div>
                                            <div class="card-body">
                                                <form class="form-group" id="changepass">
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 mb-6 mb-sm-0 ">
                                                            <label>Old Password</label>
                                                            <input type="password" class="form-control form-control-user" id="oldpass"placeholder="Please enter old password" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password </label>
                                                        <input type="password" class="form-control form-control-user" id="new1pass"placeholder="Please enter new password" oninput="passwordChecker()" required>
                                                        <p id="bad" style="color:red;"></p>
                                                        <p id="good" style="color:green;"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password </label>
                                                        <input type="password" class="form-control form-control-user" id="new2pass"placeholder="Re enter password" required>
                                                        <p id="errorconfirm" style="color:red;"></p>
                                                    </div>
                                                    <button type="submit" onclick="changepass()" class="btn btn-primary btn-user btn-block" id="changePass">Update Password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <!-- End of Content wrapper -->
        </div>
        <!--End of page wrapper-->
        <?php $this->load->view("includes/js")?>
        <?php $this->load->view("includes/footer")?>
        <script>
function updateuser() {

        var mobilenum = $("#inputtp").val();
        var studentAddress = $("#studentAddress").val();

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>updateuser",
            data: 'mobilenum=' + mobilenum + '&studentAddress=' + studentAddress,
            success: function(result) {
                console.log(result);
                var reversedata = $.parseJSON(result);
                if (reversedata.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Great..',
                        text: reversedata.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'oops..',
                        text: reversedata.message,
                    });
                }
            },
            error: function(result) {

            }
        });
    }
    function changepass(){
        $("#changepass").submit(function(e) {
        e.preventDefault();
        var oldpass = $("#oldpass").val();
        var new1pass = $("#new1pass").val();
        var new2pass = $("#new2pass").val();

        if(new1pass==new2pass){
            document.getElementById('errorconfirm').innerHTML = '';
            $.ajax({
            type: "POST",
            url: "<?=base_url()?>changepasswo",
            data: 'oldpass=' + oldpass + '&new2pass=' + new2pass,
            success: function(result) {
                var reversedata = $.parseJSON(result);
                if (reversedata.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Great..',
                        text: reversedata.message,
                    });
                    document.getElementById('good').innerHTML = '';
                    document.getElementById('errorconfirm').innerHTML = '';
                    document.getElementById("changepass").reset();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ooops..',
                        text: reversedata.message,
                    });
                };
                
            },
            error: function(result) {
                
            }
        });

        }else{
            document.getElementById('errorconfirm').innerHTML = 'New password and Confirm Password is not match try again';
        }

        
    });
    
    }
    function passwordChecker(){
        var passwordCheck = $("#new1pass").val();
        var upperLetter=[/[A-Z]/];
        var lowerLatter=[/[a-z]/];
        var digit=[/[0-9]/];
        var symbol=[/[!@#$%^&*]/];
        var count=[/.{8,}/];
        for(var i=0;i<upperLetter.length;i++){
            if(!upperLetter[i].test(passwordCheck)){
                document.getElementById('bad').innerHTML = 'please use at least one uppercase letter';
                document.getElementById('good').innerHTML = '';
                document.getElementById("changePass").disabled = true;
            }else if(!lowerLatter[i].test(passwordCheck)){
                document.getElementById('bad').innerHTML = 'please use at least one lowwer letter';
                document.getElementById('good').innerHTML = '';
                document.getElementById("changePass").disabled = true;
            }else if(!digit[i].test(passwordCheck)){
                document.getElementById('bad').innerHTML = 'please use at least one digit';
                document.getElementById('good').innerHTML = '';
                document.getElementById("changePass").disabled = true;
            }else if(!symbol[i].test(passwordCheck)){
                document.getElementById('bad').innerHTML = 'please use at least one special character';
                document.getElementById('good').innerHTML = '';
                document.getElementById("changePass").disabled = true;
            }else if(!count[i].test(passwordCheck)){
                document.getElementById('bad').innerHTML = 'please use minimum length of 8 characters';
                document.getElementById('good').innerHTML = '';
                document.getElementById("changePass").disabled = true;
            }else{
                document.getElementById('bad').innerHTML = '';
                document.getElementById('good').innerHTML = 'Your password is strong..';
                document.getElementById("changePass").disabled = false;

            }
        }
    }
</script>
</body>
</html>