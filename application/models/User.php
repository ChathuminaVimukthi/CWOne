<?php


class User
{
    private $userId;
    private $userName;
    private $firstName;
    private $lastName;
    private $userAvatar;

    public function __construct($userId, $userName, $firstName, $lastName, $userAvatar)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userAvatar = $userAvatar;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getUserAvatar()
    {
        return $this->userAvatar;
    }

    public function setUserAvatar($userAvatar)
    {
        $this->userAvatar = $userAvatar;
    }



}