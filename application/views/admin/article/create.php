<!-- create method view for article to be created  -->
<?php $this->load->view('admin/header');?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Articles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/article')?>">Articles</a></li>
              <li class="breadcrumb-item active">Create New Article</li>
              
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
                        Create New Article
                    </div>
                  
                </div>  
                <form action="<?=base_url().'admin/article/create'?>" name="categoryform" method="post" enctype='multipart/form-data'>
                 <div class="card-body">
                 <div class="form-group">
                      <label for="category">Category</label>
                        <select name="category" id="category" class="form-control <?=(form_error('category')!='')? 'is-invalid' : '' ; ?>">
                        <option value="">Select a Category</option>
                        <?php
                            if(!empty($categories)){
                                foreach ($categories as $category) {
                                    ?>
                                    <option <?=set_select('category',$category['id'],false)?> value=" <?php echo $category['id']?>"><?=$category['name'];?></option>
                                <?php }
                            }
                        
                        ?>
                        </select>                     
                    </div>
                    <?=form_error('category')?>                    
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name='title' placeholder="Title" id="title" value="<?=set_value('title')?>" class="form-control <?=(form_error('title')!='')? 'is-invalid' : '' ; ?> ">                    
                    </div>
                    <?=form_error('title')?>    
                    <div class="form-group">
                      <label for="author">Author</label>
                      <input type="text" name='author' placeholder="Author" id="author" value="<?=set_value('author')?>" class="form-control <?=(form_error('author')!='')? 'is-invalid' : '' ; ?>">                    
                    </div>   
                    <?=form_error('author')?>                
                    <div class="form-group">
                      <label for="description">Desription</label>
                      <textarea name="description" value="" id="description" class="textarea"><?=set_value('descritpion')?></textarea>
                      <!-- textarea is a class defined in the script section of the footer -->
                    </div>    
                    <div class="form-group">
                      <label for="image">Image</label><br>
                      <input type="file" name='image'  id="image" class="<?php echo (!empty($errorimageupload))? 'is-invalid' : '';?>" >                                   
                    </div>
                    <?php echo (!empty($errorimageupload))? $errorimageupload : '' ; ?>
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
                    <a href="<?=base_url('admin/article/index')?>" class="btn btn-md ml-2 btn-secondary">Back</a>
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