<?php

include_once("Movie.php");
class MovieManager extends CI_Model{
    function getMovies($searchyr){
        $conn = mysqli_connect('localhost','root','','2016238');
        $res = mysqli_query($conn, 'select * from movie where relyear<='.$searchyr);

        $moviesFound = array();

        while (($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) != NULL) {
            $moviesFound[] = new Movie($row['title'],$row['relyear'],$row['revenue']);
        }

        return $moviesFound;
    }

}
