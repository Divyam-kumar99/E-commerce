<!--details page of each articles in front end (controller collection/details)  -->
<?php
    $this->load->view('front/header');
?>
<div class="container">
    <h3 class="py-4">All Items</h3>
    <div class="row">
        <?PHP if(!empty($article)){?>
            <div class="col-md-12" id="detailid">
                <h4><?=$article['title']?></h4>
                <div class="d-flex">
                    <p class="text-muted">Seller : <strong><?=$article['author'];?></strong> on <strong><?=date('d M Y',strtotime($article['created']))?></strong> </p>
                    <p class="right-align bg-light mx-2 px-3 text-uppercase ml-auto"><a href="<?=base_url('collection/categorydetails/').$article['category'];?>"><strong><?=$article['category_name'];?></strong></a></p>
                </div>
                <div class="text-center">
                <?php if(!empty($article['image']) && file_exists('./public/uploads/articles/'.$article['image'])){?>
                    <img src="<?=base_url('public/uploads/articles/'.$article['image'])?>" class='mb-3 col-md-4' alt="">
                <?php }?>
                </div>
                <p><?=$article['description']?></p>
            </div>
        <?php }?>
    </div> <!--end of row-->
    <?php
        if($this->session->flashdata('success')!=''){?>
        <div class='alert alert-success'><?php
        print_r( $this->session->flashdata('success'));?>
        </div>
    <?php } ?>

    <div class="col-md-9 pl-0" id="review_box">
        <form action="<?=base_url().'collection/details/'.$article['id']?>#review_box" name="categoryform" method="post" enctype='multipart/form-data'>
            <?php if(!empty(validation_errors()) || !empty($errorimageupload)){?>
                <div class="alert alert-danger">
                    <h4 class="alert-heading">Please Fix the following errors</h4>
                    <?=validation_errors();
                        if(!empty($errorimageupload)){
                            echo $errorimageupload; }?>
                </div>
            <?php }?>


            <div class="card">
                <div class="card-body pb-1">
                    <p><strong>Reviews</strong></p>
                    <div class="form-group col-md-8 pl-0">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name..." id="name" value="<?=set_value('name');?>">
                    </div>
                    <div class="form-group">
                        <textarea name="review" id="review" placeholder="Reviews..." rows="5" class="form-control"><?=set_value('review');?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="image">Image</label><br>
                      <input type="file" name='image'  id="image" >                                   
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary ">Submit</button>
                </div>
                <!-- to show all existing active reviews -->
                <hr>
                <div class="col-md-12">
                <?php if(!empty($reviews)){
                    foreach ($reviews as $review) {?>
                    <div class="user-review my-3">
                        <p class="text-muted"><strong><?=$review['name']?></strong></p>
                        <?php if(!empty($review['image']) && file_exists('./public/uploads/review/'.$review['image'])){?>
                            <img src="<?=base_url('public/uploads/review/'.$review['image'])?>" class="w-100" alt="">
                        <?php } ?>
                        <p class="font-italic mt-3 mb-0"><?=$review['review']?></p>
                        <small class="text-muted "><STrong>Posted on: </STrong><?=date('d M Y',strtotime($review['created']))?></small>
                    </div>
                    <hr>
                <?php } }?>
                </div>
            </div><!--end of card-->
        </form>
    </div><!--end of col-md-8-->
</div> <!--end of container-->
<?php
  $this->load->view('front/footer');
?>