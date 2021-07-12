<!--contact us page  in front end (controller page/contact)  -->
<?php
    $this->load->view('front/header');
?>

<div class="container-fluid contact">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center my-4 py-5">CONTACT US</h1>
        </div>
    </div>
    <div class="container">
        <div class="row pb-5">
            <div class="col-md-7 mr-5">
                <div class="card pb-4 h-100">
                    <div class="card-header text-white bg-secondary">Have Any Questions Or Comments?</div>
                
                    <div class="card-body">
                        <?php
                            if($this->session->flashdata('success')!=''){?>
                                <div class='alert alert-success text-center'>
                            <?php
                                print_r( $this->session->flashdata('success'));?>
                            </div>
                        <?php } ?>
                        <form action="<?=base_url('page/contact')?>" name="contactform" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?=set_value('name')?>" placeholder="Your Name..." class="form-control <?=(form_error('name')!='')? 'is-invalid' : '' ; ?>">
                            </div>
                            <?=form_error('name');?>
                            <div class="form-group">
                                <label for="Email">E-mail</label>
                                <input type="email" id="email" name="email" value="<?=set_value('email')?>" placeholder="Your Email.." class="form-control <?=(form_error('email')!='')? 'is-invalid' : '' ; ?>">
                            </div>
                            <?=form_error('email');?>

                            <div class="form-group">
                                <label for="Message">Message</label>
                                <textarea name="message" id="message" placeholder="Enter Your Message Here..." rows="5" class="form-control <?=(form_error('message')!='')? 'is-invalid' : '' ; ?>"><?=set_value('message')?></textarea>
                            </div>
                            <?=form_error('message');?>

                            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md px-3"> Send</button>
                            <button type="reset" name="reset" id="reset" class="btn btn-secondary btn-md px-3 ml-2"> Reset</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pl-3">
                <div class="card h-100">
                    <div class="card-header text-white bg-secondary">Reach Us</div>
                    
                    <div class="card-body">
                        <div>
                            <p><Strong>Customer Service:</Strong></p>
                            <p class="mb-0">Phone: +91 123 456 7890</p>
                            <p class="mb-0">E-mail:<a href=""> support@fashionstation.com</a> </p>
                            <br>
                            <br>
                            <p class="mb-0"><strong>Headquaters:</strong></p>
                            <p class="mb-0">Khandagiri Square</p>
                            <p class="mb-0">Bhubaneswar-751003</p>
                            <p class="mb-0">Odisha</p>                     
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>

<?php
  $this->load->view('front/footer');
?>