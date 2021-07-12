<!-- this is the home page of the website -->
<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Home extends CI_controller{

    function index (){
        $this->load->model('Article_model');
        $this->load->model('Category_model');
        $this->load->helper('text');
        // for lattest 4 articles
        $param['offset']=4;
        $param['limit']=0;
        $articles=$this->Article_model->getarticlesfront($param);
        $categories=$this->Category_model->getcategoriesfront($param);
        // echo "<pre>";
        // print_r($articles);
        // echo "</pre>";
        // exit;
        $data['categories']=$categories;
        $data['articles']=$articles;

        $this->load->view('front/home',$data);

    }

}

?>