<?php $this->load->view('users/header'); ?>

<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="blogHome"></div>
      <div class="carousel-caption  d-md-block">

        <h2 class="text-dark">Welcome to Knowledge Seek's Blog <i class="fas fa-blog" style="color:#191970;"></i> Section</h2>
      </div>
    </div>
  </div>
</div>


<!-- bottom nav -->
<nav class="navbar navbar-expand-lg navbar-light " style="background: rgb(255,214,28);
background: linear-gradient(104deg, rgba(255,214,28,1) 22%, rgba(255,141,0,1) 84%);
 padding: 15px 0; margin :0; ">  
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContents"
      aria-controls="navbarSupportedContents" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContents">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 blogsNavs">
       
        <?php if(!empty($category)){?>
           <li class="nav-item">
          <a class="nav-link active" id="homeClassId" onclick="ShowMainCard()" aria-current="page" href="#">HOME</a>
        </li>
       <?php  foreach($category as $cat){
         if($cat['status'] == 1){ ?>
        <li class="nav-item" id="catClassId" >
          <a href="javascript:void(0);" onclick="getCatArticles(<?php echo $cat['id'] ?>)" class="nav-link text-uppercase" id="categoryBtn">
            <?php echo $cat['name'] ?>
          </a>
        </li>

        <?php }else{ ?>
             <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      <?php  } }  }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="#">...</a>
        </li>
        <?php  } ?>


        <!-- <li class="nav-item ">
          <div id="custom-search-input">
            <div class="input-group ">
              <input type="text" id="search" class="search-query form-control search_bar" placeholder="Search" />
            </div>
          </div>
        </li> -->

      </ul>

    </div>
  </div>
</nav>


<!-- bolgs cards -->
<div class="crads-div mt-5 mb-5" id="hideCard">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-md-9 col-lg-9 col-12">

        <div class="card mb-5 primaryCard">
          <?php if($latestArticle != "null"){?>

          <a href="<?php echo base_url().'blogpost/'.$latestArticle['id'] ?>"><img
              src="<?php echo base_url().'public/uploads/articles/'.$latestArticle['image'] ?>"
              style="width: 100%; height: 250px;" class="card-img-top" alt="..." /></a>
          <div class="card-body">
            <h5 class="card-title text-uppercase">
              <?php echo $latestArticle['category_name'] ?>
            </h5>
            <h3 class="card-title text-capitalize">
              <?php echo $latestArticle['title'] ?>
            </h3>
            <p class="card-text px-3">
              <?php echo word_limiter(strip_tags($latestArticle['discription']), 20); ?>
              <a href="<?php echo base_url().'blogpost/'.$latestArticle['id'] ?>" class="text-primary">
                Read More
              </a>
            </p>

            <div class="d-flex justify-content-between">
              <p class="card-text"><small class="text-muted"><span>
                    <?php echo $latestArticle['author'] ?>
                  </span></small></p>
              <p class="card-text"><small class="text-muted">
                  <?php echo date("y-M-d",strtotime($latestArticle['created_at'])); ?>
                </small></p>
            </div>
          </div>
          <?php }else{ ?>

          <img src="<?php echo base_url().'public/uploads/articles/unnamed.png' ?>" class="card-img-top"  style="width: 100%; height: 280px; padding: 20px;"
            alt="..." />
          <?php } ?>
        </div>

        <div class="row">
          <?php  if($allArticles){ 
                    foreach($allArticles as $article){ ?>
          <div class="col-sm-12 col-md-6 col-lg-6 col-12 mb-5 ">
            <div class="card secondaryCard">
              <a href="<?php echo base_url().'blogpost/'.$article['id'] ?>"><img
                  src="<?php echo base_url().'public/uploads/articles/'.$article['image'] ?>" class="card-img-top"
                  alt="..."></a>
              <div class="card-body">
                <h5 class="card-title text-uppercase">
                  <?php echo $article['category_name'] ?>
                </h5>
                <h3 class="card-title text-capitalize">
                  <?php echo word_limiter(strip_tags($article['title']), 4); ?>
                </h3>
                <p class="card-text text-justify">
                  <?php echo word_limiter(strip_tags($article['discription']), 12); ?><a
                    href="<?php echo base_url().'blogpost/'.$article['id'] ?>" class="text-primary">
                    read more
                  </a>.
                </p>

                <div class="d-flex justify-content-between">
                  <p class="card-text"><small class="text-muted">Author - <span>
                        <?php echo $article['author'] ?>
                      </span></small></p>
                  <p class="card-text"><small class="text-muted">
                      <?php echo date("y-M-d",strtotime($article['created_at'])); ?>
                    </small></p>
                </div>
              </div>
            </div>
          </div>
          <?php } } ?>
        </div>

      </div>

      <div class="col-sm-4 col-md-3 col-lg-3 col-12 mb-4">
        <?php  if($category){ 
             foreach($category as $cats){
         if($cats['status'] == 1){ ?>
               <div class="list-group mb-5 mt-5" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
          <a href="#" class="list-group-item list-group-item-action bg-danger text-uppercase text-center" style="color:white ; letter-spacing: 2px;" aria-current="true">
            <?php echo $cats['name']; ?>
          </a>
           <?php if($sidemenu){
          foreach($sidemenu as $sideVal){ 
            if($sideVal['status'] == 1 && $sideVal['category_id'] == $cats['id'])  { ?>
          <a href="<?php echo base_url().'blogpost/'.$sideVal['id'] ?>" class="list-group-item list-group-item-action"> <?php echo $sideVal['title']; ?></a>
                 <?php } } } ?>
        </div>
      <?php } } } ?>
      </div>
    </div>
  </div>
