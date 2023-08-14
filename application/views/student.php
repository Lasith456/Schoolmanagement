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
        <!-- End of Topbar -->
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">
        <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Students</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Student Details</h6>
        <a role="button" class="btn btn-outline-primary" href="<?php echo base_url()?>Student/student_add">
                                <span class="icon text-black-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Add new Student</span>
                            </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Telephone number</th>
                    </tr>
                </thead>
                <tbody>
                
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <?php $this->load->view("includes/footer")?>
</div>
<!-- End of Main Content -->
    </div>
    <!-- Add JavaScript files to dashboard.php -->
    <?php $this->load->view("includes/js")?>

    <script>
        $(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable().destroy();
    }

    $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('stud')?>",
            "dataType": "json",
            "type": "POST"
        },
        "columns": [
            {"data": "fullName"},
            {"data": "Email"},
            {"data": "mobileNumber"},
            {"data": "Address"}
        ]
    });
});
    </script>
</body>
</html>