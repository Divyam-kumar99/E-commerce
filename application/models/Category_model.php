<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Category_model extends CI_model{

    function create ($formarray){
        $this->db->insert('categories',$formarray);

    }
    function getcategories($params=[]){
        // for particular search category 
        if(!empty($params['queryString'])){
            $this->db->like('name',$params['queryString']);
        }
        // to get all the categories to display in list view
       return $result= $this->db->get('categories')->result_array();

    }
    function getcategory($id) {    //to get the row from the database to edit
        $this->db->where('id',$id);
        return $category=$this->db->get('categories')->row_array();

    }
    function update($id, $formarray){
        $this->db->where('id',$id);
        $this->db->update('categories',$formarray);

    }
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete("categories");
    }
    function getcategoriesfront($params=[]){
        // for showing 4categories on home page 
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'],$param['limit']);
        }
        // for particular search category 
        if(!empty($params['queryString'])){
            $this->db->like('name',$params['queryString']);
        }
        // to get all the categories to display in list view
        $this->db->where('status',1);
       return $result= $this->db->get('categories')->result_array();

    } 
}

?>      