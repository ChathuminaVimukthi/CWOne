<?php

include_once('Post.php');
class PostsManager extends CI_Model{

    function addPost($postData){
        $this->db->insert('Posts', $postData);
    }

    function getPostData($userid){
        $this->db->select('Posts.* , Users.Avatar');
        $this->db->from('Posts');
        $this->db->join('Users', 'Posts.UserId = Users.UserId');
        $this->db->where('Posts.UserId', $userid);
        $this->db->order_by("Date", "DESC");
        $query = $this->db->get();

        $postDataFound = array();
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row){
                $postDataFound[] = new Post($row->Id,$row->UserId,$row->Avatar,$row->UserName,$row->Date,$row->Content);
            }
            return $postDataFound;
        } else {
            return $postDataFound;
        }
    }

    function getPostDataForHomePage($userid){
        $this->db->select('Followed_Id');
        $this->db->from('Network');
        $this->db->where('Follower_Id', $userid);
        $queryOne = $this->db->get()->result();

        $arrOne = array();
        foreach ($queryOne as $value){
            $arrOne[] = $value->Followed_Id;
        }
//        $friendsArray = array_intersect($arrOne, $arrTwo);
        array_push($arrOne, $userid);

        $postDataFound = array();
        foreach ($arrOne as $value){
            $this->db->select('Posts.* , Users.Avatar');
            $this->db->from('Posts');
            $this->db->join('Users', 'Posts.UserId = Users.UserId');
            $this->db->where('Posts.UserId', $value);
            $this->db->order_by("Date", "DESC");
            $query = $this->db->get();

            if ($query->num_rows() != 0) {
                foreach ($query->result() as $row){
                    $postDataFound[] = new Post($row->Id,$row->UserId,$row->Avatar,$row->UserName,$row->Date,$row->Content);
                }
            }
        }

        usort($postDataFound, function ($a, $b){
            return strtotime($a->getDate()) < strtotime($b->getDate());
        });
        if(count($postDataFound) >0){
            return $postDataFound;
        }else{
            return $postDataFound;
        }
    }

    function deletePost($postId){
        $this->db->where('Id',$postId);
        $this->db->delete('Posts');
    }

}