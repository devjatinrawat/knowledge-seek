
<?php $this->load->view("admin/header.php"); ?>

        <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url().'article' ?>">Article</a></li>
              <li class="breadcrumb-item active">Create Articles</li>
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
            <div class="card card-primary">
             <form name="articleform" enctype="multipart/form-data" id="articleform" method="post" action="<?php echo base_url().'create_article' ?>">
            	<div class="card-header">
            		<div class="card-title ">
            			Create New Article
            		</div>
              </div>
            		<div class="card-body">

                  <div class="form-group">
                      <label>Categories</label>
                      <select name="category_id" id="category_id" class="form-control <?php echo (form_error('category_id') != '') ? 'is-invalid' : ''; ?>">
                        <option value="">Select a Category</option>
                      <?php if(!empty($categories)){ ?>
                      <?php foreach($categories as $value){ ?>
                        <option value="<?php echo $value['id'];?>" <?php echo set_select('category_id', $value['id'], FALSE);  ?>><?php echo $value['name']; ?></option>
                       <?php } } ?>
                      </select>
                      <?php echo form_error('category_id'); ?> 
                    </div>

                    <div class="form-group">
                      <label>Title</label>
                      <input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" class="form-control <?php echo (form_error('title') != '') ? 'is-invalid' : ''; ?>">
                      <?php echo form_error('title'); ?> 
                    </div>

                    <div class="form-group">
                      <label>Discription</label>
                        <textarea name="discription" id="discription" class="textarea <?php echo (form_error('discription') != '') ? 'is-invalid' : ''; ?>" value="<?php echo set_value('discription'); ?>"></textarea>
                       <?php echo form_error('discription'); ?>
                    </div>

                    <div class="form-group">
                      <label>Image</label><br>
                      <input type="file" name="image" id="image" class="<?php echo (!empty($imageError)) ? 'is-invalid' : '' ; ?>">
                      <?php if(!empty($imageError)) echo $imageError;  ?>
                    </div>

                     <div class="form-group">
                      <label>Author</label>
                      <input type="text" name="author" id="author" value="<?php echo set_value('author'); ?>" class="form-control <?php echo (form_error('author') != '') ? 'is-invalid' : ''; ?>">
                       <?php echo form_error('author'); ?> 
                    </div>

                    <div class="custom-control custom-radio float-left ">
                          <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" checked="">
                          <label for="statusActive" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio float-left ml-3">
                          <input class="custom-control-input"  value="0" type="radio" id="statusBlock" name="status" >
                          <label for="statusBlock" class="custom-control-label">Block</label>
                    </div>

                  </div>

                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                      <a href="<?php echo base_url().'article' ?>" class="btn btn-secondary">Back</a>
                    </div> 

                 </form>
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
  <!-- /.control-sidebar -->

  <?php $this->load->view("admin/footer.php"); ?>
