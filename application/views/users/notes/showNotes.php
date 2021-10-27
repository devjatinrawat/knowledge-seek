<?php $this->load->view('users/extraNavServ.php'); ?>

<section class="Universal-section-page">
    <div class="SHead">
        <div class="mainContact">
            <div class="container pt-4">
                <div class="notes-heading">
                    <div class="row h-100 align-items-center py-5">
                        <div class="col-lg-6">
                            <div class="service_notes_Heading" data-aos="zoom-in-right" data-aos-duration="2000">
                                <h1 class="text-uppercase text-center notesHeading">OUR <span
                                        style="color:#191970;">SYLLABUS</span>
                                </h1>
                                <!-- <h6 class="text-uppercase text-center">Who we
                                    are <i class="fas fa-address-card" style="color:#191970;"></i></h6> -->

                            </div>
                        </div>
                         <div class="col-lg-6 d-lg-block abImg" data-aos="zoom-in-left" data-aos-duration="2000"><img
                                src="<?php echo base_url().'public/images/syllabus.png' ?>" alt=""
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="syllab">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                <div class="syllabus">
                    <div class="row">
                        <div class="col-12">
                            <?php if(!empty($notesData)){ 
                            foreach($notesData as $note){ ?>
                            <div class="card" data-aos="fade-up"
                                         data-aos-anchor-placement="top-bottom" data-aos-duration="600">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo "👉🏻 ".$note['units']?><br>
                                         <span style="color:purple"><?php echo $note['name']?></span>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $note['syllabus_detail'] ?>
                                    </p>
                                    <div class="cardsLink">
                                        <a href="<?php echo base_url().'public/uploads/notes/'.$note['notes'] ?>"
                                            class="btn btn-primary">view</a>
                                        <a href="<?php echo base_url().'users/notes/downloadNote/'.$note['notes'] ?>"
                                            class="btn btn-primary">download</a>
                                    </div>
                                </div>
                            </div>
                            <?php  } }else{ ?>
                            
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title">NOTES NOT AVAILABLE</h1>
                                    </div>
                                </div>
                
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


</script>