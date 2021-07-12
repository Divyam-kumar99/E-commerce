<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Article_model extends CI_model{

    function create ($formarray){
        $this->db->insert('articles',$formarray);

    }
    function getarticles($param=array()){
        // for pagination 
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'],$param['limit']);
        }

        // for search 
        if(isset($param['q'])){
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }
         // for joining 
         $this->db->select('articles.*,categories.name as category_name');
         $this->db->order_by('articles.created','DESC');
         $this->db->join('categories','categories.id=articles.category','left');
 
        return $articles=$this->db->get('articles')->result_array();
    }
    function getarticlescount($param=array()){
         // for search 
         if(isset($param['q'])){
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }
        if(isset($param['category_id'])){
            $this->db->where('articles.category',$param['category_id']);
        }

        // to count total no of articles for pagination 
        $count=$this->db->count_all_results('articles');
        return $count;
    }
    function getarticlebyid($id){
        $this->db->where('id',$id);
        $article=$this->db->get('articles')->row_array();
        
        return $article;
    }
    function update($formarray,$id){
        $this->db->where('id',$id);
        $this->db->update('articles',$formarray);
    }
    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete("articles");
    }
    // for front end lattest 4 articles
    function getarticlesfront($param=array()){
        // for pagination 
        if(isset($param['offset']) && isset($param['limit'])){
            $this->db->limit($param['offset'],$param['limit']);
        }

        // for search 
        if(isset($param['q'])){
            $this->db->or_like('title',trim($param['q']));
            $this->db->or_like('author',trim($param['q']));
        }

        // for category based article return
        if(isset($param['category_id'])){
            $condition['articles.category']=$param['category_id'];
        }

        // for joining 
        $this->db->select('articles.*,categories.name as category_name');
        $condition['articles.status']=1;
        $this->db->where($condition);
        $this->db->order_by('articles.created','DESC');
        $this->db->join('categories','categories.id=articles.category','left');

        return $articles=$this->db->get('articles')->result_array();
    }
    function getarticlebyidfront($id){
        $this->db->select('articles.*,categories.name as category_name');
        $this->db->where('articles.id',$id);
        $this->db->join('categories','categories.id=articles.category','left');
        $article=$this->db->get('articles')->row_array();
        
        return $article;
    }
}

?>