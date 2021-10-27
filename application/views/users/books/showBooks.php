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
                                        style="color:#191970;">bookS</span>
                                </h1>
                                <h6 class="text-uppercase text-center">Who we
                                    are <i class="fas fa-address-card" style="color:#191970;"></i></h6>

                            </div>
                        </div>
                         <div class="col-lg-6 d-lg-block abImg" data-aos="zoom-in-left" data-aos-duration="2000"><img
                                src="<?php echo base_url().'public/images/Library-cuate.png' ?>" alt=""
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
                            <?php if(!empty($booksData)){ 
                            foreach($booksData as $book){ ?>
                            <div class="card" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom" data-aos-duration="600">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $book['name'] ?>
                                     </h5>
                                     <h4>Author - <span><?php echo $book['author']; ?></span></h4>
                                    <div class="cardsLink">
                                        <a href="<?php echo base_url().'public/uploads/books/'.$book['book'] ?>"
                                            class="btn btn-primary">view</a>
                                        <a href="<?php echo base_url().'users/books/downloadbook/'.$book['book'] ?>"
                                            class="btn btn-primary">download</a>
                                    </div>
                                </div>
                            </div>
                            <?php  } }else{ ?>
                            
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="card-title">BOOKS NOT AVAILABLE</h1>
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