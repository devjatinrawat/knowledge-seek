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
                <h1 class="m-0 text-dark">Comments</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'article' ?>">Article</a></li>
                    <li class="breadcrumb-item">Comments</li>
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
                <?php if($this->session->flashdata('deleteComment') != "") { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('deleteComment');?>
                </div>
                <?php }?>

                <?php if($this->session->flashdata('deleteReply') != "") { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('deleteReply');?>
                </div>
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
                                        <th width="400" class="text-center">comment</th>
                                        <th width="200" class="text-center">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                      if(!empty($comments)) { ?>
                                    <?php foreach ($comments as $value) {
                            
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
                                            <?php echo $value['comment']; ?>
                                        </td>
                                        <td class="text-center">
                                            <button id="viewReplyModal"
                                                class="btn btn-outline-success btn-sm ml-2 showmodal"
                                                onclick="showReplies(<?php echo $value['id']; ?>)"><i
                                                    class="fas fa-eye"></i></button>
                                            <a href="javascript:void(0);"
                                                onclick="deleteComment(<?php echo $value['id']; ?>, <?php echo $value['article_id']; ?>)"
                                                class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
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
                        <!-- <?php echo $pagination_link; ?> -->
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="viewReplyModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase  text-cyan" id="exampleModalLabel"><b>Replies</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-x:auto;">
                <table class="table" id="tableData">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">E-Mail</th>
                            <th width="600" class="text-center">Reply</th>
                            <th width="100" class="text-center">Action</th>

                        </tr>
                    </thead>

                    <tbody id="replyTable">

                        <td class="text-center">

                            <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </td>
                        </tr>

                    </tbody>
                </table>

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


    function deleteComment(id, article_id) {
        if (confirm("Are you sure want to delete ")) {
            window.location.href = '<?php echo base_url()."admin/comment/delete/"; ?>' + id + '/' + article_id;
        }
    }

    $('document').ready(function () {
        $('#replyTable').on('click', '.deleteReply', function () {
            let del_id = $(this).attr("data-id");
            let article_id = $(this).attr("data-articleId");
            if (confirm("Are you sure want to delete ")) {
                window.location.href = '<?php echo base_url()."admin/comment/deleteReply/"; ?>' + del_id + '/' + article_id;
            }
        })
    });

    function showReplies(id) {
        $('#myModal').modal('show');

        let tableHtml = "";

        $.ajax({
            url: "<?php echo base_url() ?>admin/comment/getReplies",
            method: "get",
            data: { id: id },
            dataType: "json",
            success: function (data) {
                if (data['reply'] == null) {
                    tableHtml += '<tr><td>REPLIES NOT FOUND</td></tr>';

                } else {
                    data['reply'].forEach(element => {
                        tableHtml += '<tr>' +
                            '<td class="text-center">' + element['name'] + '</td>' +
                            '<td class="text-center">' + element['email'] + '</td>' +
                            '<td class="text-center">' + element['reply'] + '</td>' +
                            '<td class="text-center"><a href="javascript:void(0);" data-id="' + element['id'] + '" data-articleId="' + element['article_id'] + '" class="btn btn-outline-danger btn-sm deleteReply" ><i class="fas fa-trash"></i></a></td>' +
                            '</tr>';
                    });
                }

                $('#replyTable').html(tableHtml);
            }
        });
    }

</script>