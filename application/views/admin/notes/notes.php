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
                <h1 class="m-0 text-dark">NOTES</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Notes</li>
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
                            <!-- <button id="addNotes" type="button" class="btn btn-primary btn-md" data-toggle="modal">
                                <i class="fa fa-school" aria-hidden="true"></i> Add
                            </button> -->
                        </div><br>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table" id="res">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Subject</th>
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
<!--                                    Add NOtes                               -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade bd-example-modal-lg" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="notesModalHead"></h2>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger add" id="addNotesBTN">
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
                    <h5>Unit Name</h5>|
                    <h5>PDF Name </h5>|
                    <h5>Operations</h5>
                </div>
                <div class="container-fluid  mx-auto" id="notesResults">

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
                    onclick="openNoteModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p id="warning" class="text-center" style="color: red;"></p>
                    <form id="myForm" action="" method="post" class="form-horizontal" enctype="multipart/form-data" />
                    <input type="text" name="sub_id" id="subID" hidden>
                    <input type="text" name="getId" id="gd" hidden>

                    <div class="form-group">
                        <label for="name">Notes Name</label>
                        <input type="text" class="form-control" name="name" id="nm" aria-describedby="helpId"
                            placeholder="Enter the name" />
                    </div>

                    <div class="form-group">
                        <label for="unit">Units</label>
                        <select class="form-control" id="showSyllabusUnits" name="syllabusUnits">


                        </select>
                    </div>

                    <div class="form-group">
                        <label for="notes">Upload Notes</label>
                        <input type="file" class="form-control" name="note" id="nts" aria-describedby="helpId"
                            required /><br>
                        <center>
                            <embed src="" id="showpdf" width="400px" height="150px">
                        </center>
                    </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal"
                    onclick="openNoteModal()">
                    Close
                </button>
                <button type="button" id="addNotebtn" class="btn btn-primary">

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
            <div class="modal-header">
                <h2 class="modal-title text-center">View Notes Detail</h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    onclick="openNoteModal()">
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
                            <h5 class="text-center" id="notes_id"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">NOTES NAME</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="notes_name"></h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Syllabus Name</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="sylab_name"></h5>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">NOTES PDF</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <center>
                                <embed src="" id="notes_pdf" width="250px" height="150px" /><br>
                            </center>
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
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal"
                    onclick="openNoteModal()">
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
    //                            ADD Notes                                 //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on('click', '.addBtn', function () {
            $('#notesModal').modal('show');
            $('#notesModalHead').text("NOTES LISTS");
            let subject_id = $(this).val();
            $("#subID").val(subject_id);
            // $('#addNotesbtn').text("ADD");

            $("#addNotesBTN").click(function () {
                getsyllabusData(subject_id);
                $('#notesModal').modal('hide');
                $('#myModal').modal("show");
                $('#mymodalHead').text("ADD NOTES");
                $('#addNotebtn').text("ADD");
                $('#myForm')[0].reset();
                $('#showpdf').hide();
                $('#myForm').attr("action", "<?php echo base_url() ?>admin/notes/addNotes");
            });

            $('#addNotebtn').on("click", function () {
                let url = $('#myForm').attr("action");
                let formdata = new FormData();
                if ($('#gd').val() == '') {
                    formdata.append("name", $("#nm").val());
                    formdata.append("notes", $("#nts")[0].files[0]);
                    formdata.append("subject_id", subject_id);
                    formdata.append("syllabus_id", $("#showSyllabusUnits").val());
                    formdata.append("created_at", "");
                } else {
                    formdata.append("name", $("#nm").val());
                    formdata.append("notes", $("#nts")[0].files[0]);
                    formdata.append("subject_id", subject_id);
                    formdata.append("syllabus_id", $("#showSyllabusUnits").val());
                    formdata.append("updated_at", "");
                }

                $.ajax({
                    url: url,
                    method: "post",
                    data: formdata,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    success: function (form_data) {
                        if (form_data.res == "add") {
                            $('#myModal').modal('hide');
                            $('#notesModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('note added successfully');
                            showNoteData();
                            showSubjects(1);

                        } else if (form_data.res == "update") {
                            $('#myModal').modal('hide');
                            $('#notesModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('Notes updated successfully');
                            showNoteData()
                            showSubjects(1);

                        } else {
                            alert(form_data.Error);
                        }
                    }
                });
            })


            // **********************************************************************//
            //                           show notes                                  //
            //***********************************************************************//


            const showNoteData = () => {
                let fieldHTML = '';
                let pro = '';
                $.ajax({
                    url: "<?php echo base_url() ?>admin/notes/getNotesData",
                    method: "get",
                    data: { sub_id: subject_id },
                    dataType: "json",
                    success: function (data) {

                        data['notes_data'].forEach(notes_data => {
                            fieldHTML += '<div class="row mt-2" style="background-color: orange; padding:8px; border-radius: 10px; text-align: center;">' +
                                '<div class="col-md-5  col-12" style="display: flex;  justify-content: flext-start;">' +
                                '<h5>' + notes_data['unit_name'] + " [" + notes_data['syllab_name'] + "]" + '</h5>' +
                                '</div>' +
                                '<div class="col-md-5 col-12">' +
                                '<h5 class="text-left">' + notes_data['name'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-2 col-12">' +
                                '<div class="row">' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + notes_data['id'] + '" class="btn btn-sm noteShowBtn" style="color: #000; ">' +
                                '<i class="fas fa-eye"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + notes_data['id'] + '" class="btn btn-sm noteEditBtn" style="color: gray; ">' +
                                '<i class="fas fa-edit"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button type="button" value="' + notes_data['id'] + '" class="close noteDelBtn" style="color: #fff;">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });


                        $('#notesResults').html(fieldHTML);

                    }
                });
            }
            showNoteData();


            // **********************************************************************//
            //                          update NOTES                                 //
            //***********************************************************************//


            $('#notesResults').on('click', '.noteEditBtn', function () {
                let base = "<?php echo base_url().'public/uploads/notes/'?>";
                let id = $(this).val();
                $('#notesModal').modal('hide');
                $('#myModal').modal('show');
                $('#mymodalHead').text("UPDATE NOTES");
                $('#addNotebtn').text("UPDATE");
                $('#showpdf').show();
                $('#warning').text("*IF YOU CHANGE THE NAME THEN REUPLOAD THE SAME PDF*");
                $('#myForm').attr("action", "<?php echo base_url() ?>admin/notes/updateNotes/" + id);

                $.ajax({
                    url: "<?php echo base_url()?>admin/notes/editNote",
                    method: "get",
                    data: { notes_id: id },
                    dataType: "json",
                    success: function (data) {
                        $('#gd').val(data.id);
                        $('#nm').val(data.name);
                        getsyllabusData(subject_id, data.syllabus_id);
                        $('#showpdf').attr("src", base + data.notes);

                    }
                });


            });




            // **********************************************************************//
            //                          delete Branches                             //
            //***********************************************************************//

            $('#notesResults').on('click', '.noteDelBtn', function () {
                let id = $(this).val();
                $('#notesModal').modal('hide');
                $('#deleteModal').modal('show');
                $('#btnDelete').unbind().click(function () {
                    $.ajax({
                        url: "<?php echo base_url() ?>admin/notes/deleteNotes",
                        method: "get",
                        data: { del_id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.res == "delete") {
                                $('#deleteModal').modal('hide');
                                $('#notesModal').modal('show');
                                alert('Notes deleted succesfully');
                                showNoteData()
                            }
                        }
                    });
                });
            });


        });
    });

    // **********************************************************************//
    //                         search Notes                                  //
    //***********************************************************************//

    $('#search').on('keyup', function () {
        let search = $(this).val();
        let base = "<?php echo base_url().'public/uploads/notes/'?>";
        $.ajax({
            url: "<?php echo base_url() ?>admin/notes/searchNotes",
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
                            '<button value="' + element['id'] + '" class="btn btn-success btn-sm addBtn"><i class="fas fa-book"></i> <i class="fas fa-plus" style="font-size: 13px;"></i>  ADD NOTES</button>&nbsp' +
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
    //                            show  Subjects                              //
    //***********************************************************************//
    showSubjects(1);

    function showSubjects(page) {
        let html = '';
        $.ajax({
            url: "<?php echo base_url() ?>admin/notes/getSubjectData/" + page,
            method: "get",
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data != '') {
                    data['subjects_data'].forEach(elements => {
                        html += '<tr>' +
                            '<td class="text-center">' + "~" + '</td>' +
                            '<td class="text-center">' + elements['sub_name'] + '</td>' +
                            '<td class="text-center">' + elements['subject_code'] + '</td>' +
                            ' <td class="text-center pt-5">' +
                            '<button value="' + elements['id'] + '" class="btn btn-success btn-sm addBtn"><i class="fas fa-book"></i> <i class="fas fa-plus" style="font-size: 13px;"></i>  ADD NOTES</button>&nbsp' +
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
        showSubjects(page);
    });
    showSubjects(1);


    // **********************************************************************//
    //                         VIEW  Notes                                   //
    //***********************************************************************//

    $('document').ready(function () {
        $('#notesResults').on('click', '.noteShowBtn', function () {
            $('#viewModal').modal('show');
            $('#notesModal').modal('hide');

            let base = "<?php echo base_url().'public/uploads/notes/'?>";
            let id = $(this).val();
            let con = '';
            $.ajax({
                url: "<?php echo base_url() ?>admin/notes/viewNotesData",
                method: "get",
                data: { view_id: id },
                dataType: "json",
                success: function (data) {
                    if (data != '') {
                        $('#notes_id').html(data.id);
                        $('#notes_name').html(data.name);
                        $('#notes_pdf').attr("src", base + data.notes);
                        $('#sylab_name').html(data.unit_name + " " + data.syllab_name);
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
            $('#activation').attr("action", "<?php echo base_url() ?>admin/notes/updateStatus");
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
                        $('#notesModal').modal('show');
                        alert("notes is activated");
                    } else {
                        $('#viewModal').modal('hide');
                        $('#notesModal').modal('show');
                        alert("notes is deactivated");
                    }
                }
            });
        })
    })



    let getsyllabusData = (id, up_id = 0) => {
        let syllab = '';

        $.ajax({
            url: "<?php echo base_url().'admin/notes/getSyllabusData' ?>",
            data: { sub_id: id },
            method: "get",
            dataType: "json",
            success: function (data) {
                if (data != '') {
                    syllab += '<option value="">Select Units</option>';
                    data['syllab_data'].forEach(ele => {

                        syllab += '<option value="' + ele['id'] + '"  id="syllab_select">' + ele['unit_name'] + "  [" + ele['name'] + "]" + '</option>';

                    })
                    $('#showSyllabusUnits').html(syllab);
                    if (up_id > 0) {
                        $('#showSyllabusUnits').val(up_id);
                    }

                }
            }
        });
    }

    let openNoteModal = () => {
        $('#notesModal').modal('show');
    }



</script>