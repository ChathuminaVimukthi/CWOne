<?php


class PublicHomePageController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
    }

    public function Index(){
        $this->displayPosts();
//        $this->load->view('publicHomePage');
    }

    public function displayPosts(){
        $userid = $this->session->userdata['logged_in']['UserId'];
        $this->load->model('PostsManager', 'obj');
        $postsFound = $this->obj->getPostData($userid);

        if($postsFound == 0){
//            print_r('svghsdvhsdjvd ', false);
//            die();
            $data = array(
                'postsFound' => 0
            );
            $this->load->view('publicHomePage', $data);

        }else{
            $data = array(
                'postsFound' => $postsFound
            );
            $this->load->view('publicHomePage', $data);
        }
    }
}