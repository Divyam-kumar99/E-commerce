<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Review_model extends CI_model{

    function create ($formarray){
        $this->db->insert('reviews',$formarray);

    }
    function getreviews($id){
        $data['article_id']=$id;
        $data['status']=1;
        $this->db->where($data);
        $this->db->order_by('created','DESC');
        return $reviews=$this->db->get('reviews')->result_array();
    }
}

?>