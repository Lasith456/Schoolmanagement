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
                            <h1 class="h3 mb-2 text-gray-800">Working with Excell</h1>
                            <p class="mb-4">Ecell</p>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="file" accept=".csv,.xls,.xlsx" onchange="checkfile(this)" id="importfile" name="excelinput"/>
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
    function checkfile() {
        var fileextantion = new Array(".csv", ".xls", ".xlsx");
        var fileext = $('#importfile').val();
        fileext = fileext.substring(fileext.lastIndexOf('.'));
        if (fileextantion.indexOf(fileext) < 0) {
            alert('Error');
        } else {
            var file = $('#importfile').prop('files')[0];
            var form = new FormData();
            form.append('excelinput', file);

            $.ajax({
                type: "POST",
                url: "<?= base_url('excel/uploadExcel') ?>", // Correct URL for the AJAX request
                data: form,
                processData: false,
                contentType: false,
                success: function(result) {
                    var reversedata = $.parseJSON(result);
                    if (reversedata.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Upload successfull',
                            text: reversedata.message,
                        });
                        document.getElementById("addTeacher").reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ooops..',
                            text: reversedata.message,
                        });
                    };
                },
                error: function(xhr, status, error) {
                    // Handle the error here and show an appropriate error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing the request.',
                    });
                }
            });
        }
    }
</script>

</body>
</html>