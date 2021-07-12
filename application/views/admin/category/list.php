<!-- to view all the categories   -->

<?php $this->load->view('admin/header');?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/home')?>">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

  <?php
   if($this->session->flashdata('success')!=''){?>
  <div class='alert alert-success text-center'>
  <?php
   print_r( $this->session->flashdata('success'));?>
    </div>
 <?php }  ?>
      <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 ">
            <div class="card ">
                <div class="card-header">
                    <div class="card-title">
                        <form action="" id="searchform" name="searchform"  method="get">
                            <div class='input-group mb-0'>
                                <input type="text" value="<?=$queryString;?>" class="form-control" placeholder="search" name="q">
                                <div class="input-group-append">
                                    <button class="input-group-text" id="basic-addon1">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                    <div class="card-tools">
                        <a href="<?= base_url().'admin/category/create'?>" class="btn btn-primary"><i class="fas fa-plus"></i>Create</a>
                    </div>
                </div>  
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="50">#</th>
                            <th width ='80'>Image</th>
                            <th>Name</th>
                            <th width="100">Status</th>
                            <th width="200" class="text-center">Action</th>
                        </tr>
                        <?php if (!empty($categories)){ ?>
                          <?php foreach($categories as $category){ ?>
                            <tr>
                                <td><?=$category['id']?></td>
                                <td>
                                <?php
                                    if ($category['img']!='' && file_exists('./public/uploads/category/thumb/'.$category['img'])){?>
                                    <img src="<?=base_url().'public/uploads/category/thumb/'.$category['img']?>"  class="w-100 mt-3" alt="">                   
                                    <?php }else{?>
                                    <img src="<?=base_url().'public/uploads/category/no-image.jpg'?>"  class="w-100 mt-3" alt="">
                                  <?php } ?>
                                </td>
                                <td><?=$category['name']?></td>
                                <td>
                                    <?php if($category['status']==1){?>
                                    <span class="badge badge-success">Active</span>
                                    <?php }else {?>
                                    <span class="badge badge-danger">Block</span>
                                    <?php }?>
                                </td>
                                <td class="text-center">
                                    <a href="<?=base_url().'admin/category/edit/'.$category['id']?>" class="btn btn-primary btn-sm">
                                        <i class="far fa-edit"></i>
                                    Edit
                                    </a>
                                    <a href="javascript::void(0); " onclick="deleteCategory(<?= $category['id']?>)" class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    Delete
                                    </a>
                                </td>
                            </tr>
                          <?php } ?>
                        <?php } 
                        else { ?>
                          <td colspan='8' class="text-center alert alert-danger">No Record found</td>
                          <?php } ?>
                        
                    </table>
                
                </div><!-- end of table body-->
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $this->load->view('admin/footer');?>
<script type="text/javascript">
  function deleteCategory(id){
    if(confirm("Are you sure you want to delete this category")){
      window.location.href='<?php echo base_url("admin/category/delete/");?>'+id;

    }
  }

</script>