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
                <h1 class="m-0 text-dark">PAPERS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Papers</li>
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

<div class="modal fade bd-example-modal-lg" id="papersModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="papersModalHead"></h2>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger add" id="addPapersBTN">
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
                    <h5>Paper Name</h5>|
                    <h5>Paper Year</h5>|
                    <h5>Operations</h5>
                </div>
                <div class="container-fluid  mx-auto" id="papersResults">

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
                    onclick="openPaperModal()">
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
                        <label for="name">Papers Name <span style="color: red;">*Paper name same as Subject
                                name*</span></label>
                        <input type="text" class="form-control" name="name" id="nm" aria-describedby="helpId"
                            placeholder="Enter the name" />
                    </div>

                    <div class="form-group">
                        <label for="year">Years</label>
                        <select class="form-control" id="years" name="year">

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="papers">Upload Papers</label>
                        <input type="file" class="form-control" name="paper" id="ePaper" aria-describedby="helpId"
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
                    onclick="openPaperModal()">
                    Close
                </button>
                <button type="button" id="addPaperbtn" class="btn btn-primary">

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
                <h2 class="modal-title text-center">View Papers Detail</h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    onclick="openPaperModal()">
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
                            <h5 class="text-center" id="paper_id"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">NAME</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="paper_name"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">YEAR</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="paper_year"></h5>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">PAPERS PDF</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <center>
                                <embed src="" id="paper_pdf" width="250px" height="150px" /><br>
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
                    onclick="openPaperModal()">
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
    //                            ADD Papers                                 //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on('click', '.addBtn', function () {
            $('#papersModal').modal('show');
            $('#papersModalHead').text("PAPERS LISTS");
            let subject_id = $(this).val();
            $("#subID").val(subject_id);
            // $('#addNotesbtn').text("ADD");

            $("#addPapersBTN").click(function () {
                $('#papersModal').modal('hide');
                $('#myModal').modal("show");
                $('#mymodalHead').text("ADD PAPERS");
                $('#addPaperbtn').text("ADD");
                $('#myForm')[0].reset();
                $('#showpdf').hide();
                $('#myForm').attr("action", "<?php echo base_url() ?>admin/papers/addPapers");
            });

            $('#addPaperbtn').on("click", function () {
                let url = $('#myForm').attr("action");
                let formdata = new FormData();
                if ($('#gd').val() == '') {
                    formdata.append("name", $("#nm").val());
                    formdata.append("year", $("#years").val());
                    formdata.append("subject_id", subject_id);
                    formdata.append("papers", $("#ePaper")[0].files[0]);
                    formdata.append("created_at", "");
                } else {
                    formdata.append("name", $("#nm").val());
                    formdata.append("year", $("#years").val());
                    formdata.append("subject_id", subject_id);
                    formdata.append("papers", $("#ePaper")[0].files[0]);
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
                            $('#papersModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('Papers added successfully');
                            showPapersData();
                            showSubjects(1);

                        } else if (form_data.res == "update") {
                            $('#myModal').modal('hide');
                            $('#papersModal').modal('show');
                            $('#myForm')[0].reset();
                            alert('Papers updated successfully');
                            showPapersData()
                            showSubjects(1);

                        } else {
                            alert(form_data.Error);
                        }
                    }
                });
            })


            // **********************************************************************//
            //                           show papers                                 //
            //***********************************************************************//


            const showPapersData = () => {
                let fieldHTML = '';
                let pro = '';
                $.ajax({
                    url: "<?php echo base_url() ?>admin/papers/getPapersData",
                    method: "get",
                    data: { sub_id: subject_id },
                    dataType: "json",
                    success: function (data) {

                        data['papers_data'].forEach(papers_data => {
                            fieldHTML += '<div class="row mt-2" style="background-color: orange; padding:8px; border-radius: 10px; text-align: center;">' +
                                '<div class="col-md-5  col-12" style="display: flex;  justify-content: flext-start;">' +
                                '<h5>' + papers_data['name'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-5 col-12">' +
                                '<h5 class="text-left">' + papers_data['year'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-2 col-12">' +
                                '<div class="row">' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + papers_data['id'] + '" class="btn btn-sm paperShowBtn" style="color: #000; ">' +
                                '<i class="fas fa-eye"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button value="' + papers_data['id'] + '" class="btn btn-sm paperEditBtn" style="color: gray; ">' +
                                '<i class="fas fa-edit"></i>' +
                                '</button>' +
                                '</div>' +
                                '<div class="col-md-4 col-12">' +
                                '<button type="button" value="' + papers_data['id'] + '" class="close paperDelBtn" style="color: #fff;">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '</button>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        });


                        $('#papersResults').html(fieldHTML);

                    }
                });
            }
            showPapersData();


            // **********************************************************************//
            //                          update Papers                                //
            //***********************************************************************//


            $('#papersResults').on('click', '.paperEditBtn', function () {
                let base = "<?php echo base_url().'public/uploads/papers/'?>";
                let id = $(this).val();
                $('#papersModal').modal('hide');
                $('#myModal').modal('show');
                $('#mymodalHead').text("UPDATE PAPERS");
                $('#addPaperbtn').text("UPDATE");
                $('#showpdf').show();
                $('#warning').text("*IF YOU CHANGE THE NAME THEN REUPLOAD THE SAME PDF*");
                $('#myForm').attr("action", "<?php echo base_url() ?>admin/papers/updatePapers/" + id);

                $.ajax({
                    url: "<?php echo base_url()?>admin/papers/editPaper",
                    method: "get",
                    data: { papers_id: id },
                    dataType: "json",
                    success: function (data) {
                        $('#gd').val(data.id);
                        $('#nm').val(data.name);
                        $('#years').val(data.year);
                        $('#showpdf').attr("src", base + data.papers);

                    }
                });


            });




            // **********************************************************************//
            //                          delete Branches                             //
            //***********************************************************************//

            $('#papersResults').on('click', '.paperDelBtn', function () {
                let id = $(this).val();
                $('#papersModal').modal('hide');
                $('#deleteModal').modal('show');
                $('#btnDelete').unbind().click(function () {
                    $.ajax({
                        url: "<?php echo base_url() ?>admin/papers/deletePapers",
                        method: "get",
                        data: { del_id: id },
                        dataType: "json",
                        success: function (response) {
                            if (response.res == "delete") {
                                $('#deleteModal').modal('hide');
                                $('#papersModal').modal('show');
                                alert('Pagers deleted succesfully');
                                showPapersData()
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
        $.ajax({
            url: "<?php echo base_url() ?>admin/papers/searchPapers",
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
                            '<button value="' + element['id'] + '" class="btn btn-danger btn-sm addBtn"><i class="fas fa-book"></i> <i class="fas fa-plus" style="font-size: 13px;"></i>  ADD PAPERS</button>&nbsp' +
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
            url: "<?php echo base_url() ?>admin/papers/getSubjectData/" + page,
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
                            '<button value="' + elements['id'] + '" class="btn btn-danger btn-sm addBtn"><i class="fas fa-book"></i> <i class="fas fa-plus" style="font-size: 13px;"></i>  ADD PAPERS</button>&nbsp' +
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
    //                         VIEW  Papers                                  //
    //***********************************************************************//

    $('document').ready(function () {
        $('#papersResults').on('click', '.paperShowBtn', function () {
            $('#viewModal').modal('show');
            $('#papersModal').modal('hide');

            let base = "<?php echo base_url().'public/uploads/papers/'?>";
            let id = $(this).val();
            let con = '';
            $.ajax({
                url: "<?php echo base_url() ?>admin/papers/viewPapersData",
                method: "get",
                data: { view_id: id },
                dataType: "json",
                success: function (data) {
                    if (data != '') {
                        $('#paper_id').html(data.id);
                        $('#paper_name').html(data.name);
                        $('#paper_year').html(data.year);
                        $('#paper_pdf').attr("src", base + data.papers);
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
            $('#activation').attr("action", "<?php echo base_url() ?>admin/papers/updateStatus");
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
                        $('#papersModal').modal('show');
                        alert("Paper is activated");
                    } else {
                        $('#viewModal').modal('hide');
                        $('#papersModal').modal('show');
                        alert("Paper is deactivated");
                    }
                }
            });
        })
    })




    $('document').ready(function () {
        let currentYear = new Date().getFullYear()
        max = currentYear - 10;
        let options = "";
        options += '<option>select year</option>';
        for (let year = currentYear; year >= max; year--) {
            options += "<option>" + year + "</option>";
        }

        $('#years').html(options);
    })





    let openPaperModal = () => {
        $('#papersModal').modal('show');
    }



</script>