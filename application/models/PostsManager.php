<?php

include_once('Post.php');
class PostsManager extends CI_Model{

    function addPost($postData){
        $this->db->insert('Posts', $postData);
    }

    function getPostData($userid){
        $this->db->select('*');
        $this->db->from('Posts');
        $this->db->where('UserId', $userid);
        $this->db->order_by("Date", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() != 0) {
            $postDataFound = array();
            foreach ($query->result() as $row){
                $postDataFound[] = new Post($row->UserId,$row->UserName,$row->Date,$row->Content);
            }
            return $postDataFound;
        } else {
            return 0;
        }
    }

    function getPostDataForHomePage($userid){
        $this->db->select('Followed_Id');
        $this->db->from('Network');
        $this->db->where('Follower_Id', $userid);
        $queryOne = $this->db->get()->result();

        $this->db->select('Follower_Id');
        $this->db->from('Network');
        $this->db->where('Followed_Id', $userid);
        $queryTwo = $this->db->get()->result();

        $arrOne = array();
        foreach ($queryOne as $value){
            $arrOne[] = $value->Followed_Id;
        }

        $arrTwo = array();
        foreach ($queryTwo as $value){
            $arrTwo[] = $value->Follower_Id;
        }

        $friendsArray = array_intersect($arrOne, $arrTwo);
        array_push($friendsArray, $userid);

        $postDataFound = array();
        foreach ($friendsArray as $value){
            $this->db->select('*');
            $this->db->from('Posts');
            $this->db->where('UserId', $value);
            $this->db->order_by("Date", "DESC");
            $query = $this->db->get();

            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row){
                    $postDataFound[] = new Post($row->UserId,$row->UserName,$row->Date,$row->Content);
                }
            } else {
                return 0;
            }
        }

        usort($postDataFound, function ($a, $b){
            return strtotime($a->getDate()) < strtotime($b->getDate());
        });
        return $postDataFound;
    }

}