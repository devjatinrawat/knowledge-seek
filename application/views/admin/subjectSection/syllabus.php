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
                <h1 class="m-0 text-dark">SYLLABUS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Syllabus</li>
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
                                    <input type="text" name="searchSyllabus" id="search" value="" class="form-control"
                                        placeholder="search" style="width: 200px">
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">

                        </div><br>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table" id="res">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Subject Code</th>
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
<!--                                    Add Syllabus                            -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade bd-example-modal-lg" id="syllabModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="syllabModalHead"></h2>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger add" id="addSyllab">
                            <span aria-hidden="true">Add</span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                            onclick="location.reload()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div style="display:flex; justify-content: space-around; ">
                    <h5>Unit</h5>|
                    <h5>Unit Name</h5>|
                    <h5>Operations</h5>
                </div>
                <div class="container-fluid  mx-auto" id="syllabResults">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" onclick="location.reload()" class="btn btn-secondary"
                    data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>




<!-- -------------------------------------------------------------------------- -->
<!--                                   Add modal                                -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="mymodalHead"></h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    onclick="openSyllabModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="myForm" action="" method="post" class="form-horizontal">
                        <input type="hidden" name="updateSub" id="usub">
                        <input type="hidden" name="getId" id="gd">

                        <div class="form-group">
                            <label for="units">Units</label>
                            <select class="form-control" id="showUnits" name="unit">
                                <option value="">Select Units</option>
                                <?php if($unit_data != ''){
                                    foreach($unit_data as $value){?>
                                <option value="<?php echo $value['id'] ?>">
                                    <?php echo $value['units']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="nm" aria-describedby="helpId"
                                placeholder="Enter the Unit Name" />
                        </div>


                        <div class="form-group">
                            <label for="syllabus">Syallbus</label>
                            <textarea class="form-control" name="syllabus" id="slly" placeholder="Enter the Syllabus"
                                rows="4"></textarea>
                        </div>


                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal"
                    onclick="openSyllabModal()">
                    Close
                </button>
                <button type="button" id="addSyllabusbtn" class="btn btn-primary">

                </button>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------------------------------------------- -->
<!--                                  view modal                                -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade bd-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark" style="color: white;">
                <h2 class="modal-title text-center">View Syllabus Detail</h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    style="color: white;" onclick="openSyllabModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-danger" style="color: white;">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">ID</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="syllabus_id"></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Unit</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="unit_Data"></h5>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Unit Name</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="unit_name"></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div>
                                <h5 style="text-align: left !important;">Syllabus :-</h5>
                            </div>
                            <h5 class="text-justify ml-5" id="syllabus_detail"></h5>
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
            <div class="modal-footer bg-dark">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal"
                    onclick="openSyllabModal()">
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
    //                            ADD Syllabus                               //
    //***********************************************************************//

    $('document').ready(function () {

        $('#result').on('click', '.showSyllab', function () {
            $('#syllabModal').modal('show');
            $('#syllabModalHead').text("SYLLABUS LISTS");
            let subject_id = $(this).val();


            $('#addSyllab').click(function () {
                $('#syllabModal').modal('hide');
                $('#myModal').modal("show");
                $('#mymodalHead').text("SYLLABUS ADD");
                $('#addSyllabusbtn').text("ADD");
                $('#gd').val(subject_id);
                $('#myForm')[0].reset();
                $('#myForm').attr("action", "<?php echo base_url() ?>admin/syllabus/addSyllabus");
            });

            $('#addSyllabusbtn').on("click", function () {
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
                            $('#syllabModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('Syllabus added successfully');
                            showSyllabData();
                            showSyllabus(1);

                        } else if (response.type == "update") {
                            $('#myModal').modal('hide');
                            $('#syllabModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('Syllabus updated successfully');
                            showSyllabData();
                            showSyllabus(1);


                        } else {
                            alert("error");
                        }
                    }
                });
            });




            // **********************************************************************//
            //                           show Syallb                                 //
            //***********************************************************************//


            const showSyllabData = () => {
                let fieldHTML = '';
                $.ajax({
                    url: "<?php echo base_url() ?>admin/syllabus/getSyllabData",
                    method: "get",
                    data: { sub_id: subject_id },
                    dataType: "json",
                    success: function (data) {
                        data['syllab_data'].forEach(syllab_data => {
                            fieldHTML += '<div class="row mt-2" style="background-color: orange; padding:8px; border-radius: 10px; text-align: center;">' +
                                '<div class="col-md-2 col-12" >' +
                                '<h5>' + syllab_data['unit_name'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-8 col-12" style="display: flex;  justify-content: center;">' +
                                '<h5>' + syllab_data['name'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-2 col-12">' +
                                '<div class="row">' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + syllab_data['id'] + '" class="btn btn-sm syllabShowBtn" style="color: #000; ">' +
                                '<i class="fas fa-eye"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + syllab_data['id'] + '" class="btn btn-sm syllabEditwBtn" style="color: gray; ">' +
                                '<i class="fas fa-edit"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button type="button" value="' + syllab_data['id'] + '" class="close syllabDelBtn" style="color: #fff;">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });


                        $('#syllabResults').html(fieldHTML);

                    }
                });
            }
            showSyllabData();



            // **********************************************************************//
            //                          delete Syllab                                //
            //***********************************************************************//

            $('document').ready(function () {
                $('#syllabResults').on('click', '.syllabDelBtn', function () {
                    let id = $(this).val();

                    $('#deleteModal').modal('show');
                    $('#btnDelete').unbind().click(function () {
                        $.ajax({
                            url: "<?php  echo base_url()?>admin/syllabus/deleteSyllab",
                            method: "get",
                            data: { syllab_id: id },
                            dataType: "json",
                            success: function (response) {
                                if (response == "delete") {
                                    $('#deleteModal').modal('hide');
                                    $('#syllabModal').modal('show');
                                    alert('deleted succesfully');
                                    showSyllabData();
                                    showSyllabus(1);
                                }
                            }
                        });
                    });
                });

            })





        })
    });



    // **********************************************************************//
    //                          update syllabus                             //
    //***********************************************************************//


    $('#syllabResults').on('click', '.syllabEditwBtn', function () {
        let id = $(this).val();
        $('#syllabModal').modal('hide');
        $('#myModal').modal('show');
        $('#mymodalHead').text("UPDATE SYLLABUS");
        $('#addSyllabusbtn').text("UPDATE");
        $('#myForm').attr("action", "<?php echo base_url() ?>admin/syllabus/updateSyllabus")

        $.ajax({
            url: "<?php echo base_url()?>admin/syllabus/editSyllabus",
            method: "get",
            data: { syllabus_id: id },
            dataType: "json",
            success: function (data) {
                $('#showUnits').val(data.unit_id);
                $('#nm').val(data.name);
                $('#slly').val(data.syllabus_detail);
                $('#gd').val(data.id);
                $('#usub').val(data.subject_id);
            }
        });


    });


    // **********************************************************************//
    //                         search syllabus                              //
    //***********************************************************************//

    $('#search').on('keyup', function () {
        let search = $(this).val();
        $.ajax({
            url: "<?php echo base_url() ?>admin/syllabus/searchSyllabus",
            method: "get",
            data: { search_data: search },
            dataType: "json",
            success: function (searchData) {
                let html = '';
                if (searchData != '') {
                    searchData.forEach(element => {
                        html += '<tr>' +
                            '<td class="text-center">' + "~" + '</td>' +
                            '<td class="text-center">' + element['sub_name'] + '</td>' +
                            '<td class="text-center">' + element['subject_code'] + '</td>' +
                            ' <td class="text-center pt-5">' +
                            '<button value="' + element['id'] + '" class="btn btn-warning btn-sm showSyllab"><i class="fa fa-plus" aria-hidden="true"></i> ADD SYLLABUS</button>&nbsp' +
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
    //                          show  Syllabus                               //
    //***********************************************************************//
    showSyllabus(1);

    function showSyllabus(page) {
        let html = '';

        $.ajax({
            url: "<?php echo base_url() ?>admin/syllabus/getSyllabusData/" + page,
            method: "get",
            dataType: "json",
            success: function (data) {

                if (data != '') {

                    data['syllabus_data'].forEach(elements => {

                        html += '<tr>' +
                            '<td class="text-center">' + "~" + '</td>' +
                            '<td class="text-center">' + elements['sub_name'] + '</td>' +
                            '<td class="text-center">' + elements['subject_code'] + '</td>' +
                            ' <td class="text-center pt-5">' +
                            '<button value="' + elements['id'] + '" class="btn btn-warning btn-sm showSyllab"><i class="fa fa-plus" aria-hidden="true"></i> ADD SYLLABUS</button>&nbsp' +
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
        showSyllabus(page);
    });
    showSyllabus(1);


    // **********************************************************************//
    //                        VIEW  syllabus                                 //
    //***********************************************************************//

    $('document').ready(function () {
        $('#syllabResults').on('click', '.syllabShowBtn', function () {
            $('#syllabModal').modal('hide');
            $('#viewModal').modal('show');
            let id = $(this).val();
            let con = '';
            $.ajax({
                url: "<?php echo base_url() ?>admin/syllabus/viewSyllabusData",
                method: "get",
                data: { view_id: id },
                dataType: "json",
                success: function (data) {
                    if (data != '') {
                        $('#syllabus_id').html(data.id);
                        $('#unit_Data').html(data.unit_name);
                        $('#unit_name').html(data.name);
                        $('#syllabus_detail').html(data.syllabus_detail);
                        $('#subject_name').html(data.subject_name)
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
            $('#activation').attr("action", "<?php echo base_url() ?>admin/syllabus/updateStatus");
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
                        $('#syllabModal').modal('show');
                        alert("syllabus is activated");
                    } else {
                        $('#viewModal').modal('hide');
                        $('#syllabModal').modal('show');
                        alert("syllabus is deactivated");
                    }
                }
            });
        })
    })

    let openSyllabModal = () => {
        $('#syllabModal').modal('show');
    }


</script>