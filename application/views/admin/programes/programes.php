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
                <h1 class="m-0 text-dark">PROGRAMES</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Programes</li>
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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">
                            <form id="searchForm" name="searchForm" method="get" action="">
                                <div class="input-group mb-0">
                                    <input type="text" name="search" id="search" value="" class="form-control"
                                        placeholder="search" style="width: 200px">
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <button id="addPrograme" type="button" class="btn btn-primary btn-md" data-toggle="modal">
                                <i class="fa fa-school" aria-hidden="true"></i> Add
                            </button>
                        </div><br>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table" id="res">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="200">#</th>
                                            <th class="text-center">Programe Name</th>
                                            <th class="text-center">created_at</th>
                                            <th width="200" class="text-center" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="result">
                                    </tbody>
                                </table>
                                <div id="pagination" class="d-flex justify-content-end"></div>
                            </div>
                        </div>
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

<!-- -------------------------------------------------------------------------- -->
<!--                                   Add modal                                -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="mymodalHead"></h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="myForm" action="" method="post" class="form-horizontal">
                        <input type="hidden" name="getId" id="gd">

                        <div class="form-group">
                            <label for="name">Programe Name</label>
                            <input type="text" class="form-control" name="name" id="nm" aria-describedby="helpId"
                                placeholder="Enter the name" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" id="addProgramebtn" class="btn btn-primary">

                </button>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------------------- -->
<!--                                  view modal                                -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center">View Programe Detail</h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">ID</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="prog_id"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Programe Name</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="prog_name"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Status</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                            <form id="activation" method="get" action="">

                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Created at</h5>
                            <h5 class="text-center bg-info" id="creat"></h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Updated at</h5>
                            <h5 class="text-center bg-success" id="updateat"></h5>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>

            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------------------- -->
