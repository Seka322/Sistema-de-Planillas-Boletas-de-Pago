<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
		$this->load->model('admin');
    }
    public function index()
    {
		if($this->admin->logged_id())
        {
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('admin/dashboard');
			$this->load->view('template/footer');
		}
		else
		{
			redirect('login/index');
		}
    }
}
