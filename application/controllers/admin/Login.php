<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Login extends CI_controller{

    function index(){
        // echo password_hash('divy',PASSWORD_DEFAULT);
        //to get the hash password
        $sess= $this->session->userdata('admin');
        //    print_r( $sess); //to check if sesssion is created
        if(!empty($sess)){
            redirect(base_url('admin/home/'));
        }

        $this->load->library('form_validation');

        $this->load->view('admin/login');
    }
    function authenticate(){
        $this->load->library('form_validation');
        $this->load->model('Admin_model');
        $this->form_validation->set_rules('username','Username','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required');

        if($this->form_validation->run()){
            // success in form validation
            $username=$this->input->post('username');
            $admin=$this->Admin_model->getbyusername($username);//from here username is passed to admin model function
            
            if(!empty($admin)){
                $pass=$this->input->post('password');//get data from the form in login view
                //successfully found username in the database
                if(password_verify( $pass,$admin['password'])==true){
                    $adminarray['id']=$admin['id'];
                    $adminarray['username']=$admin['username'];
                    $this->session->set_userdata('admin',$adminarray);
                    redirect(base_url('admin/home'));
                }else{
                    // wrong password 
                    $this->session->set_flashdata('msg','Username or password is incorrect');
                    redirect(base_url('admin/login'));
                    
                }
                
            }else{
                //entry not found in the database
                $this->session->set_flashdata('msg','Username or password is incorrect');
                redirect(base_url('admin/login'));
                
            }

        }else{
                // error in form validation
                $this->load->view('admin/login');
        }
        
    }
    function logout(){
        $this->session->unset_userdata('admin');
        // session_destroy();
        redirect(base_url().'admin/login');
    }
}
?>