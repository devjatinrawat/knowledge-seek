<?php $this->load->view("admin/header.php"); ?>
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">CONATCT</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                 <?php if($this->session->flashdata('deleteCon') != "") { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('deleteCon');?></div>
          <?php }?>
                <div class="card card-primary card-outline">
                    <div class="card-body text-center">
                        <div style="overflow-x:auto;">
                            <table class="table" id="tableData">
                                <thead>
                                    <tr>
                                        <th width="50">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">E-Mail</th>
                                        <th class="text-center">Send At</th>
                                        <th width="200" class="text-center">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                      if(!empty($contactDetail)) { ?>
                                    <?php foreach ($contactDetail as $value) {
                            
                          ?>

                                    <tr>
                                        <td class="text-center" id="conID">
                                            <?php echo $value['id']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo strtoupper($value['name']); ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $value['email']; ?>
                                        </td>
                                        <td class="text-center" style="text-align:in-line;">
                                            <?php echo date('y-M-d', strtotime($value['created_at'])); ?>
                                        </td>
                                        <td class="text-center">
                                            <!-- <?php if( $value['status'] == 0){  ?>
                      <span class="badge badge-warning">Unseen</span>
                    <?php }else{ ?>
                      <span class="badge badge-success">Seen</span>
                    <?php } ?> -->
                                            <button type="button" value="<?php echo $value['id']; ?>"
                                                class="btn btn-outline-success ml-2 showmodal" id="viewModal"
                                                data-toggle="modal"><i class="fas fa-eye"></i></button>
                                            <a href="javascript:void(0);" onclick="deleteContact(<?php echo $value['id']; ?>)" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php } 
                      }else{
                            ?>
                                    <tr>
                                        <td colspan="6"> Records not found........ </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pr-3 ml-auto">
                        <?php echo $pagination_link; ?>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>

<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->



<!-- ----------------------------------------------- -->
<!--                        Modal                    -->
<!-- ----------------------------------------------- -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLabel">Contact information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="top-div">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <center>
                                <h5 class="text-uppercase">name</h5>
                                <hr>
                                <h5 class="text-uppercase">mail</h5>
                            </center>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <center>
                                <h5 id="userName"></h5>
                                <hr>
                                <h5 id="userMail"></h5>
                            </center>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="middle-div mt-4">
                    <div class="col-lg-12">
                        <h5 class="text-uppercase">message</h5>
                        <h6 class="text-uppercase" id="userMessage"></h6>
                    </div>
                </div>
                <hr>
                <div class="botoom-div mt-4">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-uppercase">Date :- <span id="userDate"></span></h5>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-uppercase">time :- <span id="userTime"></span> </h5>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>



<?php $this->load->view("admin/footer.php"); ?>
<script>
    $('document').ready(function () {
        $('#tableData tr').on('click', '.showmodal', function () {
            $('#myModal').modal('show');
            let id = $(this).closest('tr').find('#conID').text();

            $.ajax({
                method: "get",
                url: "<?php echo base_url() ?>admin/contact/getContactInfo",
                data: { id: id },
                dataType: "json",
                success: function (data) {
                    $('#userName').text(data.name);
                    $('#userMail').text(data.email);
                    $('#userMessage').text(data.message);
                    $('#userDate').text(data.created_at);
                }
            });

        });

    });

      function deleteContact(id) {
      if (confirm("Are you sure want to delete ")) {
        window.location.href = '<?php echo base_url()."admin/contact/delete/"; ?>' + id; 
      }
    }

</script>