<?php $this->load->view("admin/header") ?>
  <?php  if (!empty($this->session->flashdata('p_change'))) { 
      echo "<div class='alert alert-success' id='error'>".$this->session->flashdata('p_change')."</div>";
  }
    ?>
<?php $this->load->view("admin/footer") ?>