<!--                                delete modal                                -->
<!-- -------------------------------------------------------------------------- -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Do you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<?php $this->load->view("admin/footer.php"); ?>
<script>



    // **********************************************************************//
    //                            ADD programe                              //
    //***********************************************************************//

    $('document').ready(function () {
        $('#addPrograme').on('click', function () {
            $('#myModal').modal('show');
            $('#mymodalHead').text("ADD PROGRAME");
            $('#addProgramebtn').text("ADD");
            $('#myForm')[0].reset();
            $('#myForm').attr("action", "<?php echo base_url() ?>admin/programe/addPrograme");
        });

        $('#addProgramebtn').click(function () {
            let url = $('#myForm').attr("action");
            let data = $('#myForm').serialize();

            $.ajax({
                url: url,
                method: "post",
                data: data,
                dataType: "json",
                success: function (response) {
                    if (response.type == "add") {
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();
                        alert('Programe added successfully');
                        showPrograme(1);

                    } else if (response.type == "update") {
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();
                        alert('Programe updated successfully');
                        showPrograme(1);

                    } else {
                        alert("error");
                    }
                }
            });

        });
    });

    // **********************************************************************//
    //                          update programe                             //
    //***********************************************************************//


    $('#result').on('click', '.editBtn', function () {

        let id = $(this).val();
        $('#myModal').modal('show');
        $('#mymodalHead').text("UPDATE PROGRAME");
        $('#addProgramebtn').text("UPDATE");
        $('#myForm').attr("action", "<?php echo base_url() ?>admin/programe/updatePrograme")

        $.ajax({
            url: "<?php echo base_url()?>admin/programe/editPrograme",
            method: "get",
            data: { prog_id: id },
            dataType: "json",
            success: function (data) {
                $('#nm').val(data.programe_name);
                $('#gd').val(data.id);

            }
        });


    });

    // **********************************************************************//
    //                          delete programe                             //
    //***********************************************************************//
    $('document').ready(function () {
        $('#result').on('click', '.deleteBtn', function () {
            let id = $(this).val();

            $('#deleteModal').modal('show');
            $('#btnDelete').unbind().click(function () {
                $.ajax({
                    url: "<?php echo base_url() ?>admin/programe/deletePrograme",
                    method: "get",
                    data: { del_id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.res == "delete") {
                            $('#deleteModal').modal('hide');
                            alert('Programe deleted succesfully');
                            showPrograme(1);
                        }
                    }
                });
            });
        });

    })

    // **********************************************************************//
    //                         search programe                              //
    //***********************************************************************//

    $('#search').on('keyup', function () {
        let search = $(this).val();
        $.ajax({
            url: "<?php echo base_url() ?>admin/programe/searchPrograme",
            method: "get",
            data: { search_data: search },
            dataType: "json",
            success: function (searchData) {
                let html = '';
                if (searchData != '') {
                    searchData.forEach(element => {
                        html += '<tr>' +
                            '<td class="text-center">~</td>' +
                            '<td class="text-center">' + element['programe_name'] + '</td>' +
                            '<td class="text-center">' + element['created_at'] + '</td>' +
                            ' <td class="text-center pt-5" colspan="3">' +
                            '<button id="editBtn" value="' + element['id'] + '" class="btn btn-primary btn-sm editBtn"><i class="fas fa-edit"></i></button>&nbsp' +
                            '<button value="' + element['id'] + '" class="btn btn-success btn-sm viewBtn"><i class="fas fa-eye"></i></button>&nbsp' +
                            '<button value="' + element['id'] + '"  class="btn btn-danger btn-sm deleteBtn" > <i class="fas fa-trash"></i></button >' +
                            ' </td> ' +
                            '</tr>';
                    });
                } else {
                    html = '<tr>' +
                        '  <td colspan="7">Records not found</td>' +
                        '</tr>';
                }
                $('#pagination').hide();
                $('#result').html(html);

            }
        });
    });

    // **********************************************************************//
    //                          show  programe                              //
    //***********************************************************************//
    showPrograme(1);

    function showPrograme(page) {
        let html = '';
        $.ajax({
            url: "<?php echo base_url() ?>admin/programe/getProgrameData/" + page,
            method: "get",
            dataType: "json",
            success: function (data) {

                if (data != '') {
                    data['prog_data'].forEach(elements => {
                        html += '<tr>' +
                            '<td class="text-center"> ~ </td>' +
                            '<td class="text-center">' + elements['programe_name'] + '</td>' +
                            '<td class="text-center">' + elements['created_at'] + '</td>' +
                            ' <td class="text-center pt-5">' +
                            '<button id="editBtn" value="' + elements['id'] + '" class="btn btn-primary btn-sm editBtn"><i class="fas fa-edit"></i></button>&nbsp' +
                            '<button id="viewBtn" value="' + elements['id'] + '" class="btn btn-success btn-sm viewBtn"><i class="fas fa-eye"></i></button>&nbsp' +
                            '<button value="' + elements['id'] + '" " class="btn btn-danger btn-sm deleteBtn" > <i class="fas fa-trash"></i></button >' +
                            ' </td> ' +
                            '</tr>';
                    });
                } else {
                    html = '<tr>' +
                        '  <td colspan="7">Records not found</td>' +
                        '</tr>';
                };
                $('#pagination').html(data['pagination_link']);
                $('#result').html(html);

            }
        });

    }

    $(document).on("click", ".pagination li a", function (event) {
        event.preventDefault();
        let page = $(this).data("ci-pagination-page");
        showPrograme(page);
    });
    showPrograme(1);


    // **********************************************************************//
    //                        VIEW  programe                              //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on('click', '.viewBtn', function () {
            $('#viewModal').modal('show');
            let id = $(this).val();
            let con = '';
            $.ajax({
                url: "<?php echo base_url() ?>admin/programe/viewProgrameData",
                method: "get",
                data: { view_id: id },
                dataType: "json",
                success: function (data) {
                    if (data != '') {
                        $('#prog_id').html(data.id);
                        $('#prog_name').html(data.programe_name);
                        $('#creat').html(data.created_at);
                        $('#updateat').html(data.updated_at);
                        if (data.status == 1) {
                            con = '<button  value="' + data.id + '" class="btn btn-success btn-sm opBtn"> Active</button>';
                        } else {
                            con = '<button  value="' + data.id + '" class="btn btn-danger btn-sm opBtn"> Deactive</button>';
                        }
                        $('#activation').html(con);
                    }
                }
            });

        });

        $('#activation').on('click', ".opBtn", function (e) {
            e.preventDefault();
            $('#activation').attr("action", "<?php echo base_url() ?>admin/programe/updateStatus");
            let url = $('#activation').attr("action");
            let id = $(this).val();
            $.ajax({
                url: url,
                method: "get",
                data: { stat_id: id },
                dataType: "json",
                success: function (activedata) {
                    if (activedata == "activate") {
                        $('#viewModal').modal('hide');
                        alert("programe is activated");
                    } else {
                        $('#viewModal').modal('hide');
                        alert("programe is deactivated");
                    }
                }
            });
        })
    })




</script>