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
<h1 class="h3 mb-2 text-gray-800">Teachers</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Teachers Details</h6>
        <a role="button" class="btn btn-outline-primary" href="<?php echo base_url()?>Teacher/teacher_add">
                                <span class="icon text-black-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Add new Teacher</span>
                            </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="teacherdata" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Telephone number</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($teacher as $row){
                            $name=$row->name;
                            $email=$row->email;
                            $phone=$row->phone;
                            $address=$row->address;
                    ?>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $address; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.7.0/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.7.0/js/buttons.colVis.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.7.0/js/buttons.flash.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.7.0/js/buttons.html5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/1.7.0/js/buttons.print.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#teacherdata').DataTable({
                "paging":true,
                "responsive":true,
                dom:'Bfrtip',
                buttons:[
                    'copy', 'excel', 'pdf','csv'
                ]
            })
        })
    </script>
</body>
</html>