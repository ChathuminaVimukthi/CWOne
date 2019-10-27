<?php


class Post{
    private $userId;
    private $userName;
    private $date;
    private $content;

    public function __construct($userId, $userName, $date, $content)
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->date = $date;
        $this->content = $content;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }



}