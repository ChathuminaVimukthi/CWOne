<?php


class NetworkController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function displayFollowers()
    {
        if(isset( $this->session->userdata['logged_in'])) {
            $userid = $this->session->userdata['logged_in']['UserId'];
            $this->load->model('NetworkManager', 'obj');
            $followers = $this->obj->getFollowers($userid);
            $friendCount = $this->obj->getFriends($userid);
            $followingCount = $this->obj->getFollowing($userid);

            $data = array(
                'followers' => $followers,
                'followersCount' => count($followers),
                'followingCount' => count($followingCount),
                'friendsCount' => count($friendCount),
                'flag' => 'follower'
            );
            $this->load->view('network', $data);
        }else{
            redirect('/UserController/logoutUser');
        }

    }

    public function displayFriends()
    {
        if(isset( $this->session->userdata['logged_in'])) {
            $userid = $this->session->userdata['logged_in']['UserId'];
            $this->load->model('NetworkManager', 'obj');
            $followers = $this->obj->getFriends($userid);
            $followersCount = $this->obj->getFollowers($userid);
            $followingCount = $this->obj->getFollowing($userid);

            $data = array(
                'followers' => $followers,
                'followersCount' => count($followersCount),
                'followingCount' => count($followingCount),
                'friendsCount' => count($followers),
                'flag' => 'friends'
            );
            $this->load->view('network', $data);
        }else{
            redirect('/UserController/logoutUser');
        }

    }

    public function displayFollowing()
    {
        if(isset( $this->session->userdata['logged_in'])) {
            $userid = $this->session->userdata['logged_in']['UserId'];
            $this->load->model('NetworkManager', 'obj');
            $followers = $this->obj->getFollowing($userid);
            $friendCount = $this->obj->getFriends($userid);
            $followersCount = $this->obj->getFollowers($userid);
            $data = array(
                'followers' => $followers,
                'followersCount' => count($followersCount),
                'followingCount' => count($followers),
                'friendsCount' => count($friendCount),
                'flag' => 'following'
            );
            $this->load->view('network', $data);
        }else{
            redirect('/UserController/logoutUser');
        }

    }

    public function followUser(){
        if(isset( $this->session->userdata['logged_in'])) {
            $followerId = $this->input->get('USERID');
            $followedId = $this->input->get('FOLLOWEDID');
            $this->load->model('NetworkManager', 'obj');
            $data = array(
                'Follower_Id' => $followerId,
                'Followed_Id' => $followedId
            );
            $this->obj->followUser($data);
            $this->displayFollowers();
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function friendUnfollowUser(){
        if(isset( $this->session->userdata['logged_in'])) {
            $followerId = $this->input->get('USERID');
            $followedId = $this->input->get('FOLLOWEDID');
            $userName = $this->input->get('USERNAME');
            $this->load->model('NetworkManager', 'obj');
            $data = array(
                'Follower_Id' => $followerId,
                'Followed_Id' => $followedId
            );
            $this->obj->unfollowUser($followerId, $followedId);
            $this->displayFriends();
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function unfollowUser(){
        if(isset( $this->session->userdata['logged_in'])) {
            $followerId = $this->input->get('USERID');
            $followedId = $this->input->get('FOLLOWEDID');
            $userName = $this->input->get('USERNAME');
            $this->load->model('NetworkManager', 'obj');
            $data = array(
                'Follower_Id' => $followerId,
                'Followed_Id' => $followedId
            );
            $this->obj->unfollowUser($followerId, $followedId);
            $this->displayFollowing();
        }else{
            redirect('/UserController/logoutUser');
        }
    }
}