</div>


<div class="crads-div mt-5 mb-5" id="showCard">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-md-9 col-lg-9 col-12" id="result">
      </div>

      <div class="col-sm-4  col-md-3 col-lg-3 col-12">
         <?php  if(!empty($category)){ 
             foreach($category as $cats){
         if($cats['status'] == 1){ ?>
               <div class="list-group mb-5 mt-5" style="box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);">
          <a href="#" class="list-group-item list-group-item-action bg-danger text-uppercase text-center" style="color:white ; letter-spacing: 2px;" aria-current="true">
            <?php echo $cats['name']; ?>
          </a>
           <?php if(!empty($sidemenu)){
          foreach($sidemenu as $sideVal){ 
            if($sideVal['status'] == 1  && $sideVal['category_id'] == $cats['id']) { ?>
          <a href="<?php echo base_url().'blogpost/'.$sideVal['id'] ?>" class="list-group-item list-group-item-action"> <?php echo $sideVal['title']; ?></a>
                 <?php } } } ?>
        </div>
      <?php } } } ?>
      </div>
    </div>
  </div>
</div>

<!-- blogs end -->


<?php $this->load->view('users/footer'); ?>

<script>
  const getCatArticles = (id) => {
    let html = '';
    $('#hideCard').hide();
    $('#showCard').show();


    $.ajax({
      url: "<?php echo base_url().'users/blogs/getCategoryArticle' ?>",
      data: { cat_id: id },
      method: "get",
      dataType: "json",
      success: function (res) {
        if (res != null) {
          $('#result').html(res);
        } else {
          $('#result').html("<h1>DATA NOT FOUND</h1>")
        }
      }
    });
  }

  const ShowMainCard = () => {
    $('#hideCard').show()
    $('#showCard').hide();
  }
ShowMainCard();
  $('#homeClassId').toggleClass("active");
  $('#catClassId').toggleClass("active");

  var search = document.getElementById("search")
  setInterval(function () {
    var color = "rgb(" + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + "," + Math.floor(Math.random() * 255) + ")";
    search.style.borderColor = color;
  }, 1000)

</script>