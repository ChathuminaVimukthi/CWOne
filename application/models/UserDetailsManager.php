<?php

include_once('User.php');
class UserDetailsManager extends CI_Model{
    function register($user){
        $this->db->insert('Users', $user);
    }

    public function login($data) {

        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserName',$data['UserName']);
        $this->db->where('Password',$data['Password']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

// Read data from database to show data in admin page
    public function read_user_information($username) {

        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserName', $username);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}