<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

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
	public function addBanner()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$bannerid = $this->input->post('bannerid');
		$title = $this->input->post('title');
		$order = $this->input->post('order');
		$image = $this->input->post('image');
		$formtype = $this->input->post('formtype');

		if ($formtype == 'add') {
			$data = array(
				'alt_tag'	=> $title,
				'order'		=> $order,
				'image'		=> $image,
				'active'	=> 1
			);
			$rs = $this->ModelsExecuteMaster->ExecInsert($data,'sitebanner');
			if ($rs) {
				$data['success'] = true;
				$data['message'] = 'Data Berhasil di simpan';
			}
			else{
				$data['message'] = 'Banner Gagal di simpan';
			}
		}
		else{
			$data = array(
				'alt_tag'	=> $title,
				'order'		=> $order,
				'image'		=> $image,
			);
			$rs = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$bannerid),'sitebanner');
			if ($rs) {
				$data['success'] = true;
				$data['message'] = 'Data Berhasil di simpan';
			}
			else{
				$data['message'] = 'Banner Gagal di simpan';
			}
		}
		echo json_encode($data);
	}
	public function showBannerSlider()
	{
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$rs = $this->ModelsExecuteMaster->FindData(array('active'=>1),'sitebanner',"'order','ASC'");
		if ($rs->num_rows()>0) {
			$data['success']=true;
			$data['data']=$rs->result();
		}
		echo json_encode($data);
	}
	public function addAbout()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$aboutid = $this->input->post('aboutid');
		$formmode = $this->input->post('formmode');

		$hl = $this->input->post('hl');
		$image = $this->input->post('image');
		$id_desc = $this->input->post('id_desc');
		$en_desc = $this->input->post('en_desc');
		$officeaddr = $this->input->post('officeaddr');
		$phone = $this->input->post('phone');
		$secphone = $this->input->post('secphone');
		$fax = $this->input->post('fax');
		$email = $this->input->post('email');

		if ($formmode == 'add') {
			$field = array(
				'date_created'	=> date("Y-m-d"),
				'imageabout'	=> $image,
				'headline'		=> $hl,
				'id_desc'		=> $id_desc,
				'en_desc'		=> $en_desc,
				'active'		=> 1
			);
			$rs = $this->ModelsExecuteMaster->ExecInsert($field,'siteabout');
			if ($rs) {
				$data['success'] = true;
				$data['message'] = 'Data Berhasil di simpan';
			}
			else{
				$data['message'] = 'Banner Gagal di simpan';
			}
		}
		else{
			$field = array(
				'imageabout'	=> $image,
				'headline'		=> $hl,
				'id_desc'		=> $id_desc,
				'en_desc'		=> $en_desc,
				'address'		=> $officeaddr,
				'phone'			=> $phone,
				'secphone'		=> $secphone,
				'fax'			=> $fax,
				'email'			=> $email
			);
			$rs = $this->ModelsExecuteMaster->ExecUpdate($field,array('id'=>$aboutid),'siteabout');
			if ($rs) {
				$data['success'] = true;
				$data['message'] = 'Data Berhasil di simpan';
			}
			else{
				$data['message'] = 'Banner Gagal di simpan';
			}
		}
		echo json_encode($data);
	}
	public function showAbout()
	{
		$id = $this->input->post('id');
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$rs = $this->ModelsExecuteMaster->FindData(array('active'=>1,'id'=>$id),'siteabout',"'order','ASC'");
		if ($rs->num_rows()>0) {
			$data['success']=true;
			$data['data']=$rs->result();
		}
		echo json_encode($data);
	}
	public function showmessage()
	{
		$id = $this->input->post('id');
		$data = array('success' => false ,'message'=>array(),'data'=>array());
		$rs = $this->ModelsExecuteMaster->FindData(array('id'=>$id),'contactfromuser',"'id','ASC'");
		if ($rs->num_rows()>0) {
			$data['success']=true;
			$data['data']=$rs->result();
		}
		echo json_encode($data);
	}

	public function addProduct()
	{
		$data = array('success' => false ,'message'=>array(),'id' =>'');

		$idtitle = $this->input->post('idtitle');
		$entitle = $this->input->post('entitle');
		$order = $this->input->post('order');
		$image = $this->input->post('image');
		$id_desc = $this->input->post('id_desc');
		$en_desc = $this->input->post('en_desc');

		$data = array(
			'linenumb'		=> $order,
			'id_prodtitle'	=> $idtitle,
			'en_prodtitle'	=> $entitle,
			'id_proddesc'	=> $id_desc,
			'en_proddesc'	=> $en_desc,
			'image'			=> $image,
			'createdat'		=> date("Y-m-d"),
			'active'		=> 1
		);
		$rs = $this->ModelsExecuteMaster->ExecInsert($data,'siteproduct');
		if ($rs) {
			$data['success'] = true;
			$data['message'] = 'Data Berhasil di simpan';
		}
		else{
			$data['message'] = 'Banner Gagal di simpan';
		}
		echo json_encode($data);
	}
	function SendMail(){
        $this->load->library('email');
		$email = $this->input->post('email_reciept');
		$content = $this->input->post('message_reciept');

        $data = array('success' => false ,'message'=>array());

        $url = $_SERVER['HTTP_REFERER'];
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.planterbagindonesia.com',//'ssl://srv57.niagahoster.com',
        'smtp_port' => 465 ,//465,
        'smtp_user' => 'marketing@planterbagindonesia.com',//'info@koprasiwanitausahamandiri.com',//'postmaster@sandbox96a59d42d16b45829acd22122c0e4fa2.mailgun.org', //isi dengan gmailmu!
        'smtp_pass' => 'dodolajur',//'Admin123', //isi dengan password gmailmu!
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE,
        'smtp_crypto' => 'ssl'
        );
        $this->email->initialize($config);  
        $this->email->set_newline("\r\n");
        $this->email->from('marketing@planterbagindonesia.com');
        $this->email->to($email); //email tujuan. Isikan dengan emailmu!
        $this->email->subject('[Greating] '.$email.' [This is Reply for your question]');
        
        $this->email->message($content);
        if($this->email->send()){
            $data['success']=true;
        }
        else{
                $data['message']=show_error($this->email->print_debugger());
        }
        echo json_encode($data);
    }
    public function viewData()
    {
    	$id = $this->input->post('id');
    	$table = $this->input->post('table');
		$data = array('success' => false ,'message'=>array(),'data'=>array());

		$rs = $this->ModelsExecuteMaster->FindData(array('id'=>$id),$table,"'id','ASC'");
		if ($rs->num_rows()>0) {
			$data['success']=true;
			$data['data']=$rs->result();
		}
		echo json_encode($data);
    }
    public function deleteRecord()
    {
    	$data = array('success' => false ,'message'=>array(),'id' =>'');

    	$id = $this->input->post('id');
    	$table = $this->input->post('table');

    	$data = array(
    				'active' => 0
    			);

    	$rs = $this->ModelsExecuteMaster->ExecUpdate($data,array('id'=>$id),$table);
		if ($rs) {
			$data['success'] = true;
			$data['message'] = 'Data Berhasil di simpan';
		}
		else{
			$data['message'] = 'Banner Gagal di simpan';
		}
		echo json_encode($data);
    }	
}
