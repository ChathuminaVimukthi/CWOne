<?php

include_once('User.php');
class UserDetailsManager extends CI_Model{
    function register($user){
        $this->db->insert('Users', $user);
    }

    public function login($data) {


        $condition = "UserName =" . "'" . $data['UserName'] . "' AND " . "Password =" . "'" . $data['Password'] . "'";
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        print_r($condition);
        die();
        if ($query->num_rows() == 1) {

            return true;
        } else {

            return false;
        }
    }

// Read data from database to show data in admin page
    public function read_user_information($username) {

        $condition = "UserName =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
}