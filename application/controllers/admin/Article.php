<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Article extends CI_controller{
    // for session check constructor is used 
    function __construct(){
        parent::__construct();
           $sess= $this->session->userdata('admin');
        //    print_r( $sess); //to check if sesssion is created
        if(empty($sess)){
            $this->session->set_flashdata('msg','Please login to continue to admin panel');
            redirect(base_url('admin/login'));
        }
    }

    function index ($page=1){

         // use offset and limit
         $perpage=5;
         $param['offset']=$perpage;
         $param['limit']=($page*$perpage)-$perpage; 
 
         $param['q']=$this->input->get('q');//from the search field of the article view

        $this->load->model('Category_model');
        $this->load->model('Article_model');
        // for pagination 
        $this->load->library('pagination');
        $config['base_url']=base_url('admin/article/index');
        $config['total_rows']=$this->Article_model->getarticlescount($param); //gives total no of articles count (param is passed to get count of the record when we search it from search bar)
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

       
        $articles= $this->Article_model->getarticles($param);   //for displaying all articles   
        $data['articles']=$articles;
        $data['q']=$param['q'];

        // for displaying selected module in sidebar 
        $data['mainModule']='article';
        $data['subModule']='viewArticle';
        $this->load->view('admin/article/list',$data);

    }
    function create(){

        $this->load->model('Category_model');
        $this->load->model('Article_model');

        //file upload settings
        $this->load->helper('common_helper');
        $config['upload_path'] = './public/uploads/articles/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $categories= $this->Category_model->getcategories();
        $data['categories']= $categories;
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('title','Title','Trim|required');// |min_length[20] used for setting min length
        $this->form_validation->set_rules('author','Author','Trim|required');

        $data['mainModule']='article';
        $data['subModule']='addArticle';

        if ($this->form_validation->run()==true){
            // form validation successful
            if(!empty($_FILES['image']['name'])){
                // upload the image here 
                
                if($this->upload->do_upload('image')){
                    // file uploaded successfully
                    
                    $data=$this->upload->data();
                    
                    
                    // echo "run with image if succesful "; 
                    // exit;
                    $formarray=array();
                    $formarray['category']=$this->input->post('category');
                    $formarray['title']=$this->input->post('title');
                    $formarray['author']=$this->input->post('author');
                    $formarray['description']=$this->input->post('description');
                    $formarray['image']=$data['file_name'];
                    $formarray['status']=$this->input->post('status');
                    $formarray['created']=date('Y-m-d H:i:s');
                    $this->Article_model->create($formarray);

                    // resizing image using common_helper
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],720,1080);//directory path only 
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],270,300);//directory path only 
                    
                    $this->session->set_flashdata('success','Article added successfully with image');
                    redirect(base_url('admin/article'));
                }else{
                    // error in uploading image, shw error
                    
                    $error= $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorimageupload']=$error;
                    // echo $error;
                    // exit;
                    $this->load->view('admin/article/create',$data);

                }

            }else {
                // without image database 
                
                $formarray=array();
                $formarray['category']=$this->input->post('category');
                $formarray['title']=$this->input->post('title');
                $formarray['author']=$this->input->post('author');
                $formarray['description']=$this->input->post('description');
                $formarray['status']=$this->input->post('status');
                $formarray['created']=date('Y-m-d H:i:s');
                $this->Article_model->create($formarray);
                  
                    
                $this->session->set_flashdata('success','Article added successfully');
                redirect(base_url('admin/article/'));

            }
            

        }else{
            // if error in form validation show errors 
           
            
            $this->load->view('admin/article/create',$data);
        }

    }
    function edit($id){
        $this->load->model('Article_model');
        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $categories=$this->Category_model->getcategories();
        $article=$this->Article_model->getarticlebyid($id);

        $data['article']=$article;
        $data['categories']=$categories;


        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('category','Category','trim|required');
        $this->form_validation->set_rules('title','Title','Trim|required');
        $this->form_validation->set_rules('author','Author','Trim|required');
        
        // image upload
        $this->load->helper('common_helper');
        $config['upload_path'] = './public/uploads/articles/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        $data['mainModule']='article';
        $data['subModule']='';


        if ($this->form_validation->run()==true){
            // form validation successful
            if(!empty($_FILES['image']['name'])){
                // upload the image here 
                
                if($this->upload->do_upload('image')){
                    // file uploaded successfully
                    
                    $data=$this->upload->data();
                    
                    
                    // echo "run with image if succesful "; 
                    // exit;
                    $formarray=array();
                    $formarray['category']=$this->input->post('category');
                    $formarray['title']=$this->input->post('title');
                    $formarray['author']=$this->input->post('author');
                    $formarray['description']=$this->input->post('description');
                    $formarray['image']=$data['file_name'];
                    $formarray['status']=$this->input->post('status');
                    $formarray['updated']=date('Y-m-d H:i:s');
                    $this->Article_model->update($formarray,$id);
                   
                    // resizing image using common_helper
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],720,1080);//directory path only 
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb_admin/'.$data['file_name'],270,300);//directory path only 
                    
                    if(file_exists('./public/uploads/articles/'.$article['image'])){
                        unlink('./public/uploads/articles/'.$article['image']);
                    }
                    if(file_exists('./public/uploads/articles/thumb/'.$article['image'])){
                        unlink('./public/uploads/articles/thumb/'.$article['image']);
                    }
                    if(file_exists('./public/uploads/articles/thumb_admin/'.$article['image'])){
                        unlink('./public/uploads/articles/thumb_admin/'.$article['image']);
                    }

                    $this->session->set_flashdata('success','Article updated successfully with image');
                    redirect(base_url('admin/article'));
                }else{
                    // error in uploading image, shw error
                    
                    $error= $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorimageupload']=$error;
                    // echo $error;
                    // exit;
                    $this->load->view('admin/article/edit',$data);

                }

            }else {
                // without image database 
                
                $formarray=array();
                $formarray['category']=$this->input->post('category');
                $formarray['title']=$this->input->post('title');
                $formarray['author']=$this->input->post('author');
                $formarray['description']=$this->input->post('description');
                $formarray['status']=$this->input->post('status');
                $formarray['updated']=date('Y-m-d H:i:s');
                $this->Article_model->update($formarray,$id);
                  
                    
                $this->session->set_flashdata('success','Article updated successfully');
                redirect(base_url('admin/article/'));

            }
            

        }else{
            // if error in form validation show errors 
           
            
            $this->load->view('admin/article/edit',$data);
        }

        

    }
    function delete($id){
       
        $this->load->model('Article_model');
        $article =$this->Article_model->getarticlebyid($id);
        
        if(empty($article)){
            $this->session->set_flashdata('error','Article not found ');
            redirect(base_url('admin/article/index'));
        }
          // delete the photo from the article and thumb 
        if(file_exists('./public/uploads/articles/'.$article['image'])){
            unlink('./public/uploads/articles/'.$article['image']);
        }
        if(file_exists('./public/uploads/articles/thumb/'.$article['image'])){
            unlink('./public/uploads/articles/thumb/'.$article['image']);
        }
        if(file_exists('./public/uploads/articles/thumb_admin/'.$article['image'])){
            unlink('./public/uploads/articles/thumb_admin/'.$article['image']);
        }
        $this->Article_model->delete($id);
        $this->session->set_flashdata('success',"Record Deleted Successfully");
        redirect(base_url('admin/article/index'));
      

    }
}
?>