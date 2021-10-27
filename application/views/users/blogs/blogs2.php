<?php $this->load->view('users/extraNav'); ?>

<section>
  <?php if(!empty($blogs)){ ?>
  <div class="universalHead">
    <div class="mainContact">
      <div class="container" style="padding: 70px 0;">
        <div class="blog-heading">
          <div class="row h-100 align-items-center pt-5">
            <div class="col-lg-12">
              <div class="HeadingBLOGS">
                <h1 class="text-capitalize text-center"><span style="color:#191970;">
                    <?php echo $blogs['title'] ?>
                  </span>
                </h1>
                <h6 class="text-capitalize text-center">
                  <?php echo $blogs['category_name'] ?> <i class="fas fa-file" style="color:#191970;"></i>
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="container articleContent">
      <div class="row" style="margin-top:30px">
        <center>
          <img src="<?php echo base_url().'public/uploads/articles/'.$blogs['image'] ?>" style="width:80%; height:350px"
          class="viewBlogs_img ">
        </center>
        <div class="viewBlogs_discription mt-3 mb-5" style="width: 100%; height: auto;">
          <?php echo $blogs['discription'] ?>
        </div>
      </div>


      <form method="POST" id="commentForm" action="" ;">
        <div class="commentbox container pb-4" id="commentbox">
          <h1 class="mb-4 mt-4"><strong>COMMENTS</strong></h1>

          <div class="alert alert-danger errordiv d-none">
            <h4 class="alert-heading">Please Fill all entries....</h4>
            <p class="mb-0 pb-0" id="error"></p>
          </div>


          <div class="row">
            <div class="col-md-10">
              <div class="card  bg-light" style="border:none;">
                <div class="card-body">

                  <input type="hidden" name="article_id" id="hiddenId" value="<?php echo $blogs['id']; ?>">
                  <input type="hidden" name="comment_id" id="hiddenCommentId" value="0">
                  <input type="hidden" name=last" id="lastindex" value="0">

                  <div class="form-group mb-3">
                    <label for="commentb"><strong>Comment</strong></label>
                    <textarea name="message" id="cb" class="form-control" rows="3"
                      placeholder="Comment"><?php echo set_value('commentb'); ?></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="name"><strong>Name<span style="color:red">*</span></strong></label>
                        <input type="text" name="name" id="nm" placeholder="Name"
                          value="<?php echo set_value('name'); ?>" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="form-group mb-3">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="email"><strong>Email<span style="color:red">*</span></strong></label>
                        <input type="text" name="email" id="mail" placeholder="Email"
                          value="<?php echo set_value('email'); ?>" class="form-control">
                      </div>
                    </div>
                  </div>

                  <button type="submit" name="submit" class="btn btn-success" id="Commentbtn">COMMENT</button>
                  <hr>

                  <div id="displayComments">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>

    <?php }else{?>
    <div class="bg-warning"
      style=" background-color: #FF8000; background-image: linear-gradient(to bottom right, #FF8000, yellow);">
      <div class="container py-5">
        <div class="about-heading" data-aos="zoom-in-right" data-aos-duration="3000">
          <div class="row h-100 align-items-center pt-5">
            <div class="col-lg-12">
              <div class="service_about_Heading">
                <h1 class="text-uppercase text-center aboutUsHeading"><span style="color:#191970;">Blogs </span>Not
                  Found
                </h1>
                <h6 class="text-uppercase text-center" style="font-weight: 800;font-size:30px">Sorry..! <i
                    class="fas fa-file" style="color:#191970;"></i>
                </h6>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php }  ?>
  </div>
  </div>
  <div class="collapse" id="collapseExample">
    <div class="card card-body">
      Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user
      activates the relevant trigger.
    </div>
  </div>
</section>

<?php $this->load->view('users/footer'); ?>

