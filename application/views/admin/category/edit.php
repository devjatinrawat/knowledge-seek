
<?php $this->load->view("admin/header.php"); ?>

        <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?php echo base_url().'category' ?>">Categories</a></li>
              <li class="breadcrumb-item active">Edit Categories</li>
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
             <form name="categoryform"  id="categoryform" method="post" action="<?php echo base_url().'category_edit/'. $editcategory['id'] ?>">
              <div class="card-header">
                <div class="card-title ">
                  Edit Category "<?php echo $editcategory['name'];?>"
                </div>
              </div>
                <div class="card-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="name" id="name" value="<?php echo set_value('name',$editcategory['name']); ?>" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : ''; ?>">
                    <?php echo form_error('name'); ?>
                    </div>
                   
                    <div class="custom-control custom-radio float-left ">
                          <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" <?php echo($editcategory['status'] == 1) ? "checked" : ""; ?> >
                          <label for="statusActive" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio float-left ml-3">
                          <input class="custom-control-input"  value="0" type="radio" id="statusBlock" name="status" <?php echo($editcategory['status'] == 0) ? "checked" : ""; ?> >
                          <label for="statusBlock" class="custom-control-label">Block</label>
                    </div>
                  </div>
                    <div class="card-footer">
                      <button class="btn btn-primary" type="submit" name="submit">Save Changes</button>
                      <a href="<?php echo base_url().'category' ?>" class="btn btn-secondary">Back</a>
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
