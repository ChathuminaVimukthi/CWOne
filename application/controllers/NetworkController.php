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
            $networkCount = $this->obj->getNetworkStatistics($userid);

            $data = array(
                'followers' => $followers,
                'followersCount' => $networkCount['followersCount'],
                'followingCount' => $networkCount['followingCount'],
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
            $networkCount = $this->obj->getNetworkStatistics($userid);

            $data = array(
                'followers' => $followers,
                'followersCount' => $networkCount['followersCount'],
                'followingCount' => $networkCount['followingCount'],
            );
            $this->load->view('network', $data);
        }else{
            redirect('/UserController/logoutUser');
        }

    }
}