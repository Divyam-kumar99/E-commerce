<!-- controller to view admin dashboard -->

<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Home extends CI_controller{
    function __construct(){
        parent::__construct();
           $sess= $this->session->userdata('admin');
        //    print_r( $sess); //to check if sesssion is created
        if(empty($sess)){
            $this->session->set_flashdata('msg','Please login to continue to admin panel');
            redirect(base_url('admin/login'));
        }
    }

    function index(){

        $this->load->view('admin/dashboard');
    }
   
}
?>