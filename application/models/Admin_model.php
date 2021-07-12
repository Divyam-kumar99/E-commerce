<!-- to get record from database of the username and password entered on login page  -->

<?php
defined ('BASEPATH') or exit ('No direct script access allowed');

class Admin_model extends CI_model{

    function getbyusername($username){
        $this->db->where('username',$username);
        $admin=  $this->db->get('admins')->row_array();
        return $admin;
    }
}



?>