<?php


class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function deletePost(){
        if(isset( $this->session->userdata['logged_in'])) {
            $postId = $this->input->get('ID');
            $this->load->model('PostsManager', 'obj');
            $this->obj->deletePost($postId);

            $userid = $this->session->userdata['logged_in']['UserId'];
            $username = $this->session->userdata['logged_in']['UserName'];
            $this->load->model('UserDetailsManager', 'userObj');
            $this->load->model('PostsManager', 'postObj');
            $this->load->model('NetworkManager', 'netObj');
            $userDetails = $this->userObj->getUserDetails($username);
            $postData = $this->postObj->getPostData($userid);
            $musicGenre = $this->userObj->getUserFavoriteMusic($userid);
            $networkCount = $this->netObj->getNetworkStatistics($userid);
            $friendFlag = $this->netObj->checkFriends($this->session->userdata['logged_in']['UserId'], $userid);

            $data = array(
                'userData' => $userDetails,
                'postData' => $postData,
                'musicGenre' => $musicGenre,
                'followersCount' => $networkCount['followersCount'],
                'followingCount' => $networkCount['followingCount'],
                'friendFlag' => $friendFlag
            );

            $this->load->view('userProfile', $data);
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function followFromProfile(){
        if(isset( $this->session->userdata['logged_in'])) {
            $followerId = $this->input->get('USERID');
            $followedId = $this->input->get('FOLLOWEDID');
            $userName = $this->input->get('USERNAME');
            $this->load->model('NetworkManager', 'obj');
            $data = array(
                'Follower_Id' => $followerId,
                'Followed_Id' => $followedId
            );
            $this->obj->followUser($data);
            redirect('/HomePageController/loadUserPage?USERID=' . $followedId . '&USERNAME=' . $userName);
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function unfollowFromProfile(){
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
            redirect('/HomePageController/loadUserPage?USERID=' . $followedId . '&USERNAME=' . $userName);
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function loadUserPage()
    {
        if(isset( $this->session->userdata['logged_in'])){
            $userid = $this->input->get('USERID');
            $username = $this->input->get('USERNAME');
            $this->load->model('UserDetailsManager', 'obj');
            $this->load->model('PostsManager', 'postObj');
            $this->load->model('NetworkManager', 'netObj');
            $userDetails = $this->obj->getUserDetails($username);
            $postData = $this->postObj->getPostData($userid);
            $musicGenre = $this->obj->getUserFavoriteMusic($userid);
            $networkCount = $this->netObj->getNetworkStatistics($userid);
            $friendFlag = $this->netObj->checkFriends($this->session->userdata['logged_in']['UserId'],$userid);
            $data = array(
                'userData' => $userDetails,
                'postData' => $postData,
                'musicGenre' => $musicGenre,
                'followersCount' => $networkCount['followersCount'],
                'followingCount' => $networkCount['followingCount'],
                'friendFlag' => $friendFlag
            );

            $this->load->view('userProfile', $data);
        }else{
            redirect('/UserController/logoutUser');
        }
    }

}