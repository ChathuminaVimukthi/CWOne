<?php


class HomePageController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function Index(){
        $this->displayPosts();
    }

    public function addPost(){
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
        }
    }

    public function displayPosts(){
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('PostsManager', 'obj');
        $result = $this->obj->getPostDataForHomePage($userid);

        if($result == 0){
            $data = array(
                'postsFound' => 0
            );
            $this->load->view('homePage',$data);
        }else{
            $data = array(
                'postsFound' => $result
            );
            $this->load->view('homePage',$data);
        }
    }

    public function search()
    {
    }

    public function displayFollowers(){
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('NetworkManager', 'obj');
        $followers = $this->obj->getFollowers($userid);

        if($followers == 0){
//            print_r('svghsdvhsdjvd ', false);
//            die();
            $data = array(
                'followers' => 0
            );
            $this->load->view('network', $data);

        }else{
            $data = array(
                'followers' => $followers
            );
            $this->load->view('network', $data);
        }

    }

    public function displayFollowing(){
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('NetworkManager', 'obj');
        $followers = $this->obj->getFollowing($userid);

        if($followers == 0){
//            print_r('svghsdvhsdjvd ', false);
//            die();
            $data = array(
                'followers' => 0
            );
            $this->load->view('network', $data);

        }else{
            $data = array(
                'followers' => $followers
            );
            $this->load->view('network', $data);
        }

    }

    public function loadUserPage(){
        $userid = $this->input->post('USERID');
        $username = $this->input->post('USERNAME');
        $this->load->model('UserDetailsManager', 'obj');
        $this->load->model('PostsManager', 'postObj');
        $userDetails = $this->obj->getUserDetails($username);
        $postData = $this->postObj->getPostData($userid);


        foreach ($userDetails as $row){
            $data = array(
                'userData' => new User($row->UserId,$row->UserName,$row->FirstName,$row->LastName,$row->Avatar),
                'postData' => $postData
            );
            $this->load->view('userProfile',$data);
        }
    }

}