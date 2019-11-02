<?php

include_once('User.php');
class NetworkManager extends CI_Model {

    function getFollowers($userid){
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Follower_Id = Users.UserId');
        $this->db->where('Network.Followed_Id', $userid);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            $followerDataFound = array();
            foreach ($query->result() as $row){
                $followerDataFound[] = new User($row->UserId,$row->UserName,$row->FirstName,$row->LastName,$row->Avatar);
            }
            return $followerDataFound;
        } else {
            return 0;
        }
    }

    function getFollowing($userid){
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Followed_Id = Users.UserId');
        $this->db->where('Network.Follower_Id', $userid);
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            $followerDataFound = array();
            foreach ($query->result() as $row){
                $followerDataFound[] = new User($row->UserId,$row->UserName,$row->FirstName,$row->LastName,$row->Avatar);
            }
            return $followerDataFound;
        } else {
            return 0;
        }
    }
}