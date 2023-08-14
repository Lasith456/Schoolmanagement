<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("includes/head")?>
</head>
<body id="page-top" onload="getuserdata()">
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
<h1 class="h3 mb-2 text-gray-800">User</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Details</h6>
        <a role="button" class="btn btn-outline-primary" href="<?php echo base_url()?>User/user_add">
                                <span class="icon text-black-50">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                <span class="text">Add new User</span>
                            </a>
    </div>

    <div class="card-body">
    <div class="d-flex flex-row-reverse">
        <div class="p-2">

        <select class="form-control sticky-top" id="optlmt" onchange="getuserdata()">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>
        </div>
        <div class="p-2">
            <input type="text" id="search" class="form-control" onkeydown="javascript:if(event.keyCode==13){getuserdata();}" placeholder="Search">
        </div>
        
        
    </div>
        
    <br>
    <div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Start date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tbody1">
                
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination" id="pagination_ul">

            </ul>
            <ul class="offset" id="offsettxt">
                <input type="hidden" id="offset" class="form-control" onkeydown="javascript:if(event.keyCode==13){getuserdata();}" value='0'>
            </ul>
        </nav>
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

<!-- Add JavaScript files to dashboard.php -->
<?php $this->load->view("includes/js")?>

<!-- Add the jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    function getuserdata() {
        $('#tbody1').empty();
        $('#pagination_ul').empty(); 
        var limit=parseInt($('#optlmt').val());
        var offset=parseInt($('#offset').val());
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>getuserdata",
            data:'search='+$('#search').val()+ '&limit='+limit + '&offset='+offset,
            success: function(result) {
                var reversedata = $.parseJSON(result);
                
                if (reversedata.row_count==0){
                    $('#tbody1').append('<tr><td style="text-align:center; class="dataTables_empty" valign="top" colspan="8">No result found</td></tr>');
                }else{
                    for(var i=0;i<reversedata.all_users.length;i++){
                        var tdata='<tr>'+'<td>'+reversedata.all_users[i]['FullName']+'</td>'+
                    '<td>'+reversedata.all_users[i]['phoneNumber']+'</td>'+
                    '<td>'+reversedata.all_users[i]['email']+'</td>'+
                    '<td>'+reversedata.all_users[i]['Address']+'</td>'+
                    '<td>'+reversedata.all_users[i]['startDate']+'</td>'+
                    '<td>'+reversedata.all_users[i]['userName']+'</td>'+'</tr>';
                    $('#tbody1').append(tdata);
                    }
                    var pagination_html='';
                    var row_count=parseInt(reversedata.row_count) ; 
                    var pages=Math.ceil(row_count/limit);
                    var j=1;
                    if(1<pages){
                        pagination_html='<li class="paginate_button page-item previous disabled" id="teacherdata_previous"><a href="#" aria-controls="teacherdata" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>';
                        for(var i=0;i<pages;i++){
                            var status="";
                            if((limit*i)==offset){
                                status='paginate_button page-item active';
                            }else{
                                status='paginate_button page-item';
                            }
                            pagination_html+='<li class="'+status+'"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link" onclick="offset_field('+(limit*i)+')">'+(i+1)+'</a></li>';
                            j++;
                        }
                        
                        pagination_html+='<li class="paginate_button page-item next disabled" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li>';
                    }else{
                        $('#pagination_ul').empty(); 
                    }
                    $('#pagination_ul').append(pagination_html);
                }
            },
            error: function(result) {
                // Error handling here
            }
        });
    }
    function offset_field(value){
        $('#offset').val(value);
        getuserdata();
    }
</script>

</body>
</html>