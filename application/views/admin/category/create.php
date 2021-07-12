<!-- create method view for categories to be created  -->
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
              <li class="breadcrumb-item"><a href="<?=base_url('admin/category')?>">Category</a></li>
              <li class="breadcrumb-item active">Create New Categories</li>
              
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
          <div class="col-lg-12 ">
            <div class="card card-primary ">
                <div class="card-header">
                    <div class="card-title">
                        Create New Category
                    </div>
                  
                </div>  
                <form action="<?=base_url().'admin/category/create'?>" name="categoryform" method="post" enctype='multipart/form-data'>
                 <div class="card-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name='name'  id="name" value="<?= set_value('name'); ?>" class="form-control <?php echo (!empty(form_error('name'))) ?'is-invalid' :'';?>">                    
                    </div>
                    <?= form_error('name')?>
                    <div class="form-group">
                      <label for="image">Image</label><br>
                      <input type="file" name='image'  id="image" class="<?php echo (!empty($errorimageupload))? 'is-invalid' : '';?>">  
                      <?php echo (!empty($errorimageupload))? $errorimageupload : '' ; ?>                  
                    </div>
                    <div class="form-check float-left">
                     <input class="form-check-input" type="radio" value='1' name="status" id="flexRadioDefault1" checked>
                       <label class="form-check-label" for="flexRadioDefault1">
                        Active
                       </label>
                    </div>
                    <div class="form-check float-left ml-2">
                      <input class="form-check-input " type="radio" value='0' name="status" id="flexRadioDefault2" >
                      <label class="form-check-label " for="flexRadioDefault2">
                        Block 
                      </label>
                    </div>
                  </div><!-- end of card body-->
                  <div class="card-footer">
                    <button name="submit" type="submit" class="btn btn-primary ">Submit</button>                  
                    <a href="<?=base_url('admin/category/index')?>" class="btn btn-md ml-2 btn-secondary">Back</a>
                  </div>
                </form>
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