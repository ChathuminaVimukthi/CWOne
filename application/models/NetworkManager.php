<?php

include_once('User.php');

class NetworkManager extends CI_Model
{

    function getFollowers($userid)
    {
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Follower_Id = Users.UserId');
        $this->db->where('Network.Followed_Id', $userid);
        $query = $this->db->get();

        $followerDataFound = array();

        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $followerDataFound[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
            }
            return $followerDataFound;
        } else {
            return $followerDataFound;
        }
    }

    function getUsers($genre, $userid)
    {
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('MusicSelections', 'MusicSelections.User_Id = Users.UserId');
        $this->db->join('MusicGenre', 'MusicGenre.Id = MusicSelections.Genre_Id');
        $this->db->where('MusicGenre.Genre', $genre);
        $query = $this->db->get();


        if ($query->num_rows() != 0) {
            $allUsers = array();
            foreach ($query->result() as $row) {
                if($row->UserId != $userid){
                    $allUsers[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }
            }

            $this->db->select('Users.*');
            $this->db->from('Users');
            $this->db->join('MusicSelections', 'MusicSelections.User_Id = Users.UserId');
            $this->db->join('MusicGenre', 'MusicGenre.Id = MusicSelections.Genre_Id');
            $this->db->join('Network', 'Network.Followed_Id = Users.UserId');
            $this->db->where('MusicGenre.Genre', $genre);
            $this->db->where('Network.Follower_Id', $userid);
            $queryTwo = $this->db->get();

            $followers = array();
            foreach ($queryTwo->result() as $row){
                $followers[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
            }

            $others = array_udiff($allUsers, $followers, function ($obj_one, $obj_two) {
                return $obj_one->getUserId() - $obj_two->getUserId();
            });
            $searchResult = array(
                'followers' => $followers,
                'others' => $others
            );
            return $searchResult;
        }else{
            return false;
        }
    }

    function followUser($data){
        $this->db->insert('Network', $data);
    }

    function getFollowing($userid)
    {
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Followed_Id = Users.UserId');
        $this->db->where('Network.Follower_Id', $userid);
        $query = $this->db->get();

        $followerDataFound = array();

        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $followerDataFound[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
            }
            return $followerDataFound;
        } else {
            return $followerDataFound;
        }
    }
}