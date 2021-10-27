<?php $this->load->view('users/header.php'); ?>

<section class="Universal-section-page">
    <div class="universalHead">
        <div class="mainContact">
            <div class="container pt-4">
                <div class="papers-heading">
                    <div class="row h-100 align-items-center py-5">
                        <div class="col-lg-6">
                            <div class="service_papers_Heading" data-aos="zoom-in-right" data-aos-duration="2000">
                                <h1 class="text-uppercase text-center papersHeading"> <span
                                        style="color:#191970;">Papers</span>
                                </h1>
                                <!-- <h6 class="text-uppercase text-center">Who we
                                    are <i class="fas fa-address-card" style="color:#191970;"></i></h6> -->

                            </div>
                        </div>
                        <div class="col-lg-6 d-lg-block abImg" data-aos="zoom-in-left" data-aos-duration="2000"><img
                                src="<?php echo base_url().'public/images/contact.png' ?>" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="papers-main-div">
        <img src="<?php echo base_url().'public/images/commingsoon.gif' ?>">
    </div>

    <!-- <div class="container selectSection pt-5">
        <h1>filter your SUBJECTS  for papers 📃</h1>
        <form>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">

                    <select class="form-select form-select-lg mb-3" id="programe">
                        <option selected>Select Programes</option>
                        <?php if(!empty($programe)){
                                        foreach($programe as $prog){?>
                        <option value="<?php echo $prog['id'] ?>">
                            <?php echo $prog['programe_name'] ?>
                        </option>
                        <?php  }
                                    }else{ ?>
                        <option>...</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <select class="form-select form-select-lg mb-3" id="branch">

                    </select>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <select class="form-select form-select-lg mb-3" id="year_or_sem">

                    </select>
                </div>

            </div>
        </form>
    </div> -->
</section>

<!-- <div class="subjects"">
    <div class=" container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                <div class="subResults">
                    <div class="row">
                        <div class="col-12" id="result">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-12">

            </div>
        </div>
    </div>
</div> -->



<?php $this->load->view('users/footer.php'); ?>


<!-- <script>
    // branches //

    const getBranches = () => {
        $('document').ready(function () {
            $('#programe').on("change", function () {
                let prog_id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url().'users/papers/papersAjax' ?>",
                    method: "get",
                    data: { prog_id: prog_id },
                    dataType: "json",
                    success: function (data) {
                        if (data != '') {
                            $('#branch').html(data['branches']);
                        } else {
                            $('#branch').html("<option> Data Not Found</option>");
                        }
                    }
                });
            })
        });
    }
    getBranches();

    // Year or semester //

    const getYear_or_Sems = () => {
        $('document').ready(function () {
            $('#branch').on("change", function () {
                let branch_id = $(this).val();
                $.ajax({
                    url: "<?php echo base_url().'users/papers/papersAjax' ?>",
                    method: "get",
                    data: { branch_id: branch_id },
                    dataType: "json",
                    success: function (data) {
                        if (data != '') {
                            $('#year_or_sem').html(data['year_or_sem']);
                        } else {
                            $('#year_or_sem').html("<option> Data Not Found</option>");
                        }
                    }
                });
            })
        });
    }
    getYear_or_Sems();


    //Subjects //
    const subjects = () => {
        $('document').ready(function () {
            $('#year_or_sem').on("change", function () {
                let prog_id = $('#programe').val();
                let branch_id = $('#branch').val();
                let year_or_sem_id = $(this).val();
                let html = '';
                let base = "<?php echo base_url().'users/papers/showPapers/'?>"
                $.ajax({
                    url: "<?php echo base_url().'users/papers/getSubjects' ?>",
                    method: "get",
                    data: { prog_id: prog_id, branch_id: branch_id, year_or_sem_id: year_or_sem_id },
                    dataType: "json",
                    success: function (data) {

                        if (data['subjects'] != "") {
                            html += '<h2>SUBJECTS</h2>';
                            data['subjects'].forEach(elements => {
                                
                                html += '<div class="subData" style="background-color: ' + randomColor() + ';">'+
                                '<a  href="' + base + elements['subject_id'] + '" target="blank" ><h1>' + elements['sub_name'] + '</h1></a>'+
                                    '</div>';
                            })

                            $('#result').html(html);
                            ;

                        } else {
                             $('#result').html("<h1 style='color: cyan'> Papers not found ☹ </h1>");
                        }
                    }

                });

            })
        });
    }
    subjects();


    // $('document').ready(function () {
    //     $('#search').on("keyup", function () {
    //         let search_val = $(this).val();
    //         let html = '';
    //         let base1 = "<?php echo base_url().'users/papers/showPapers/'?>";
    //         let check = $('#year_or_sem').val();

    //         $.ajax({
    //             url: "<?php echo base_url().'users/papers/searchPapers' ?>",
    //             data: { search_val: search_val },
    //             method: "get",
    //             dataType: "json",
    //             success: function (searchData) {
    //                 if (searchData['searchData'] != '') {
    //                     html += '<h2>SUBJECTS</h2>';
    //                     searchData['searchData'].forEach(Sdata => {
    //                         html += '<h1 class="subData" ><a href="' + base1 + Sdata['id'] + '" target="_blank">' + Sdata['sub_name'] + '</a></h1>'

    //                     })
    //                     $('#result').html(html);

    //                     if (search_val == "" && check == null) {
    //                         $('#result').html("");

    //                     } else if (search_val == "" && check != null) {
    //                         subjects();
    //                     }

    //                 } else {
    //                     $('#result').html("<tr><td>NOT FOUND</td></tr>");
    //                 }
    //             }
    //         });
    //     })
    // })

    const randomColor = () => {
       let colors = [
          '#476072', '#334257', '#5C6E91'
        ];
        let random_color = colors[Math.floor(
            Math.random() * colors.length)];

        return random_color;
    }
randomColor();
</script> -->