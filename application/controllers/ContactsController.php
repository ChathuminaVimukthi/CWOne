<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class ContactsController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index_get(){
        $this->load->view('contactsList');
    }

}