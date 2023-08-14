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
                            <h1 class="h3 mb-2 text-gray-800">User Add</h1>
                            <p class="mb-4">Please add new user details.</p>
                            <div class="container">
                                <form class="form-group" id="addUser">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-6 mb-sm-0 ">
                                            <label>User Name</label>
                                            <input type="text" class="form-control form-control-user" id="userName"
                                            placeholder="user name" required>
                                        </div>
                                        <div class="col-sm-12 mb-6 mb-sm-0 ">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control form-control-user" id="fullName"
                                            placeholder="Full Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input type="email" class="form-control form-control-user" id="inputEmail"
                                        placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group">
                                        <label>phoneNumber </label>
                                        <input type="text" class="form-control form-control-user" id="phoneNumber"
                                        placeholder="phoneNumber">
                                    </div>
                                    <div class="form-group">
                                        <label>startDate </label>
                                        <input type="date" class="form-control form-control-user" id="startDate"
                                        placeholder="Start Date">
                                    </div>
                                    <div class="form-group">
                                        <label>Address </label>
                                        <textarea class="form-control form-control-user" placeholder="Address" id="studentAddress"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>User Password </label>
                                        <input type="text" class="form-control form-control-user" id="inputPassword"
                                        placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" onclick="addUser()">
                                        Add User</button>
</form>
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->
                    <?php $this->load->view("includes/js")?>
                    <?php $this->load->view("includes/footer")?>
                </div>
                
                <!-- End of Content wrapper -->
        </div>
        <!--End of page wrapper-->
        <script>
            function addUser(){
        $("#addUser").submit(function(e) {
        e.preventDefault();
        var username = $("#userName").val();
        var phoneNumber = $("#phoneNumber").val();
        var fullname = $("#fullName").val();
        var emailT = $("#inputEmail").val();
        var startDate = $("#startDate").val();
        var studentAddress = $("#studentAddress").val();
        var inputPassword = $("#inputPassword").val();
            $.ajax({
            type: "POST",
            url: "<?=base_url()?>addUser",
            data: 'fullname=' + fullname + '&emailT=' + emailT + '&startDate=' + startDate + '&username=' + username + '&studentAddress=' + studentAddress + '&inputPassword=' + inputPassword + '&phoneNumber=' + phoneNumber,
            success: function(result) {
                var reversedata = $.parseJSON(result);
                if (reversedata.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Great..',
                        text: reversedata.message,
                    });
                    document.getElementById("addUser").reset();

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

        
    });
}
    
        </script>
</body>
</html>