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

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode);
            }
            return $contactsArr;
        }
    }

    public function getContactByName($userId,$contactName){
        $this->db->select('*');
        $this->db->from('Contacts');
        $this->db->where('UserId', $userId);
        $this->db->where('LastName', $contactName);
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

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode);
            }
        }

        $this->db->select('Contacts.*', FALSE);
        $this->db->from('Contacts');
        $this->db->join('TagsSelected', 'TagsSelected.Contact_Id  = Contacts.Id', 'left');
        $this->db->join('ContactTags', 'ContactTags.Id  = TagsSelected.Tag_Id', 'inner');
        $this->db->where('Contacts.UserId', $userId);
        $this->db->where('ContactTags.Name', $contactName);

        $query_result = $this->db->get();
        $result = $query_result->result();

        if($query_result->num_rows() > 0){
            foreach ($result as $row) {
                $this->db->select('ContactTags.*');
                $this->db->from('ContactTags');
                $this->db->join('TagsSelected', 'ContactTags.Id = TagsSelected.Tag_Id');
                $this->db->join('Contacts', 'Contacts.Id = TagsSelected.Contact_Id');
                $this->db->where('Contacts.Id', $row->Id);
                $queryThree = $this->db->get();
                $tags = $queryThree->result();
                $tagIds = array();
                $tagNames = array();
                foreach ($tags as $tag){
                    $tagIds[] = $tag->Id;
                    $tagNames[] = $tag->Name;
                }

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode);
            }
        }

        return $contactsArr;

    }

    public function getContactById($userId,$contactId){
        $this->db->select('*');
        $this->db->from('Contacts');
        $this->db->where('UserId', $userId);
        $this->db->where('Id', $contactId);
        $query = $this->db->get();

        $contactsArr = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $this->db->select('*');
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

                $contactsArr[] = new Contact($row->Id,$row->FirstName,$row->LastName,$row->Email,$row->MobileNumber,$tagNames,$tagIds,$row->ColorCode);
            }
            return $contactsArr;
        }
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