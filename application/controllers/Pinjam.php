<?php 

class Pinjam extends CI_Controller{

	var $data = array();

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Anggota_m');
		$this->load->model('Buku_m');
		$this->load->model('Pinjam_m');

		//cek sesion login
		if(!is_logged_in()){
			redirect('perpus','refresh');
		}
		
	}

	public function index()
	{
		$this->data['anggota'] = $this->Anggota_m->opt_Anggota();
		$this->data['buku'] = $this->Buku_m->opt_Buku();
		$this->load->view('pinjam_v',$this->data);
	}

	function save()
	{
		$data['ID_Anggota']		= $this->input->post('ID_Anggota',true);
		$data['ID_Buku']		= $this->input->post('ID_Buku',true);
		$data['tgl_pinjam']		= $this->input->post('tgl_pinjam',true);
		$data['tgl_kembali']	= $this->input->post('tgl_kembali',true);
		
		if($this->Pinjam_m->insert($data))
			redirect('perpus');
	}
}