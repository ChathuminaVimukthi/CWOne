<?php


class HomePageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function Index()
    {
        $this->displayPosts();
    }

    public function addPost()
    {
        if(isset( $this->session->userdata['logged_in'])) {
            $this->form_validation->set_rules('POSTCONTENT', 'A message', 'trim|required');
            if ($this->form_validation->run() == true) {
                if (isset($this->session->userdata['logged_in'])) {
                    $userid = $this->session->userdata['logged_in']['UserId'];
                    $username = $this->session->userdata['logged_in']['UserName'];
                    $content = $this->input->post('POSTCONTENT');

                    $postData = array(
                        'UserId' => $userid,
                        'Date' => date('Y-m-d H:i:s'),
                        'Content' => $content,
                        'UserName' => $username
                    );
                    $this->load->model('PostsManager', 'obj');
                    $this->obj->addPost($postData);
                    redirect('HomePageController');

                } else {
                    $this->load->view('homePage');
                }
            } else {
                $this->displayPosts();
            }
        }else{
            redirect('/UserController/logoutUser');
        }
    }

    public function displayPosts()
    {
        if(isset( $this->session->userdata['logged_in'])){
            $userid = $this->session->userdata['logged_in']['UserId'];
            $this->load->model('PostsManager', 'postBbj');
            $this->load->model('NetworkManager', 'netObj');
            $result = $this->postBbj->getPostDataForHomePage($userid);
            $friendCount = $this->netObj->getFriends($userid);
            $followersCount = $this->netObj->getFollowers($userid);
            $followingCount = $this->netObj->getFollowing($userid);
            $recentFollowers = $this->netObj->getRecentFollowers($userid);
            if ($result == 0) {
                $data = array(
                    'postsFound' => 0,
                    'followersCount' => count($followersCount),
                    'followingCount' => count($followingCount),
                    'friendsCount' => count($friendCount),
                    'recentFollowers' => $recentFollowers
                );
                $this->load->view('homePage', $data);
            } else {
                $data = array(
                    'postsFound' => $result,
                    'followersCount' => count($followersCount),
                    'followingCount' => count($followingCount),
                    'friendsCount' => count($friendCount),
                    'recentFollowers' => $recentFollowers
                );
                $this->load->view('homePage', $data);
            }
        }else{
            redirect('/UserController/logoutUser');
        }

    }

    public function search()
    {
        if(isset( $this->session->userdata['logged_in'])) {
            $userid = $this->session->userdata['logged_in']['UserId'];
            $searchStr = trim($this->input->post('SEARCHTXT'));

            if ($searchStr == "") {
                $searchStr = $this->session->userdata['search_str'];
            } else {
                $this->session->set_userdata('search_str', $searchStr);
            }

            $this->load->model('NetworkManager', 'obj');
            $result = $this->obj->getUsers($searchStr, $userid);
            $followers = $this->obj->getFollowers($userid);
            $friendCount = $this->obj->getFriends($userid);
            $followingCount = $this->obj->getFollowing($userid);
            $data = array(
                'followersCount' => count($followers),
                'followingCount' => count($followingCount),
                'friendsCount' => count($friendCount),
                'friends' => $result['friends'],
                'followers' => $result['followers'],
                'others' => $result['others']
            );

            $this->load->view('searchResult', $data);
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
            $this->search();
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
            $this->search();
        }else{
            redirect('/UserController/logoutUser');
        }
    }
}