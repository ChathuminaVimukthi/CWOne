<?php


class Movie{
    private $title;
    private $rYear;
    private $revenue;

    function __construct($title,$rYear,$revenue)
    {
        $this->title = $title;
        $this->rYear = $rYear;
        $this->revenue = $revenue;
    }

    function getTitle(){
        return $this->title;
    }

    function setTitle($title){
        $this->title =$title;
    }

    function getRYear(){
        return $this->rYear;
    }

    function setRYear($rYear){
        $this->rYear =$rYear;
    }

    function getRevenue(){
        return $this->revenue;
    }

    function setRevenue($revenue){
        $this->revenue =$revenue;
    }

}