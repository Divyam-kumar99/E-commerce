<!-- this is the home page view of the website home controller-->
<?php $this->load->view('front/header');?>

    <!-- carousel  -->
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?=base_url('public/images/slide3.jpg')?>" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="<?=base_url('public/images/slide2.jpg')?>" class="d-block w-100" alt="">
        </div>
        <div class="carousel-item">
          <img src="<?=base_url('public/images/slide1.jpg')?>" class="d-block w-100"  alt="">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div> <!--end of carousel-->

    <!-- about company  -->
    <div class="container py-3">
      <h3 class="pb-3">About Company</h3>
      <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Numquam pariatur temporibus labore, inventore libero, hic neque, ab sequi distinctio voluptatibus quaerat iusto voluptatum vero deserunt vel modi quia autem minima.
      Suscipit accusantium consectetur tempore recusandae, molestiae sequi animi quaerat commodi, quae vero non, ratione numquam? Magnam vero, ut veritatis odit mollitia similique maxime! Iure quae dolore sapiente voluptates exercitationem quam?
      Dolorem in at quis, nesciunt debitis laudantium blanditiis, inventore voluptates molestias reprehenderit laboriosam rem odio consectetur laborum consequatur ratione doloribus culpa rerum harum vel suscipit! Sunt eum quae animi dolorem.
      Cupiditate eum inventore vitae praesentium saepe. Molestias iste ut dolorem. Neque voluptatem iste sunt recusandae, ex laboriosam ea consequuntur totam repellendus quam nobis animi cupiditate! Quas aliquam eius labore est.
      Cupiditate alias, possimus unde dicta earum autem dignissimos dolorem aspernatur facilis expedita officiis asperiores neque magni consectetur doloremque, consequatur cumque nisi corrupti doloribus provident tenetur? Facere laudantium accusantium sunt libero.</p>
    
      <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officiis iure maiores soluta at sed? In mollitia, nisi neque aut blanditiis voluptates fugit quidem repudiandae commodi a repellendus eius laboriosam optio?
      Corporis quia in possimus animi expedita, libero fugit itaque? Provident vero corrupti, sed maiores culpa obcaecati adipisci et, pariatur quia similique, mollitia temporibus ut! Iusto nisi doloremque distinctio nemo impedit.
      Omnis accusamus incidunt doloremque esse libero quia quam eveniet dolore ad labore facere ex aliquid neque assumenda, laborum a error fugit iste quas, voluptatibus exercitationem debitis ipsum, quibusdam nihil? Deleniti?</p>
    </div> <!--end of about section -->

   <!-- our services  -->
    <div class="bg-light pt-4 pb-5">
      <div class="container">
        <div class="row ">
          <?php if(!empty($categories)){
            foreach ($categories as $category) {?>
            <div class="col-md-3 mb-3 px-3">
              <div class="card h-100" >
                <a href="<?=base_url('collection/categorydetails/').$category['id'];?>">
                  <?php if($category['img']!='' && file_exists('./public/uploads/category/thumb/').$category['img']){?>
                    <img src="<?=base_url('public/uploads/category/thumb/').$category['img']?>" class="card-img-top w-100" height="260" alt="">
                  <?php } else{?>
                    <img src="<?=base_url('public/uploads/category/no-image.jpg')?>" class="card-img-top" alt="">
                  <?php } ?>
                </a>
                <div class="card-body pb-0 pt-3">
                  <a href="<?=base_url('collection/categorydetails/').$category['id'];?>">
                    <h5 class="card-title"><?=$category['name']?></h5>
                  </a>
                </div>
              </div>
            </div><!-- div col md-3-->
          <?php } } ?>
        </div><!--div for row-->
      </div> <!--div for container-->
    </div> <!-- bg-light div end-->

<!-- for fresh arivals  -->
  <?php if(!empty($articles)){?> <!--if this is not executed then no lattest blog will be formed -->
    <div class="py-4">
      <div class="container">
        <h3 class="pt-4 pb-3">Fresh Arivals </h3>

        <div class="row">
          <?php foreach ($articles as $article) {?>
            <div class="col-md-3">
              <div class="card h-100" >
                <a href="<?=base_url('collection/details/').$article['id'];?>">
                  <?php if(!empty($article['image']) && file_exists('./public/uploads/articles/thumb/'.$article['image'])){?>
                    <img src="<?=base_url('public/uploads/articles/thumb/').$article['image']?>" class="card-img-top w-100" height="270" alt="">
                  <?php } else {?>
                    <img src="<?=base_url('public/uploads/category/no-image.jpg')?>" class="card-img-top w-100" height="270" alt="">
                  <?php }?>
                </a>
                <div class="card-body">
                  <h4>
                    <a href="<?=base_url('collection/details/').$article['id'];?>"><?=$article['title'];?></a>
                  </h4>
                  <p class="card-text">
                    <?=word_limiter(strip_tags($article['description']),40);?>
                    <a href="<?=base_url('collection/details/').$article['id'];?>" class='text-muted'>Read More</a>
                  </p>
                </div>
              </div>
            </div><!-- div col md-3-->
          <?php } ?> 
        </div><!--div for row-->
      </div> <!--div for container-->
    </div> <!-- bg-light div end-->
  <?php } ?>

<?php $this->load->view('front/footer');?>