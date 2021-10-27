
<?php $this->load->view("admin/header.php"); ?>
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}
</style>

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
              <li class="breadcrumb-item active">Article</li>
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
            <?php if($this->session->flashdata('deleteAr') != "") { ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('deleteAr');?></div>
          <?php }?>
          	<?php if($this->session->flashdata('insertAr') != "") { ?>
          	<div class="alert alert-success"><?php echo $this->session->flashdata('insertAr');?></div>
          <?php }?>
          	<?php if($this->session->flashdata('updateAr') != "") { ?>
          	<div class="alert alert-success"><?php echo $this->session->flashdata('updateAr');?></div>
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
            			<a href="<?php echo base_url().'create_article' ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
            		</div><br>
            		<div class="card-body">
                 <div style="overflow-x:auto;">
            			<table  class="table" id="show">
            				<tr>
            					<th width="50">#</th>
            					<th width="100">Image</th>
                      <th>Title</th>
                      <th width="100">Author</th>
                      <th width="100">Created At </th>
            					<th width="70">Status</th>
            					<th width="140" class="text-center" colspan="1">Action</th>
            				</tr>
            				<?php if (!empty($fetcharticle)) { ?>
                      <?php foreach ($fetcharticle as  $value) { ?>
            				<tr>
                      <td><?php echo $value['id'] ?></td>
            					<td><?php  
                          $path = "./public/uploads/articles/".$value['image'];
                          if($value['image'] != "" && file_exists($path)){
                              ?>
                              <img class="w-100"  style="width: 330px; height: 100px;" src="<?php echo base_url().'public/uploads/articles/'.$value['image'];  ?>">
                            <?php   }else{ ?><br>
                            <img class="w-100" src="<?php  echo base_url()."public/uploads/category/No-image.jpg"; ?> " width=300>
                          <?php } ?>
                      </td>
            					<td><?php echo $value['title'] ?></td>
            					<td><?php echo $value['author'] ?></td>
                      <td><?php echo date('d-m-y', strtotime($value['created_at'])) ?></td>
                      <td>
                    <?php if( $value['status'] == 1){  ?>
                      <span class="badge badge-success">Active</span>
                    <?php }else{ ?>
                      <span class="badge badge-danger">Deactive</span>
                    <?php } ?>
                    </td>
                     <td class="text-center" >
                        <a href="<?php echo base_url()."article_edit/".$value['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp
                        <a href="<?php echo base_url()."comments/".$value['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-comment"></i></a>&nbsp
                        <a href="javascript:void(0);" onclick="deleteArticle(<?php echo $value['id']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php } }else{ ?>
                    <tr>
                      <td colspan="7">Records not found</td>
                        </tr>
                  <?php } ?>
                      
            			</table>


                  <table class="table" id="result">
                  </table>
                  <div>
                    <?php echo $pagination_link; ?>
                  </div>
                </div>
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
    function deleteArticle(id) {
      if (confirm("Are you sure want to delete Article")) {
        window.location.href = '<?php echo base_url()."admin/article/delete/"; ?>' + id; 
      }
    }


     $(document).ready(function () {
        $('#search').on("keyup", function () {
          let searchVal = $(this).val();
          let base = "<?php echo base_url().'admin/article/edit/'?>";
          let deletebase = "<?php echo base_url().'admin/article/delete/'?>";
          let path = "<?php  echo base_url().'public/uploads/articles/' ?>"; 

          $.ajax({
            url: "<?php echo base_url() ?>admin/article/searchArticle?> ",
            method: "get",
            data: {searchData:searchVal},
            dataType: "json",
            success: function (data) {
                let html = 	'<tr>'+
            					'<th width="50">#</th>'+
            					'<th width="100">Image</th>'+
                      '<th>Title</th>'+
                      '<th width="100">Author</th>'+
                      '<th width="100">Created At </th>'+
            					'<th width="70">Status</th>'+
            					'<th width="140" class="text-center" colspan="1">Action</th>'+
                    '</tr>'
              
                if (data != '') {
                    data.forEach(element => {

                  html += '<tr>'+
                      '<td>'+ element['id'] + '</td>'+
            					'<td>';

                      if(element['image'] != ''){
                        html += '<img class="w-100"  style="width: 330px; height: 100px;" src="'+ path + element['image'] +'">';
                      }else{
                          html += '<img class="w-100" src="'+ path +'No-image.jpg" width=300>';
                      }

                       html += '</td>'+
            					'<td>'+ element['title'] +'</td>'+
            					'<td>'+ element['author'] +'</td>'+
                      '<td>'+ element['created_at'] +' </td>'+
                      '<td>';
                    if (element['status']==1){ 
                              html += '<span class="badge badge-success">Active</span>';
                              }else{ 
                              html += '<span class="badge badge-danger">Deactive</span>';
                              } 
                    html += '</td>'+
                     '<td class="text-center" >'+
                        '<a href="'+ base + element['id'] +'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>&nbsp'+
                        '<a href="'+ base + element['id'] +'" class="btn btn-warning btn-sm"><i class="fas fa-comment"></i></a>&nbsp'+
                        '<a href="'+ deletebase + element['id'] +'" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>'+
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

