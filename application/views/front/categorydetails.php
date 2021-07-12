<!-- this will show all items of same category -->
<!-- this view is used to shw all articles in the front end PAGE  -->
<?php $this->load->view('front/header');?>
<div class="container">
    <h3 class="py-4 text-uppercase"><?=$articles[0]['category_name'];?></h3>
    <div class="row">
        <?php if(!empty($articles)){
            foreach ($articles as $article) {?>
            <div class="col-md-3 my-3 pb-4">
                <?php if($article['image']!='' && file_exists('./public/uploads/articles/thumb_admin/'.$article['image'])){?>
                    <img src="<?=base_url('public/uploads/articles/thumb_admin/').$article['image'];?>" class="rounded w-100" height="auto" alt="">
                    
                <?php } else {?>
                    <img src="<?=base_url().'public/uploads/category/no-image.jpg'?>" class="rounded w-100" alt="">
                <?php } ?>
            </div>
            <div class="col-md-9 my-3">
                <!-- <p class="bg-light py-2 pl-3">
                    <a href="#" class="text-muted text-uppercase"><?=$article['category_name'];?></a>
                </p> -->
                <h4>
                    <a href="<?=base_url('collection/details/').$article['id'];?>"><?=$article['title'];?></a>
                </h4>
                <p class="col-md-10">
                
                    <?=word_limiter(strip_tags($article['description']),40);?>
                    <a href="<?=base_url('collection/details/').$article['id'];?>" class='text-muted'>Read More</a>
                </p> 
                <!-- strip_tags removes html tags  -->
                <p class="text-muted">Seller : <strong><?=$article['author'];?></strong> on <strong><?=date('d M Y',strtotime($article['created']))?></strong> </p>
     
            </div>
        <?php } }?> 
    </div><!--end of row-->
    <div class="right-align ml-auto">
        <?=$links?>
    </div>

</div> <!--end of container-->

<?php $this->load->view('front/footer');?>