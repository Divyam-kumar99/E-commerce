<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Page extends CI_controller{

    function about (){
        $this->load->view('front/about');

    }
    function services (){
        $this->load->model('Category_model');
        $categories=$this->Category_model->getcategoriesfront();
        $data['categories']=$categories;
        $this->load->view('front/services',$data);

    }
    function contact(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('message','Message','required');

        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">','</p>');
        if($this->form_validation->run()=='true'){
            // use smtp to send email to the owner 
            $config= Array(
                'protocol'=>'smtp',
                'smtp_host'=>'ssl://smtp.gmail.com',
                'smtp_port'=> 465,
                'smtp_user'=> 'advocateanju9@gmail.com',
                'smtp_pass'=> 'divyamkumar',
                'mailtype'=> 'html',
                'charset'=> 'iso-8859-1',
            );
            $this->load->library('email',$config);
            $this->email->set_newline('\r\n');
            // these details are used for sending mails 
            $this->email->to('divyam@ajatus.co.in');
            $this->email->from('support@fashionstation.com');
            // $this->email->cc('another@another-example.com');
            // $this->email->bcc('them@their-example.com');

            $this->email->subject('You have an Enquiry');
            $name=$this->input->post('name');            
            $email=$this->input->post('email');            
            $message=$this->input->post('message');    
            $send="Name:".$name;
            $send .= "<br>";        
            $send .= "E-mail:".$email;        
            $send .= "<br>";        
            $send .= "Message:".$message;        
            $send .= "<br>";        
            $send .= "<br>";    
            $send .= "Thanking You";
            $send .= "Regards <br> Fashion Station";        

                
            $this->email->message($send);
            $this->email->send();

            $this->session->set_flashdata('success','Thanks For your enquiry, we will get back to you soon');
            redirect(base_url('page/contact'));
        }else{
            
            $this->load->view('front/contact-us');
        }
    }

}

?>