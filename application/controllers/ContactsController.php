<?php

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class ContactsController extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('ContactsManager');
    }

    public function index_get(){
        $this->load->model('ContactsManager', 'obj');
        $result = $this->obj->getContactTags();
        $data = array(
            'tags' => $result
        );
        $this->load->view('contactsList', $data);
    }

    public function addContacts_get(){
        $this->load->view('addContacts');
    }

    public function contact_get(){
        $userId = $this->session->userdata['logged_in']['UserId'];
        $firstName = $this->uri->segment(1, false);
        $caseId = $this->get('caseId');
        switch ($caseId) {
            case 1:
                $contactName = $this->get('lastName');
                $result = $this->ContactsManager->getContactByName($userId,$contactName);
                $contacts = array();
                foreach ($result as $row){
                    $data = array(
                        'id' => $row->getId(),
                        'firstName' => $row->getFirstName(),
                        'lastName' => $row->getLastName(),
                        'email' => $row->getEmail(),
                        'mobileNumber' => $row->getMobileNumber(),
                        'tagIds' => $row->getTagIds(),
                        'tagNames' => $row->getTagNames(),
                        'color' => $row->getColor(),
                        'flag' => $row->getFlag()
                    );
                    array_push($contacts,$data);
                }

                if(count($contacts) > 0){
                    $this->response( $contacts, 200 );
                }else{
                    $noData = array('emptyMsg' => 'false');
                    $this->response( $noData, 200 );
                }
                break;
            default:
                $result = $this->ContactsManager->getContacts($userId);
                $contacts = array();
                foreach ($result as $row){
                    $data = array(
                        'id' => $row->getId(),
                        'firstName' => $row->getFirstName(),
                        'lastName' => $row->getLastName(),
                        'email' => $row->getEmail(),
                        'mobileNumber' => $row->getMobileNumber(),
                        'tagIds' => $row->getTagIds(),
                        'tagNames' => $row->getTagNames(),
                        'color' => $row->getColor()

                    );
                    array_push($contacts,$data);
                }
                $this->response( $contacts, 200 );
        }
    }

    public function contactById_get(){
        $userId = $this->session->userdata['logged_in']['UserId'];
        $contactId = $this->uri->segment(1, false);
        if ($contactId === false) {
            print json_encode(array('status' => 500, 'msg' => 'bad data'));
            return;
        }else{
            $contact = $this->get('id');
            $result = $this->ContactsManager->getContactById($userId,$contact);
            $contacts = array();
            foreach ($result as $row){
                $data = array(
                    'id' => $row->getId(),
                    'firstName' => $row->getFirstName(),
                    'lastName' => $row->getLastName(),
                    'email' => $row->getEmail(),
                    'mobileNumber' => $row->getMobileNumber(),
                    'tagIds' => $row->getTagIds(),
                    'tagNames' => $row->getTagNames(),
                    'color' => $row->getColor()

                );
                array_push($contacts,$data);
            }
            $this->response( $contacts, 200 );
        }
    }

    public function contact_post(){
        $firstName = $this->uri->segment(1, false);
        if ($firstName === false) {
            print json_encode(array('status' => 500, 'msg' => 'bad data'));
            return;
        }
        $userId = $this->session->userdata['logged_in']['UserId'];
        $name = $this->post('firstName');
        $lastName = $this->post('lastName');
        $email = $this->post('email');
        $mobileNumber = $this->post('mobileNumber');
        $tags = $this->post('tags');
        $color = $this->post('color');

        $data = array(
            'UserId' => $userId,
            'FirstName' => $name,
            'LastName' => $lastName,
            'Email' => $email,
            'MobileNumber' => $mobileNumber,
            'ColorCode' => $color
        );
        $insertedId = $this->ContactsManager->saveContact($data,$tags);
        $this->response( $insertedId, 200 );
    }

    public function contact_delete(){
        $contactId = $this->delete('id');

        $this->db->where('Contact_Id',$contactId);
        $this->db->delete('TagsSelected');

        $this->db->where('Id',$contactId);
        $this->db->delete('Contacts');

    }

    public function contact_put(){
        $firstName = $this->uri->segment(1, false);
        if ($firstName === false) {
            print json_encode(array('status' => 500, 'msg' => 'bad data'));
            return;
        }

        $userId = $this->session->userdata['logged_in']['UserId'];
        $contactId = $this->put('id');
        $name = $this->put('firstName');
        $lastName = $this->put('lastName');
        $email = $this->put('email');
        $mobileNumber = $this->put('mobileNumber');
        $tags = $this->put('tags');

        $data = array(
            'Id' => $contactId,
            'FirstName' => $name,
            'LastName' => $lastName,
            'Email' => $email,
            'MobileNumber' => $mobileNumber
        );

        $this->db->where('Contact_Id',$contactId);
        $this->db->delete('TagsSelected');

        $updateData = $this->ContactsManager->updateContact($data,$tags);

    }

    public function tag_get(){
        $result = $this->ContactsManager->getContactTags();
        $tagArray = array();
        foreach ($result as $row){
            $data = array(
                'id' => $row->getId(),
                'tagName' => $row->getGenre()
            );
            array_push($tagArray,$data);
        }
        $this->response( $tagArray, 200 );
    }

    public function tag_post(){
        $tagName = $this->post('tagName');
        $data = array(
            'Name' => $tagName
        );
        $insertedId = $this->ContactsManager->saveTag($data);
        $this->response( $insertedId, 200 );
    }
}