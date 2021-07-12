<!--services page in front end  -->
<?php
    $this->load->view('front/header');
?>
<!-- about company  -->
<div class="container py-3">
      <h3 class="pb-3">Our Services</h3>
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
      <div class="col-md-4 mb-5 px-3">
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



<?php
  $this->load->view('front/footer');
?>