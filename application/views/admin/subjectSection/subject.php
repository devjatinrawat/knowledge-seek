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
                <h1 class="m-0 text-dark">SUBJECTS</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
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
                                    <input type="text" name="searchSubject" id="search" value="" class="form-control"
                                        placeholder="search" style="width: 200px">
                                </div>
                            </form>
                        </div>
                        <div class="card-tools">
                            <button id="addSubject" type="button" class="btn btn-primary btn-md" data-toggle="modal">
                                <i class="fa fa-school" aria-hidden="true"></i> Add
                            </button>
                        </div><br>
                        <div class="card-body">
                            <div style="overflow-x:auto;">
                                <table class="table" id="res">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center" width="300">Subject Name</th>
                                            <th class="text-center" width="200">Subject Code</th>
                                            <th class="text-center" width="100">Branch</th>
                                            <th class="text-center" width="100">Sem/Years</th>
                                            <th width="300" class="text-center" colspan="4">Action</th>
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
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                        <input type="hidden" name="upID" id="hiddenField">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="nm" aria-describedby="helpId"
                                placeholder="Enter the name" />
                        </div>

                        <div class="form-group">
                            <label for="code">Subject Code</label>
                            <input type="text" class="form-control" name="code" id="cd" aria-describedby="helpId"
                                placeholder="Enter the code" />
                        </div>

                        <div class="form-group" id="branchHide">
                            <label for="branch">Branches</label><br>
                            <select class="form-control" id="branch" name="branches">
                                <option>Select Branch</option>
                                <?php if($branchData != ''){
                                    foreach($branchData as $value){?>
                                <option value="<?php echo $value['id'] ?>">
                                    <?php echo $value['branch_name']; ?>
                                </option>
                                <?php
                                       } } ?>

                            </select>
                        </div>


                        <div class="form-group" id="showYos">
                            <label for="yos">Year/Semester</label><br>
                            <select class="form-control" name="yos[]" id="showYOS" data-width="100%"
                                data-live-search="true" title="Select YEAR/SEMESTER" multiple>
                                <?php if($yos_data != ''){
                                    foreach($yos_data as $value){?>
                                <option value="<?php echo $value['id'] ?>">
                                    <?php echo $value['sem_year']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" id="addSubjectbtn" class="btn btn-primary">

                </button>
            </div>
        </div>
    </div>
</div>


<!-- -------------------------------------------------------------------------- -->
<!--                              Add branch and year modal                     -->
<!-- -------------------------------------------------------------------------- -->
<div class="modal fade" id="myAddModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="addmodalHead"></h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    onclick="showLists()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="myAddForm" action="" method="post" class="form-horizontal">
                        <input type="hidden" name="fieldID" id="hiddenFields">
                        <div class="form-group">
                            <label for="branch">Branches</label><br>
                            <select class="form-control" id="branchField" name="branchesFields">
                                <option>Select Branch</option>
                                <?php if($branchData != ''){
                                    
                                    foreach($branchData as $values){ ?>

                                <option value="<?php echo $values['id'] ?>">
                                    <?php echo $values['branch_name']; ?>
                                </option>

                                <?php  } } ?>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="yos">Year/Semester</label><br>
                            <select class="form-control" name="yosFields[]" id="showYOSFields" data-width="100%"
                                data-live-search="true" title="Select YEAR/SEMESTER" multiple>
                                <?php if($yos_data != ''){
                                    foreach($yos_data as $vals){?>
                                <option value="<?php echo $vals['id'] ?>">
                                    <?php echo $vals['sem_year']; ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>

                            </select>
                        </div>

                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="colse" class="btn btn-secondary" data-dismiss="modal" onclick="showLists()">
                    Close
                </button>
                <button type="button" id="addFieldsbtn" class="btn btn-primary">

                </button>
            </div>
        </div>
    </div>
</div>



<!-- -------------------------------------------------------------------------- -->
<!--                              Add branch and year modal                     -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade bd-example-modal-lg" id="fieldsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-center" id="fieldsModalHead"></h2>
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-danger add" id="addFields">
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
                    <h5>Branch</h5>|
                    <h5>Sem/Year</h5>|
                    <h5>Operations</h5>
                </div>
                <div class="container-fluid  mx-auto" id="fieldResults">

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
<!--                                  view modal                                -->
<!-- -------------------------------------------------------------------------- -->

<div class="modal fade bd-example-modal-lg" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark" style="color: white;">
                <h2 class="modal-title text-center">View Subject Detail</h2>
                <button type="button" class="close" id="closeX" data-dismiss="modal" aria-label="Close"
                    style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-danger" style="color: white;">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Subject Name</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="subject_name"></h5>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center">Subject Code</h5>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h5 class="text-center" id="subject_code"></h5>
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
<div id="subjectDeleteModal" class="modal fade" tabindex="-1" role="dialog">
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
                <button type="button" id="subDeleteBtn" class="btn btn-danger">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<?php $this->load->view("admin/footer.php"); ?>
<script>


    // **********************************************************************//
    //                            ADD FIELDS                                 //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on("click", ".addbtn", function () {
            $('#fieldsModal').modal("show");
            $('#fieldsModalHead').text("LISTS");
            const subjectID = $(this).val();
            $('#hiddenFields').val(subjectID);

            $('#fieldsModal').on("click", "#addFields", function () {
                $('#myAddModal').modal("show");
                $('#fieldsModal').modal("hide");
                $('#addmodalHead').text("Add more branches");
                $('#addFieldsbtn').text("ADD");
                $('#showYOSFields').selectpicker('refresh');
                $('#myAddForm')[0].reset();
                $('#myAddForm').attr("action", "<?php echo base_url() ?>admin/Subject/addSubjectFields")
            })

            $('#addFieldsbtn').on("click", function () {

                let action_url = $('#myAddForm').attr("action");
                let field_Data = $('#myAddForm').serialize();

                $.ajax({
                    url: action_url,
                    data: field_Data,
                    method: "post",
                    dataType: "json",
                    success: function (response) {
                        if (response.type == "addField") {
                            $('#myAddModal').modal("hide");
                            showFields();
                            $('#fieldsModal').modal("show");
                            $('#myAddForm')[0].reset();
                            $('#showYOSFields').selectpicker('refresh');
                        }
                    }
                });

            })

            // **********************************************************************//
            //                           show FIELDS                                 //
            //***********************************************************************//


            const showFields = () => {
                let fieldHTML = '';
                let pro = '';
                $.ajax({
                    url: "<?php echo base_url() ?>admin/subject/getSubjectsFeild",
                    method: "get",
                    data: { sub_id: subjectID },
                    dataType: "json",
                    success: function (data) {
                        data['branchDetail'].forEach(branchData => {
                            fieldHTML += '<div class="row mt-2" style="background-color: orange; padding:8px; border-radius: 10px; text-align: center;">' +
                                '<div class="col-md-2 col-12" id="branchName">' +
                                '<h5>' + branchData['branchName'] + '</h5>' +
                                '</div>' +
                                '<div class="col-md-8 col-12" style="display: flex;  justify-content: center;">';


                            data['sem_year_Detail'].forEach(sem_year_Detail => {
                                if (branchData['branchID'] == sem_year_Detail['branch_id']) {
                                    fieldHTML += '<h5>' + sem_year_Detail['sem_year_Name'] + '/' + '</h5>';
                                }
                            })

                            fieldHTML += '</div>' +
                                '<div class="col-md-2 col-12">' +
                                '<button type="button" value="' + branchData['subject_id'] + '"  data-value="' + branchData['branch_id'] + '" class="close fieldDelBtn" style="color: #fff;">' +
                                '<span aria-hidden="true">&times;</span>' +
                                '  </button>' +
                                '</div>' +
                                '</div>';

                        });

                        $('#fieldResults').html(fieldHTML);

                    }
                });
            }
            showFields();

            // **********************************************************************//
            //                          delete FIELDS                                //
            //***********************************************************************//

            $('document').ready(function () {
                $('#fieldResults').on('click', '.fieldDelBtn', function () {
                    let subs_id = $(this).val();
                    let branch_id = $(this).attr("data-value");

                    $.ajax({
                        url: "<?php  echo base_url()?>admin/subject/deleteField",
                        method: "get",
                        data: { subs_id: subs_id, branch_id: branch_id },
                        dataType: "json",
                        success: function (response) {
                            if (response == "deleteFields") {
                                alert("this branch is deleted");
                                showFields();
                            }
                        }
                    });
                });

            })


        })
    });



    // **********************************************************************//
    //                            ADD Subjects                               //
    //***********************************************************************//

    $('document').ready(function () {

        $('#addSubject').on('click', function () {
            $('#myModal').modal('show');
            $('#mymodalHead').text("ADD SUBJECT");
            $('#addSubjectbtn').text("ADD");
            $('#myForm')[0].reset();
            $('#showYOS').selectpicker('refresh');
            $('#myForm').attr("action", "<?php echo base_url() ?>admin/Subject/addSubject");
        });

        $('#addSubjectbtn').click(function () {
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
                        $('#showYOS').selectpicker('refresh');
                        alert('Subject added successfully');
                        showSubjects(1);
                    }
                    else if (response.type == "update") {
                        $('#myModal').modal('hide');
                        $('#myForm')[0].reset();
                        $('#showYOS').selectpicker('refresh');
                        alert('Subject updated successfully');
                        showSubjects(1);
                    }
                    else {
                        alert("error");
                    }
                }
            });

        });
    });

    // **********************************************************************//
    //                          update Subjects                              //
    //***********************************************************************//


    $('#result').on('click', '.editBtn', function () {

        let id = $(this).val();

        $('#myModal').modal('show');
        $('#mymodalHead').text("UPDATE SUBJECTS");
        $('#addSubjectbtn').text("UPDATE");
        $('#myForm').attr("action", "<?php echo base_url() ?>admin/subject/updateSubject")


        $.ajax({
            url: "<?php echo base_url()?>admin/subject/editSubject",
            method: "get",
            data: { edit_id: id },
            dataType: "json",
            success: function (data) {
                $('#nm').val(data['subjects'].sub_name);
                $('#cd').val(data['subjects'].subject_code);
                $('#hiddenField').val(data['subjects'].id);

                $('#branchHide').hide();
                $("#showYos").hide();
                // $("#showYOS option[value='" + elements['programe_id'] + "']").prop("selected", true).trigger("change");


            }
        });


    });

    // **********************************************************************//
    //                          delete Subjects                              //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on('click', '.deleteBtn', function () {
            let id = $(this).val();

            $('#subjectDeleteModal').modal('show');
            $('#subDeleteBtn').unbind().click(function () {
               
                $.ajax({
                    url: "<?php echo base_url() ?>admin/Subject/deleteSubject",
                    method: "get",
                    data: { delete_id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.res === "delete") {
                            
                            $('#subjectDeleteModal').modal('hide');
                            
                            alert('Subject deleted succesfully'); 
                            location.reload();
                            showSubjects(1);
                        }
                    }
                });
            });
        });

    })

    // **********************************************************************//
    //                         search Subjects                               //
    //***********************************************************************//

    $('#search').on('keyup', function () {
        let search = $(this).val();
        $.ajax({
            url: "<?php echo base_url() ?>admin/subject/searchSubject",
            method: "get",
            data: { search_data: search },
            dataType: "json",
            success: function (searchData) {
                let html = '';
                if (searchData != '') {
                    searchData.forEach(element => {
                        html += '<tr>' +
                            '<td class="text-center">~</td>' +
                            '<td class="text-center">' + element['sub_name'] + '</td>' +
                            '<td class="text-center">' + element['sub_code'] + '</td>' +
                            '<td class="text-center">' + element['branches'] + '</td>' +
                            '<td class="text-center">' + element['sems_years'] + '</td>' +
                            ' <td class="text-center pt-5" colspan="4">' +
                            '<button id="addBtn" value="' + element['sub_id'] + '" class="btn btn-warning btn-sm addbtn"><i class="fas fa-graduation-cap "><i class="fas fa-plus "></i></i></button>&nbsp' +
                            '<button id="editBtn" value="' + element['sub_id'] + '" class="btn btn-primary btn-sm editBtn"><i class="fas fa-edit"></i></button>&nbsp' +
                            '<button value="' + element['sub_id'] + '" class="btn btn-success btn-sm viewBtn"><i class="fas fa-eye"></i></button>&nbsp' +
                            '<button value="' + element['sub_id'] + '"  class="btn btn-danger btn-sm deleteBtn" > <i class="fas fa-trash"></i></button >' +
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
    //                          show  Subjects                                //
    //***********************************************************************//
    showSubjects(1);

    function showSubjects(page) {
        let html = '';
        $.ajax({
            url: "<?php echo base_url() ?>admin/subject/getSubjectData/" + page,
            method: "get",
            dataType: "json",
            success: function (data) {

                if (data != '') {
                    data['subject_detail_data'].forEach(elements => {
                        html += '<tr>' +
                            '<td class="text-center">~</td>' +
                            '<td class="text-center">' + elements['sub_name'] + '</td>' +
                            '<td class="text-center">' + elements['sub_code'] + '</td>' +
                            '<td class="text-center">' + elements['branches'] + '</td>' +
                            '<td class="text-center">' + elements['sems_years'] + '</td>' +
                            ' <td class="text-center pt-5">' +
                            '<button id="addBtn" value="' + elements['sub_id'] + '" class="btn btn-warning btn-sm addbtn"><i class="fas fa-graduation-cap "><i class="fas fa-plus "></i></i></button>&nbsp' +
                            '<button id="editBtn" value="' + elements['sub_id'] + '" class="btn btn-primary btn-sm editBtn"><i class="fas fa-edit"></i></button>&nbsp' +
                            '<button id="viewBtn" value="' + elements['sub_id'] + '" class="btn btn-success btn-sm viewBtn"><i class="fas fa-eye"></i></button>&nbsp' +
                            '<button value="' + elements['sub_id'] + '" " class="btn btn-danger btn-sm deleteBtn" > <i class="fas fa-trash"></i></button >' +
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
    //                        View  Subjects                                 //
    //***********************************************************************//

    $('document').ready(function () {
        $('#result').on('click', '.viewBtn', function () {
            $('#viewModal').modal('show');
            let sub_id = $(this).val();
            let con = '';
            let bch = '';
            $.ajax({
                url: "<?php echo base_url() ?>admin/subject/viewSubjectData",
                method: "get",
                data: { view_id: sub_id },
                dataType: "json",
                success: function (data) {
                    let subjectsData = data['fetchSubjects'];
                    $('#subject_name').html(subjectsData.sub_name);
                    $('#subject_code').html(subjectsData.subject_code);
                    $('#creat').html(subjectsData.created_at);
                    $('#updateat').html(subjectsData.updated_at);

                    if (subjectsData.status == 1) {
                        con = '<button  value="' + subjectsData.id + '" class="btn btn-success btn-sm opBtn"> Active</button>';
                    } else {
                        con = '<button  value="' + subjectsData.id + '" class="btn btn-danger btn-sm opBtn"> Deactive</button>';
                    }
                    $('#activation').html(con);
                }
            });

        });

        $('#activation').on('click', ".opBtn", function (e) {
            e.preventDefault();
            $('#activation').attr("action", "<?php echo base_url() ?>admin/subject/updateStatus");
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
                        alert("subject is activated");
                    } else {
                        $('#viewModal').modal('hide');
                        alert("subject is deactivated");
                    }
                }
            });
        })
    })

    $(document).ready(function () {
        $('#showYOS').selectpicker();
        $('#showYOSFields').selectpicker();

    });

    const showLists = () => {
        $('#fieldsModal').modal("show");
    }


</script>