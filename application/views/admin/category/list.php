
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
              <li class="breadcrumb-item active">Categories</li>
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
            <?php if($this->session->flashdata('deleteCat') != "") { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('deleteCat');?></div>
          <?php }?>
          	<?php if($insertCat == "inserted") { ?>
          	<script>alert("Category Added Successfully")</script>
          <?php }else if($insertCat == "updated"){?>
           	<script>alert("Category Updated Successfully")</script>
     <?php }?>

            <div class="card">
            	<div class="card-header">
            		<div class="card-title">
            			<form id="searchForm" name="searchForm" method="get" action="">
            				<div class="input-group mb-0">
            					<input type="text" id="search" name="q" value="" class="form-control" placeholder="search" style="width: 150px">
            					<div class="input-group-append">
            						<button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
            					</div>
            				</div>
            			</form>
            		</div>
            		<div class="card-tools">
            			<a href="<?php echo base_url().'create_category' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
            		</div><br>
            		<div class="card-body">
            			<table class="table" id="show">
            				<tr>
            					<th width="50">#</th>
            					<th>Name</th>
            					<th width="100">Status</th>
            					<th width="180" class="text-center" colspan="1">Action</th>
            				</tr>

            				<?php  if(!empty($categories)) { ?> 
            					<?php  foreach ($categories as $value) { ?> 
            				<tr>
            					<td><?php echo $value['id'] ?></td>
            					<td><?php echo strtoupper($value['name']) ?></td>
            					<td>
            					<?php if ($value['status']==1) { ?>
            						<span class="badge badge-success">Active</span>
            					<?php }else{ ?>
            						<span class="badge badge-danger">Deactive</span>
            					<?php } ?>
            					</td>
            					<td class="text-center" >
            						<a href="<?php echo base_url()."category_edit/".$value['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>EDIT</a>&nbsp
            						<a href="javascript:void(0);" onclick="deleteCategory(<?php echo $value['id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>DELETE</a>
            					</td>
            				</tr>
            				<?php } ?>
            					<?php }else{ ?>
                        <tr>
                          <td colspan="4">Records not found</td>
                        </tr>
                     <?php  } ?>
            			</table>

                  <table class="table" id="result">
                  </table>
            			
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
  <script type="text/javascript">

    function deleteCategory(id) {
      if (confirm("Are you sure want to delete Category")) {
        window.location.href = '<?php echo base_url()."admin/category/delete/"; ?>' + id; 
      }
    }


    $(document).ready(function () {
        $('#search').on("keyup", function () {
          let searchVal = $(this).val();
          let base = "<?php echo base_url().'admin/category/edit/'?>";
           let deletebase = "<?php echo base_url().'admin/category/delete/'?>";

          $.ajax({
            url: "<?php echo base_url() ?>admin/category/searchCategory?> ",
            method: "get",
            data: {searchData:searchVal},
            dataType: "json",
            success: function (data) {
               let html = 	'<tr>'+
            					'<th width="50">#</th>'+
            				'<th>Name</th>'+
            					'<th width="100">Status</th>'+
            					'<th width="180" class="text-center" colspan="1">Action</th>'+
            				'</tr>';
               
                if (data != '') {
                    data.forEach(element => {
                  html += '<tr>' +
                            '<td>'+ element['id'] +'</td>'+
            				        '<td>'+ element['name'].toUpperCase() +'</td>'+
            					      '<td>';
                              if (element['status']==1){ 
                              html += '<span class="badge badge-success">Active</span>';
                              }else{ 
                              html += '<span class="badge badge-danger">Deactive</span>';
                              } 
                              html += '</td>'+
                                  '<td class="text-center">'+
                                      '<a href=" '+ base + element['id'] +'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>EDIT</a>&nbsp'+
                                    '<a href=" '+ deletebase +element['id'] +'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>DELETE</a>'+
                                    '</td>'+
                            '</tr>';
                    });
                } else {
                    html = '<tr>' +
                        '  <td colspan="7">Records not found</td>' +
                        '</tr>';
                }
                $('#show').hide();
                $('#result').html(html);
            }
          });
        })

        
    });
    
  </script>
