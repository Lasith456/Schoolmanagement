<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("includes/head")?>
</head>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-imagee"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="login1" >
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username1" 
                                                placeholder="Enter User name...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password1" placeholder="Password">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?php echo base_url()?>Login/forgot_password">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Add JavaScript files to dashboard.php -->
    <?php $this->load->view("includes/js")?>
    <script>
    $("#login1").submit(function(e) {
        e.preventDefault();
        var username1 = $("#username1").val();
        var password1 = $("#password1").val();

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>Login/user_login1",
            data: 'username1=' + username1 + '&password1=' + password1,
            success: function(result) {
                var reversedata = $.parseJSON(result);
                if(reversedata.status == 'success'){
                    window.location.replace(reversedata.message);
                    
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Access Denied ..',
                    text: reversedata.message,
                    footer: '<a href="">please try again</a>'
                })
                };
                
            },
            error: function(result) {
                
            }
        });
    });
</script>

</body>
</html>