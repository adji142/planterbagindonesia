<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app extends CI_Controller {

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
		$this->load->view('welcome_message');
	}
    public function addcontact()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$content = $this->input->post('content');
		$mobile = $this->input->post('mobile');

		$data = array(
			'name'			=> $name,
			'email'			=> $email,
			'content'		=> $content,
			'phone'			=> $mobile,
			'submitdate'	=> date("Y-m-d h:i:s")
		);
		$rs = $this->ModelsExecuteMaster->ExecInsert($data,'contactfromuser');
		if ($rs) {
			$data['success'] = true;
			$data['message'] = 'Your mail has been delivered';
		}
		else{
			$data['message'] = 'Failed sending email';
		}
		echo json_encode($data);
	}
	public function FindData()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());

		$id = $this->input->post('id');
		$table = $this->input->post('table');

		$rs = $this->ModelsExecuteMaster->FindData(array('id'=>$id),$table,'id asc');

		if ($rs) {
			$data['success'] = true;
			$data['data'] = $rs->result();
		}
		echo json_encode($data);
	}
}
