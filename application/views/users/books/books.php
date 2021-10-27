<?php $this->load->view('users/header.php'); ?>

<section class="Universal-section-page">
    <div class="universalHead">
        <div class="mainContact">
            <div class="container pt-4">
                <div class="papers-heading">
                    <div class="row h-100 align-items-center py-5">
                        <div class="col-lg-6">
                            <div class="service_papers_Heading" data-aos="zoom-in-right" data-aos-duration="2000">
                                <h1 class="text-uppercase text-center papersHeading"><span
                                        style="color:#191970;">Books</span>
                                </h1>
                                <!-- <h6 class="text-uppercase text-center">Who we
                                    are <i class="fas fa-address-card" style="color:#191970;"></i></h6> -->

                            </div>
                        </div>
                         <div class="col-lg-6 d-lg-block abImgBooks" data-aos="zoom-in-left" data-aos-duration="2000"><img
                                src="<?php echo base_url().'public/images/Library-cuate.png' ?>" alt="" 
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container selectSection pt-5">
        <h1>📚search Books📚</h1>   
        <center><input type="text" class="form-control searchInput" name="searchSubjects" id="search"
                placeholder="Search">
        </center>

    </div>
</section>

<div class="subjects"">
    <div class=" container">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="subResults">
                <div class="row">
                    <div class="col-12" id="result">
                        <h2>SUBJECTS</h2>

                        <?php if(!empty($subjects)){ 
                            foreach($subjects as $sub){ ?>
                        <div class="subData">
                            <a href="<?php echo base_url().'users/books/showBooks/'.$sub['subject_id']; ?>" id="color"
                                target="blank">
                                <h1>
                                    <?php echo $sub['sub_name'] ?>
                                </h1>
                            </a>

                        </div>
                        <?php  } }else{ ?>
                        <center>
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">BOOK  NOT FOUND</h1>
                                </div>
                            </div>
                        </center>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-12 col-12">

        </div>
    </div>
</div>
</div>



<?php $this->load->view('users/footer.php'); ?>


<script>

    $('document').ready(function () {
        $('#search').on("keyup", function () {
            let search_val = $(this).val();
            $('#result').hide();
            let html = '';
            let base1 = "<?php echo base_url().'users/books/showBooks/'?>";

            $.ajax({
                url: "<?php echo base_url().'users/books/searchBooks' ?>",
                data: { search_val: search_val },
                method: "get",
                dataType: "json",
                success: function (sData) {
                    if (sData['searchData'] != []) {
                        html += '<h2>SUBJECTS</h2>';
                        sData['searchData'].forEach(Sdata => {
                            html += '<div class="subData" style="background-color: ' + randomColor() + ';">' +
                                '<a href="' + base1 + Sdata['id'] + '" target="blank"><h1>' + Sdata['sub_name'] + '</h1></a>' +
                                '</div>';
                        })
                        $('#result').html(html);
                        $('#result').show();

                    } else {
                         $('#result').html("<h1 style='color: cyan'> Book not found ☹ </h1>");
                        $('#result').show();
                    }
                }
            });
        })
    })


    const randomColor = () => {
        let colors = [
             '#476072', '#334257', '#5C6E91'
        ];
        let random_color = colors[Math.floor(
            Math.random() * colors.length)];

        return random_color;
    }



    const randColor = () => {
        let colors = [
             '#476072', '#334257', '#5C6E91'
        ];
        let random_color = colors[Math.floor(
            Math.random() * colors.length)];

        $('.subData').css("background", random_color);

    }
    randColor();
</script>