<?php


class UserController extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
    }

    public function Index(){
        $this->load->view('musicsLogin');
    }

    public function showRegistration(){
        $this->displayGenre("");
    }

    public function showLogin(){
        $this->load->view('musicsLogin');
    }

    public function register(){
        $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
        $this->form_validation->set_rules('PASSWORD', 'Password', 'trim|required|min_length[5]|matches[CONFIRMPASSWORD]');
        $this->form_validation->set_rules('CONFIRMPASSWORD', 'Confirm password', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('FIRSTNAME', 'First Name', 'trim|required');
        $this->form_validation->set_rules('LASTNAME', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('IMAGEURL', 'Profile Image URL', 'trim|required');

        if ($this->form_validation->run() == true) {
            $this->load->model('UserDetailsManager', 'obj');
            $result = $this->obj->getUserDetails($this->input->post('USERNAME'));
            if ($result) {
                $this->displayGenre('Username already in use!');
            }else{
                $user = array(
                    'UserName' => $this->input->post('USERNAME'),
                    'LastName' => $this->input->post('LASTNAME'),
                    'FirstName' => $this->input->post('FIRSTNAME'),
                    'Password' => md5($this->input->post('PASSWORD')),
                    'Avatar' => $this->input->post('IMAGEURL')
                );

                $genre = $this->input->post('genre');

                $this->obj->register($user,$genre);

                $this->load->view('musicsLogin');
            }
        } else {
            if(isset($this->session->userdata['logged_in'])){
                redirect(base_url() . "index.php/HomePageController");
            }else{
                $this->displayGenre("");
            }
        }


    }

    public function login() {

        $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
        $this->form_validation->set_rules('PASSWORD', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            if(isset($this->session->userdata['logged_in'])){
                redirect(base_url() . "index.php/HomePageController");
            }else{
                $this->load->view('musicsLogin');
            }
        } else {
            $data = array(
                'UserName' => $this->input->post('USERNAME'),
                'Password' => md5($this->input->post('PASSWORD'))
            );
            $this->load->model('UserDetailsManager', 'obj');
            $result = $this->obj->login($data);
            if ($result == true) {
                $username = $this->input->post('USERNAME');
                $result = $this->obj->getUserDetails($username);
                if ($result) {
                    $resultTwo = $this->obj->getUserFavoriteMusic($result->getUserId());
                    $session_data = array(
                        'UserName' => $result->getUserName(),
                        'UserId' => $result->getUserId(),
                        'Avatar' => $result->getUserAvatar(),
                        'FirstName' => $result->getFirstName(),
                        'LastName' => $result->getLastName(),
                        'MusicsTypes' => $resultTwo
                    );

                    $this->session->set_userdata('logged_in', $session_data);
                    redirect(base_url() . "index.php/HomePageController");
                }
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('musicsLogin', $data);
            }
        }
    }

    public function displayGenre($error){
        $this->load->model('UserDetailsManager', 'obj');
        $result = $this->obj->getMusicGenres();

        $data = array(
            'error_message' => $error,
            'musicGenre' => $result
        );

        $this->load->view('musicsRegister', $data);
    }

    public function logoutUser(){
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
//        $data['logout_message'] = 'Logged Out';
//        $this->load->view('musicsLogin',$data);
        $this->load->view('musicsLogin');
    }
}