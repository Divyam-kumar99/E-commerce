<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Category extends CI_controller{
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

//it will show category list page  index() 
    function  index (){
        $this->load->model('Category_model');
        // for search 
        $params['queryString']=$this->input->get('q');

        $categories= $this->Category_model->getcategories($params);
        $data['categories']=$categories;
        $data['queryString']=$params['queryString']; //shw search string in search bar
        $data['mainModule']='category';
        $data['subModule']='viewCategory';
        $this->load->view('admin/category/list',$data);

    }   
    function create(){

        $this->load->helper('common_helper');
        $config['upload_path'] = './public/uploads/category/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');

        $data['mainModule']='category';
        $data['subModule']='addCategory';

        if($this->form_validation->run()==True){
            // save data to database
            // print_r($_FILES);
            // exit; // check if file is selected

            if(!empty($_FILES['image']['name'])){
                // upload the image here 
                if($this->upload->do_upload('image')){
                    // file uploaded successfully
                     
                    $data=$this->upload->data();

                    
                    $formarray=array();
                    $formarray['name']=$this->input->post('name');
                    $formarray['img']=$data['file_name'];
                    $formarray['status']=$this->input->post('status');
                    $formarray['created']=date('Y-m-d H:i:s');
                    $this->Category_model->create($formarray);

                    // resizing image using common_helper
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,300);//directory path only 
                    
                    $this->session->set_flashdata('success','Category added successfully');
                    redirect(base_url('admin/category'));

                }else{
                    // encountered some errors that is wrong file type
                    $error= $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorimageupload']=$error;
                    $this->load->view('admin/category/create',$data);

                }


            }else{
                // if user has not selected any image but wants to create a category 
            $formarray=array();
            $formarray['name']=$this->input->post('name');
            $formarray['status']=$this->input->post('status');
            $formarray['created']=date('Y-m-d H:i:s');
            $this->Category_model->create($formarray);
            $this->session->set_flashdata('success','Category added successfully');
            redirect(base_url('admin/category'));
              }
        }else{
            // showerror in form 
            $this->load->view('admin/category/create',$data);
        }
    }
    function edit($id){
        $this->load->model('Category_model');
        $category= $this->Category_model->getcategory($id);
        // print_r ($category);
        

        $this->load->helper('common_helper');
        $config['upload_path'] = './public/uploads/category/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        $this->form_validation->set_rules('name','Name','trim|required');
        $data['mainModule']='category';
        $data['subModule']='';

        if($this->form_validation->run()==True){
            if(!empty($_FILES['image']['name'])){
                // upload the image here 
                if($this->upload->do_upload('image')){
                    // file uploaded successfully
                     
                    $data=$this->upload->data();
                    // delete the existing pic from category and thumb

                    if(file_exists('./public/uploads/category/'.$category['img'])){
                        unlink('./public/uploads/category/'.$category['img']);
                    }
                    if(file_exists('./public/uploads/category/thumb/'.$category['img'])){
                        unlink('./public/uploads/category/thumb/'.$category['img']);
                    }

                    
                    $formarray=array();
                    $formarray['name']=$this->input->post('name');
                    $formarray['img']=$data['file_name'];
                    $formarray['status']=$this->input->post('status');
                    $formarray['updated']=date('Y-m-d H:i:s');
                    $this->Category_model->update($id, $formarray);

                    // resizing image using common_helper
                    resizeimage($config['upload_path'].$data['file_name'],$config['upload_path'].'thumb/'.$data['file_name'],300,300);//directory path only 
                    

                    $this->session->set_flashdata('success','Category Updated successfully');
                    redirect(base_url('admin/category'));

                }else{
                    // encountered some errors that is wrong file type
                    $error= $this->upload->display_errors("<p class='invalid-feedback'>","</p>");
                    $data['errorimageupload']=$error;
                   
                    $data['category']=$category;

                    $this->load->view('admin/category/edit',$data);
                }


            }else{
                // if user has not selected any image but wants to create a category 
            $formarray=array();
            $formarray['name']=$this->input->post('name');
            $formarray['status']=$this->input->post('status');
            $formarray['updated']=date('Y-m-d H:i:s');
            $this->Category_model->update($id, $formarray);
            $this->session->set_flashdata('success','Category updated successfully');
            redirect(base_url('admin/category'));
              }


        }else{
            $data['category']=$category;

            $this->load->view('admin/category/edit',$data);
        }
        
    }
    function delete($id){
        $this->load->model('Category_model');
        $category= $this->Category_model->getcategory($id);
        if(empty($category)){
            $this->session->set_flashdata('error',"Category not found"); 
            redirect(base_url('admin/category/index'));
        }
        
        // delete the photo from the category and thumb 
        if(file_exists('./public/uploads/category/'.$category['img'])){
            unlink('./public/uploads/category/'.$category['img']);
        }
        if(file_exists('./public/uploads/category/thumb/'.$category['img'])){
            unlink('./public/uploads/category/thumb/'.$category['img']);
        }
        
        $this->Category_model->delete($id);
        
        $this->session->set_flashdata('success',"Record Deleted Successfully");
        redirect(base_url('admin/category/index'));
        
    }

}

?>