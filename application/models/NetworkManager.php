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
                if($this->checkFriends($userid,$row->UserId) === 'friends'){

                }else{
                    $followerDataFound[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }
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
            $friends = array();
            $follower = array();
            foreach ($queryTwo->result() as $row){
                if($this->checkFriends($userid,$row->UserId) === 'friends'){
                    $friends[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }else{
                    $follower[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }
                $followers[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
            }

            $others = array_udiff($allUsers, $followers, function ($obj_one, $obj_two) {
                return $obj_one->getUserId() - $obj_two->getUserId();
            });
            $searchResult = array(
                'friends' => $friends,
                'followers' => $follower,
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

    function unfollowUser($followerId,$followedId){
        $this->db->where('Followed_Id',$followedId);
        $this->db->where('Follower_Id',$followerId);
        $this->db->delete('Network');
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
                if($this->checkFriends($userid,$row->UserId) === 'friends'){

                }else{
                    $followerDataFound[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }
            }
            return $followerDataFound;
        } else {
            return $followerDataFound;
        }
    }

    function getFriends($userid){
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Followed_Id = Users.UserId');
        $this->db->where('Network.Follower_Id', $userid);
        $query = $this->db->get();

        $friendDataFound = array();

        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                if($this->checkFriends($userid,$row->UserId) === 'friends'){
                    $friendDataFound[] = new User($row->UserId, $row->UserName, $row->FirstName, $row->LastName, $row->Avatar);
                }
            }
            return $friendDataFound;
        } else {
            return $friendDataFound;
        }
    }

    function getNetworkStatistics($userId){
        $this->db->select('Network.Follower_Id');
        $this->db->from('Network');
        $this->db->where('Network.Follower_Id', $userId);
        $queryOne = $this->db->get();

        $this->db->select('Network.Followed_Id');
        $this->db->from('Network');
        $this->db->where('Network.Followed_Id', $userId);
        $queryTwo = $this->db->get();

        if($queryOne->num_rows() > 0 || $queryTwo->num_rows() > 0){
            $data = array(
                'followersCount' => $queryTwo->num_rows(),
                'followingCount' => $queryOne->num_rows()
            );

            return $data;
        }else{
            return false;
        }

    }

    function checkFriends($userId,$friendId){
        $this->db->select('*');
        $this->db->from('Network');
        $this->db->where('Network.Follower_Id', $userId);
        $this->db->where('Network.Followed_Id', $friendId);
        $queryOne = $this->db->get();
        if($queryOne->num_rows() > 0){
            $this->db->select('*');
            $this->db->from('Network');
            $this->db->where('Network.Followed_Id', $userId);
            $this->db->where('Network.Follower_Id', $friendId);
            $queryTwo = $this->db->get();

            if($queryTwo->num_rows() > 0){
                return 'friends';
            }else{
                return 'following';
            }
        }else{
            return 'not-following';
        }
    }

    function getRecentFollowers($followerId){
        $this->db->select('Users.*');
        $this->db->from('Users');
        $this->db->join('Network', 'Network.Follower_Id = Users.UserId');
        $this->db->where('Network.Followed_Id', $followerId);
        $this->db->order_by('Network.Id','DESC');
        $this->db->limit(3);
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