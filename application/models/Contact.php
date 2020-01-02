<?php


class Contact
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $mobileNumber;
    private $tagNames;
    private $tagIds;
    private $color;

    public function __construct($id, $firstName, $lastName, $email, $mobileNumber, $tagNames,$tagIds,$color)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->mobileNumber = $mobileNumber;
        $this->tagNames = $tagNames;
        $this->tagIds = $tagIds;
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * @param mixed $mobileNumber
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;
    }

    /**
     * @return mixed
     */
    public function getTagNames()
    {
        return $this->tagNames;
    }

    /**
     * @param mixed $tagNames
     */
    public function setTagNames($tagNames)
    {
        $this->tagNames = $tagNames;
    }

    /**
     * @return mixed
     */
    public function getTagIds()
    {
        return $this->tagIds;
    }

    /**
     * @param mixed $tagIds
     */
    public function setTagIds($tagIds)
    {
        $this->tagIds = $tagIds;
    }

}