<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelsExecuteMaster');
		$this->load->model('GlobalVar');
		$this->load->model('LoginMod');
	}
	public function index()
	{
		// var_dump(ADMINF.'Index');
		$this->load->view('Root/Index');
	}
	public function dashboard()
	{
		$this->load->view('Root/Dashboard');	
	}
	public function banner()
	{
		$this->load->view('Root/banner');
	}
	public function about()
	{
		$this->load->view('Root/about');
	}
	public function product()
	{
		$this->load->view('Root/product');
	}
	public function contact()
	{
		$this->load->view('Root/contactfromcust');
	}
	public function order()
	{
		$this->load->view('Root/order');
	}
}
