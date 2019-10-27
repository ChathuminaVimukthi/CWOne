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
//        $this->load->view('homePage');
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

                $this->displayPosts();
//                print_r($postData['UserId'],false);
//                die();

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
//        print_r($result, false);
//        die();
    }

    public function search()
    {
    }

}