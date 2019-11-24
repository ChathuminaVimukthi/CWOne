<?php


class Post{
    private $postId;
    private $userId;
    private $userAvatar;
    private $userName;
    private $date;
    private $content;

    public function __construct($postId,$userId, $userAvatar, $userName, $date, $content)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->userAvatar = $userAvatar;
        $this->userName = $userName;
        $this->date = $date;
        $this->content = $content;
    }

    public function getPostId(){
        return $this->postId;
    }

    public function setPostId($postId){
        $this->postId = $postId;
    }

    public function getUserAvatar()
    {
        return $this->userAvatar;
    }

    public function setUserAvatar($userAvatar)
    {
        $this->userAvatar = $userAvatar;
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