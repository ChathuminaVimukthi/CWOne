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
        $this->load->view('musicsRegister');
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
        $this->form_validation->set_rules('CITY', 'City', 'trim|required');

        if ($this->form_validation->run() == true) {
            $user = array(
                'UserName' => $this->input->post('USERNAME'),
                'LastName' => $this->input->post('LASTNAME'),
                'FirstName' => $this->input->post('FIRSTNAME'),
                'Password' => md5($this->input->post('PASSWORD')),
                'City' => $this->input->post('CITY')
            );

            $this->load->model('UserDetailsManager', 'obj');
            $this->obj->register($user);

            $this->load->view('musicsLogin');
        }
        else {
            $this->load->view('musicsRegister');
        }


    }

    public function login() {

        $this->form_validation->set_rules('USERNAME', 'Username', 'trim|required');
        $this->form_validation->set_rules('PASSWORD', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            if(isset($this->session->userdata['logged_in'])){
                $this->load->view('homePage');
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
//                $username = $this->input->post('USERNAME');
//                $result = $this->obj->read_user_information($username);
//                if ($result != false) {
//                    $session_data = array(
//                        'UserName' => $result[0]->user_name,
//                        'Password' => $result[0]->password,
//                    );
//
//                    $this->session->set_userdata('logged_in', $session_data);
//                    $this->load->view('homePage');
//                }
                $this->load->view('movie');
            } else {
                $data = array(
                    'error_message' => 'Invalid Username or Password'
                );
                $this->load->view('musicsLogin', $data);
            }
        }
    }
}