<?php

class MovieController extends CI_Controller{

	public function showMovies(){
		$searchyr = $_GET['RELYEAR'];
		$this->load->model('MovieManager', 'obj');
		$moviesFound = $this->obj->getMovies($searchyr);

		$bagOfValues = array(
			'moviesFound' => $moviesFound,
			'searchyr' => $searchyr
		);

		$this->load->view('movieResults', $bagOfValues);
	}

	public function Index(){
		$this->load->view('movie');
	}
}

