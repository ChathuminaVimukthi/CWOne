<?php

include_once('User.php');
include_once('MusicGenre.php');
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

    public function getUserDetails($username) {

        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserName', $username);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row){
                return new User($row->UserId,$row->UserName,$row->FirstName,$row->LastName,$row->Avatar);
            }
        } else {
            return false;
        }
    }

    public function getUserFavoriteMusic($userId){
        $this->db->select('MusicGenre.Genre');
        $this->db->from('MusicGenre');
        $this->db->join('MusicSelections', 'MusicGenre.Id = MusicSelections.Genre_Id');
        $this->db->join('Users', 'MusicSelections.User_Id = Users.UserId');
        $this->db->where('Users.UserId', $userId);
        $query = $this->db->get();

        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row){
                $data[] = $row->Genre;
            }
            return $data;
        } else {
            return false;
        }

    }

    public function getMusicGenres(){
        $this->db->select('*');
        $this->db->from('MusicGenre');
        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row){
                $data[] = new MusicGenre($row->Id, $row->Genre);
            }
            return $data;
        } else {
            return false;
        }
    }
}