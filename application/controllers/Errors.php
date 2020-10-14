<?php
/**
 * 
 */
class Errors extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$this->load->view('form/header');
		$this->load->view('errors/percenterror');

	}
	function already_applied(){
		$this->load->view('form/header');
		$this->load->view('errors/already_applied');
	}
		function overage_error(){
		$this->load->view('form/header');
		$this->load->view('errors/overage');
	}
}


?>