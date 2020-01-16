<?php

include_once('MusicGenre.php');
include_once('Contact.php');
class ContactsManager extends CI_Model
{

    public function getContactTags(){
        $this->db->select('*');
        $this->db->from('ContactTags');
        $query = $this->db->get();
        $data = array();
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row){
                $data[] = new MusicGenre($row->Id, $row->Name);
            }
            return $data;
        } else {
            return false;
        }
    }

    public function getContacts($userId){
        $this->db->select('*');
        $this->db->from('Contacts');
        $this->db->where('UserId', $userId);
        $this->db->order_by("FirstName", "ASC");
        $query = $this->db->get();

        $contactsArr = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->select('ContactTags.*');
                $this->db->from('ContactTags');
                $this->db->join('TagsSelected', 'ContactTags.Id = TagsSelected.Tag_Id');
                $this->db->join('Contacts', 'Contacts.Id = TagsSelected.Contact_Id');
                $this->db->where('Contacts.Id', $row->Id);
                $queryTwo = $this->db->get();
                $tags = $queryTwo->result();
                $tagIds = array();
                $tagNames = array();
                foreach ($tags as $tag){
                    $tagIds[] = $tag->Id;
                    $tagNames[] = $tag->Name;
                }

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode, "");
            }
            return $contactsArr;
        }
    }

    public function getContactsById($contId){
        $this->db->select('*');
        $this->db->from('Contacts');
        $this->db->where('Id', $contId);
        $this->db->order_by("FirstName", "ASC");
        $query = $this->db->get();

        $contactsArr = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->select('ContactTags.*');
                $this->db->from('ContactTags');
                $this->db->join('TagsSelected', 'ContactTags.Id = TagsSelected.Tag_Id');
                $this->db->join('Contacts', 'Contacts.Id = TagsSelected.Contact_Id');
                $this->db->where('Contacts.Id', $row->Id);
                $queryTwo = $this->db->get();
                $tags = $queryTwo->result();
                $tagIds = array();
                $tagNames = array();
                foreach ($tags as $tag){
                    $tagIds[] = $tag->Id;
                    $tagNames[] = $tag->Name;
                }

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode, "");
            }
            return $contactsArr;
        }
    }

    public function getContactByName($userId,$contactName){
        $this->db->select('Contacts.*, GROUP_CONCAT(DISTINCT ContactTags.Id) as TagCodeList, GROUP_CONCAT(DISTINCT ContactTags.Name) as TagNameList');
        if (count($contactName) > 0) {
            foreach ($contactName as $m) {
                $this->db->or_like('LastName', $m);
                $this->db->where('UserId', $userId);
            }
        }
        $this->db->join('TagsSelected', 'TagsSelected.Contact_Id = Contacts.Id', 'left outer');
        $this->db->join('ContactTags', 'ContactTags.Id = TagsSelected.Tag_Id', 'left outer');
        $this->db->group_by('Contacts.Id');
        $resultLastName = $this->db->get('Contacts');
        $contactFound = array();
        if ($resultLastName->num_rows() != 0) {
            foreach ($resultLastName->result() as $row) {
                $tagList = explode(",", $row->TagCodeList);
                $tagnamelist = explode(",", $row->TagNameList);

                $contId  = $row->Id;
                $contactFound[] = new Contact($contId, $row->FirstName, $row->LastName, $row->Email, $row->MobileNumber, $tagnamelist,$tagList, $row->ColorCode,"1");
            }
        }

        $this->db->select('Contacts.*, GROUP_CONCAT(DISTINCT ContactTags.Id) as TagCodeList, GROUP_CONCAT(DISTINCT ContactTags.Name) as TagNameList');
        if (count($contactName) > 0) {
            foreach ($contactName as $m) {
                $this->db->or_like('ContactTags.Name', $m);
                $this->db->where('UserId', $userId);
            }
        }
        $this->db->join('TagsSelected', 'TagsSelected.Contact_Id = Contacts.Id', 'left outer');
        $this->db->join('ContactTags', 'ContactTags.Id = TagsSelected.Tag_Id', 'left outer');
        $this->db->group_by('Contacts.Id');
        $resultLastName = $this->db->get('Contacts');
        if ($resultLastName->num_rows() != 0) {
            foreach ($resultLastName->result() as $row) {
                $this->db->select('ContactTags.*');
                $this->db->from('ContactTags');
                $this->db->join('TagsSelected', 'ContactTags.Id = TagsSelected.Tag_Id');
                $this->db->join('Contacts', 'Contacts.Id = TagsSelected.Contact_Id');
                $this->db->where('Contacts.Id', $row->Id);
                $queryTwo = $this->db->get();
                $tags = $queryTwo->result();
                $tagIds = array();
                $tagNames = array();
                foreach ($tags as $tag){
                    $tagIds[] = $tag->Id;
                    $tagNames[] = $tag->Name;
                }

                $contactFound[] = new Contact($row->Id, $row->FirstName, $row->LastName, $row->Email, $row->MobileNumber, $tagNames,$tagIds, $row->ColorCode ,"2");
            }
        }

        return $contactFound;
    }

    public function saveContact($data,$tags){
        $this->db->insert('Contacts', $data);
        $userId = $data['UserId'];
        $insert_id = $this->db->insert_id();
        if($userId){
            foreach ($tags as $tag){
                $tagData = array("Tag_Id"=>$tag,"Contact_Id"=>$insert_id);
                $this->db->insert('TagsSelected', $tagData);
            }
            return $insert_id;
        }
    }

    public function saveTag($tagName){
        $this->db->insert('ContactTags', $tagName);
        return $this->db->insert_id();
    }

    public function updateContact($data, $tags){
        foreach ($tags as $tag){
            $tagData = array("Tag_Id"=>$tag,"Contact_Id"=>$data['Id']);
            $this->db->insert('TagsSelected', $tagData);
        }

        $this->db->where('Id', $data['Id']);
        $this->db->update('Contacts', $data);

        return true;
    }

}