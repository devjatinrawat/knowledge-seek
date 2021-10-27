<?php  $this->load->view('users/header'); ?>

<section class="Universal-section-page">
    <div class="universalHead">
        <div class="mainContact">
            <div class="container pt-4">
                <div class="contact-heading">
                    <div class="row h-100 align-items-center py-5">
                        <div class="col-lg-6">
                            <div class="service_contact_Heading" data-aos="zoom-in-right" data-aos-duration="2000">
                                <h1 class="text-uppercase text-center contactUsHeading"><span
                                        style="color:#191970;">Contact</span> Us</h1>
                                <h6 class="text-uppercase text-center">We'd <i class=" fas fa-heart"
                                        style="color:darkblue"></i> to help</h6>

                            </div>
                        </div>
                        <div class="col-lg-6 d-lg-block abImgContact" data-aos="zoom-in-left" data-aos-duration="2000">
                            <img src="<?php echo base_url().'public/images/contact.png' ?> " alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="contact-form-div py-4">
        <div class="container py-4">
            <div class="contactinfo">
                <h5 text-capitalize><span class="contactText"></span></h5>
            </div>

            <div class="row align-items-center contactForm" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="contact-img text-center">
                        <img src="<?php echo base_url().'public/images/55562-boy-using-social-media-on-phone.gif' ?>">
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-div mt-5">
                        <form class="form" action="<?php echo base_url().'users/pages/contactUs'; ?>" method="POST">
                            <div class="form-group py-2">
                                <label class="pb-1" for="name"><span><i style="color: darkblue;" class="fas fa-user"
                                            aria-hidden="true"></i></span> Name</label>
                                <input type="text"
                                    class="form-control  <?php echo (form_error('name') != '')? 'is-invalid' : ''; ?>"
                                    name="name" id="name" aria-describedby="helpId"
                                    value="<?php echo set_value('name'); ?>" placeholder="ENTER YOUR NAME">
                                <?php echo form_error('name');  ?>
                            </div>

                            <div class="form-group py-2">
                                <label class="pb-1" for="email"><span><i style="color: darkblue;"
                                            class="fas fa-envelope" aria-hidden="true"></i></span> Email</label>
                                <input type="text"
                                    class="form-control <?php echo (form_error('email') != '')? 'is-invalid' : ''; ?>"
                                    name="email" id="email" value="<?php echo set_value('email'); ?>"
                                    aria-describedby="helpId" placeholder="ENTER YOUR EMAIL">
                                <?php echo form_error('email'); ?>
                            </div>

                            <div class="form-group py-2">
                                <label class="pb-1" for="message"><span><i style="color: darkblue;"
                                            class="fas fa-comment-alt" aria-hidden="true"></i></span> Message</label>
                                <textarea
                                    class="form-control <?php echo (form_error('message') !='')? 'is-invalid': ''; ?>"
                                    id="mssg" name="message" rows="4"
                                    placeholder="ENTER YOUR MESSAGE"><?php echo set_value('message'); ?></textarea>
                                <?php echo form_error('message'); ?>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-warning my-3">Submit</button>
                            </center>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>

<?php  $this->load->view('users/footer'); ?>

<?php  
$mssg=$this->session->flashdata('mssg');
if(!empty($mssg)) { ?>
<script type="text/javascript">
    //let mssg = <?php echo $mssg; ?>;
    $(document).ready(function () {

        swal({
            title: "<?php echo $mssg; ?>",
            text: "We will get back to you soon.",
            icon: "success",
            button: false
        });

    });
</script>

<?php }
  $this->session->sess_destroy();
?>