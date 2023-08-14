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
                            <h1 class="h3 mb-2 text-gray-800">Students Add</h1>
                            <p class="mb-4">Please add new student details.</p>
                            <div class="container">
                                <form class="form-group" id="addStudent">
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-6 mb-sm-0 ">
                                            <label>Student Full Name</label>
                                            <input type="text" class="form-control form-control-user" id="tuserName"
                                            placeholder="Full Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input type="email" class="form-control form-control-user" id="inputEmail"
                                        placeholder="Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number </label>
                                        <input type="text" class="form-control form-control-user" id="tpnumb"
                                        placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group">
                                        <label>Address </label>
                                        <textarea class="form-control form-control-user" placeholder="Address" id="tAddress"></textarea>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" onclick="addStudent()">
                                        Add student</button>
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
            function addStudent(){
        $("#addStudent").submit(function(e) {
        e.preventDefault();
        var fullname = $("#tuserName").val();
        var emailT = $("#inputEmail").val();
        var mobilenumb = $("#tpnumb").val();
        var tAddress = $("#tAddress").val();
            $.ajax({
            type: "POST",
            url: "<?=base_url()?>addStudent",
            data: 'fullname=' + fullname + '&emailT=' + emailT + '&mobilenumb=' + mobilenumb + '&tAddress=' + tAddress,
            success: function(result) {
                var reversedata = $.parseJSON(result);
                if (reversedata.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Great..',
                        text: reversedata.message,
                    });
                    document.getElementById("addStudent").reset();

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