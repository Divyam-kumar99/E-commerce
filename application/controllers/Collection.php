<!-- this controller is used to shw all articles in the front end PAGE  -->
<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Collection extends CI_controller{
    // this function will will all items in collection page 
    function index ($page=1){
        $this->load->model('Article_model');
        $this->load->helper('text');
        // pagination start
         // use offset and limit for pagination
         $perpage=5;
         $param['offset']=$perpage;
         $param['limit']=($page*$perpage)-$perpage; 

        $this->load->library('pagination');
        $config['base_url']=base_url('collection/index');
        $config['total_rows']=$this->Article_model->getarticlescount(); //gives total no of articles count (param is passed to get count of the record when we search it from search bar)
        $config['per_page']=$perpage;
        $config['use_page_numbers']=true;

        // for pagination customizaation like bootstrap 
        $config['first_link']='First';        
        $config['Last_link']='Last';
        $config['next_link']='Next';        
        $config['prev_link']='Prev';     
        $config['full_tag_open']= "<ul class='pagination'>";
        $config['full_tag_close']= "</ul>";
        $config['num_tag_open']= '<li class="page-item">';
        $config['num_tag_close']= '</li>';
        $config['cur_tag_open']= "<li class='disabled page-item'><li class='active page-item'><a href='#' class='page-link'>";
        $config['cur_tag_close']= "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']= "<li class='page-item'>";
        $config['next_tag1_close']= "</li>";
        $config['prev_tag_open']= "<li class='page-item'>";
        $config['prev_tag1_close']= "</li>";
        $config['first_tag_open']= "<li class='page-item'>";
        $config['first_tag1_close']= "</li>";
        $config['last_tag_open']= "<li class='page-item'>";
        $config['last_tag1_close']= "</li>";
        $config['attributes']= array('class'=>'page-link');




        $this->pagination->initialize($config);
        $links=$this->pagination->create_links();
        $data['links']=$links;

       
        $articles= $this->Article_model->getarticlesfront($param);   //for displaying all articles   
        $data['articles']=$articles;
            

        $this->load->view('front/collection',$data);

    }

    // to show an individual item in collection page 
    function details($id){
        $this->load->model('Article_model');
        $this->load->model('Review_model');
        $this->load->library('form_validation');
        $article=$this->Article_model->getarticlebyidfront($id);
        $data['article']=$article;
        $reviews=$this->Review_model->getreviews($id);
        $data['reviews']=$reviews;
         //file upload settings
         $this->load->helper('common_helper');
         $config['upload_path'] = './public/uploads/review/';
         $config['allowed_types'] = 'gif|jpg|png';
         $config['encrypt_name'] = true;
 
         $this->load->library('upload', $config);
 
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('review','Review','required');
        $this->form_validation->set_error_delimiters('<p class="mb-0">','</p>');
        if($this->form_validation->run()=='true'){
            // if review submmitted successfully
            
            if(!empty($_FILES['image']['name'])){
                // upload the image here 
                
                if($this->upload->do_upload('image')){
                    // file uploaded successfully
                    
                    $data=$this->upload->data();
                    
                    
                    // echo "run with image if succesful "; 
                    // exit;
                    $formarray=array();
                    $formarray['name']=$this->input->post('name');                    
                    $formarray['review']=$this->input->post('review');
                    $formarray['image']=$data['file_name'];       
                    $formarray['article_id']=$id;
                    $formarray['created']=date('Y-m-d H:i:s');
                    $this->Review_model->create($formarray);

                    // resizing image using common_helper
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],270,300);//directory path only                     
                    $this->session->set_flashdata('success','Your review has been submitted successfully with image');
                    redirect(base_url('collection/details/'.$id));
                }else{
                    // error in uploading image, shw error
                    
                    $error= $this->upload->display_errors();
                    $data['errorimageupload']=$error;
                    // echo $error;
                    // exit;
                    $this->load->view('front/details',$data);

                }

            }else {
                //Review without image
                
                $formarray=array();
                $formarray['name']=$this->input->post('name');                    
                $formarray['review']=$this->input->post('review');
                $formarray['article_id']=$id;
                $formarray['created']=date('Y-m-d H:i:s');
                $this->Review_model->create($formarray);
                  
                    
                $this->session->set_flashdata('success','Your review has been submitted successfully');
                redirect(base_url('collection/details/'.$id));

            }
            


        }else{
            // show errors in form
            $this->load->view('front/details',$data);
        }

    }

    // to show all articles of same categories 
    function categorydetails($category_id,$page=1){

        $this->load->model('Article_model');
        $this->load->helper('text');
        // pagination start
         // use offset and limit for pagination
         $perpage=2;
         $param['offset']=$perpage;
         $param['limit']=($page*$perpage)-$perpage; 
         $param['category_id']=$category_id;

        $this->load->library('pagination');
        $config['base_url']=base_url('collection/categorydetails/'.$category_id);
        $config['total_rows']=$this->Article_model->getarticlescount($param); //gives total no of articles count (param is passed to get count of the record when we search it from search bar)
        $config['uri_segment']=4; // should be used becoz $page is passed as 2nd argument (4 bcoz after base url 4th / )
        $config['per_page']=$perpage;
        $config['use_page_numbers']=true;

        // for pagination customizaation like bootstrap 
        $config['first_link']='First';        
        $config['Last_link']='Last';
        $config['next_link']='Next';        
        $config['prev_link']='Prev';     
        $config['full_tag_open']= "<ul class='pagination'>";
        $config['full_tag_close']= "</ul>";
        $config['num_tag_open']= '<li class="page-item">';
        $config['num_tag_close']= '</li>';
        $config['cur_tag_open']= "<li class='disabled page-item'><li class='active page-item'><a href='#' class='page-link'>";
        $config['cur_tag_close']= "<span class='sr-only'></span></a></li>";
        $config['next_tag_open']= "<li class='page-item'>";
        $config['next_tag1_close']= "</li>";
        $config['prev_tag_open']= "<li class='page-item'>";
        $config['prev_tag1_close']= "</li>";
        $config['first_tag_open']= "<li class='page-item'>";
        $config['first_tag1_close']= "</li>";
        $config['last_tag_open']= "<li class='page-item'>";
        $config['last_tag1_close']= "</li>";
        $config['attributes']= array('class'=>'page-link');




        $this->pagination->initialize($config);
        $links=$this->pagination->create_links();
        $data['links']=$links;

       
        $articles= $this->Article_model->getarticlesfront($param);   //for displaying all articles   
        $data['articles']=$articles;

        $this->load->view('front/categorydetails',$data);
    }
}

?>