<!-- addd comment  -->
<script>
  $('document').ready(function () {

    $('#commentForm').submit(function (e) {
      e.preventDefault();

      let comm_id = $('#hiddenCommentId').val();
      let url = "<?php echo base_url('blogcomment/'.$blogs['id']); ?>#commentbox"
      let formData = new FormData();
      if (comm_id != 0) {
        // url = "<?php echo base_url('users/Blogs2/addReply'); ?>"
        formData.append("name", $('#nm').val());
        formData.append("email", $('#mail').val());
        formData.append("reply", $('#cb').val());
        formData.append("comment_id", comm_id);
        formData.append("article_id", $('#hiddenId').val());
        formData.append("replied_at", '');
      } else {
        url = "<?php echo base_url('blogcomment/'.$blogs['id']); ?>#commentbox"
        formData.append("name", $('#nm').val());
        formData.append("email", $('#mail').val());
        formData.append("comment", $('#cb').val());
        formData.append("article_id", '');
        formData.append("commented_at", '');
      }

      $.ajax({
        url: url,
        method: "post",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (data) {
          if (data.error_check) {
            if (data.allerror != '') {
              $('.errordiv').removeClass('d-none');
              $('#error').html(data.allerror);
            }
            if (data.name_error != '') {
              $('#nm').addClass('is-invalid');
            } else {
              $('#nm').removeClass('is-invalid');

            }
            if (data.mail_error != '') {
              $('#mail').addClass('is-invalid')
            } else {
              $('#mail').removeClass('is-invalid');
            }
          }
          if (data.success) {
            $('.errordiv').addClass('d-none');
            $('#nm').removeClass('is-invalid')
            $('#mail').removeClass('is-invalid');
            alert(data.success);
            $('form')[0].reset()
            $('#hiddenCommentId').val('0');
            getComments(1);
          }
        }
      });
    })

  });

  function getComments(page) {

    $('document').ready(function () {
      let html = '';
      let temp = 0;
      let geturl = "<?php echo base_url().'users/blogs2/getComments' ?>";
      let id = $('#hiddenId').val();

      $.ajax({
        url: geturl,
        method: "get",
        data: { article_id: id, page: page },
        dataType: "json",
        success: function (commentData) {
          let lastindex;
          if (commentData != '') {
            commentData['comments'].forEach(element => {
              lastindex = element['id'];
              html += '<div class="row">' +
                '<div class="col-md-8" >' +
                '<div class="container commentCard">' +
                '<div class="d-flex justify-content-between">' +
                '<p class="text-muted mb-0 pt-2"><strong>' + element['name'] + '</strong></p>' +
                '<p class="text-muted mb-0 pt-2" style="font-size: 15px"><strong>' +
                formatDate(element['commented_at']) +
                '</strong> </p>' +
                '</div>' +

                '<h5 class="text-muted pb-0 pl-2 pt-2" style="font-size: 18px">' + element['comment'] + '</h5 >' +
                '<div class="d-flex justify-content-between">' +
                '<p class="text-muted pb-2" style="font-size: 15px">Posted_at <strong>' + formatTime(element['commented_at']) + '</strong> </p>' +
                '<button type="button" class="btn btn-success replyBtn" id="' + element['id'] + '"  style="color:white; height: 35px;">Reply</button>' +
                '</div>' +
                '</div>';

              if (commentData['reply'] != null) {
                commentData['reply'].forEach(element1 => {
                  if (element1['comment_id'] == element['id']) {

                    html += '<div class="container mt-2 replyCard">' +

                      '<div class="d-flex justify-content-between">' +
                      '<p class="text-muted mb-0 pt-2"><strong>' + element1['name'] + '</strong></p>' +
                      '<p class="text-muted mb-0 pt-2" style="font-size: 15px"><strong>' +
                      formatDate(element1['replied_at']) +
                      '</strong> </p>' +
                      '</div>' +

                      '<h5 class="text-muted pb-0 pl-2 pt-2" style="font-size: 18px">' + element1['reply'] + '</h5>' +
                      '<div class="d-flex justify-content-between">' +
                      '<p class="text-muted pb-2" style="font-size: 15px">Posted_at <strong>' + formatTime(element1['replied_at']) +
                      '</strong> </p>' +
                      '<button type="button" class="btn btn-success replyBtn" id="' + element1['comment_id'] + '"   style = "color: white; height: 35px; " > Reply</button > ' +
                      '</div>' +

                      '</div>';

                  } else {
                    html += " ";
                  }

                });
              } else {
                html += " ";
              }

              html += '</div>' +
                '</div>' +
                '<hr>';
              temp = commentData['comments'].length;
            });

            if (commentData['count'] == temp) {
              html += '<center><button type="button" name="loadbtn" class="btn btn-outline-warning lodingBtn disabled" id="' + lastindex + '" >Load More</button></center>';
            } else {
              html += '<center><button type="button" name="loadbtn" class="btn btn-outline-warning lodingBtn" id="' + lastindex + '" >Load More</button></center>';
            }

            $('#displayComments').html(html);
          }
        }
      });
    })
  }
  getComments(1);

  $(document).on('click', '.replyBtn', function () {

    let c_id = $(this).attr('id');
    $('#commentForm')[0].reset();
    $('#hiddenCommentId').val(c_id);
    $('#cb').focus();

  })

  $(document).on('click', '.lodingBtn', function () {
    let lastIndex = $(this).attr('id');
    getComments(lastIndex);
  })

  function formatDate(date) {
    var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();
    return [day, month, year].join('-');
  }

  function formatTime(date) {
    var d = new Date(date),
      h = '' + d.getHours(),
      m = '' + d.getMinutes(),
      s = d.getSeconds();
    return [h, m, s].join(':');
  }

</script>