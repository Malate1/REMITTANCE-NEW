<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->check_session();
		$this->load->model('Crud_Model');
	}
		
	public function index()
	{
		$this->load->view('login');
	}

	private function check_session()
	{
		if($this->session->userdata('username'))
		{
			redirect('main');
		}
	}

	public function login_validation()
	{
		if($this->Crud_Model->checklogin($this->input->post('username'),$this->input->post('password')) == true)
		{
			redirect('main');
		}
		else
		{
			echo 'try';
		}
	}
}
