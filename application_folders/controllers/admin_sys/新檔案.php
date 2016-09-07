<?php
class Daymore extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('date');
		$this -> load -> helper('form');
		
		$this->load->model($this->admin_path.'auth_model');
	}

}