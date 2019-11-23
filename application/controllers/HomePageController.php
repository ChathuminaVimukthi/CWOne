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
        }else {
            $this->displayPosts();
        }
    }

    public function displayPosts()
    {
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('PostsManager', 'postBbj');
        $result = $this->postBbj->getPostDataForHomePage($userid);

        if ($result == 0) {
            $data = array(
                'postsFound' => 0
            );
            $this->load->view('homePage', $data);
        } else {
            $data = array(
                'postsFound' => $result
            );
            $this->load->view('homePage', $data);
        }
    }

    public function search()
    {
        $userid = $this->session->userdata['logged_in']['UserId'];
        $searchStr = trim($this->input->post('SEARCHTXT'));

        if($searchStr == ""){
            $searchStr = $this->session->userdata['search_str'];
        }else{
            $this->session->set_userdata('search_str', $searchStr);
        }

        $this->load->model('NetworkManager', 'obj');
        $result = $this->obj->getUsers($searchStr, $userid);
        $this->load->view('searchResult', $result);
    }

    public function displayFollowers()
    {
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('NetworkManager', 'obj');
        $followers = $this->obj->getFollowers($userid);

        $data = array(
            'followers' => $followers
        );
        $this->load->view('network', $data);

    }

    public function displayFollowing()
    {
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('NetworkManager', 'obj');
        $followers = $this->obj->getFollowing($userid);

        $data = array(
            'followers' => $followers
        );
        $this->load->view('network', $data);


    }

    public function loadUserPage()
    {
        $userid = $this->input->get('USERID');
        $username = $this->input->get('USERNAME');
        $this->load->model('UserDetailsManager', 'obj');
        $this->load->model('PostsManager', 'postObj');
        $userDetails = $this->obj->getUserDetails($username);
        $postData = $this->postObj->getPostData($userid);

        $data = array(
            'userData' => $userDetails,
            'postData' => $postData
        );

        $this->load->view('userProfile', $data);
    }

    public function followUser(){
        $followerId = $this->input->get('USERID');
        $followedId = $this->input->get('FOLLOWEDID');
        $this->load->model('NetworkManager', 'obj');
        $data = array(
            'Follower_Id' => $followerId,
            'Followed_Id' => $followedId
        );
        $this->obj->followUser($data);
        $this->search();
    }
}