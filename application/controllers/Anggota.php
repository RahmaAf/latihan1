<?php

/**
 * 
 */
class Anggota extends CI_Controller
{
	
	var $data = array();

	function __construct()
	{
		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');

		$this->data['opt_progdi'] = array ('' => '- Pilih salah satu -',
											'teknik informatika' => 'Teknik informatika',
											'sistem informasi' => 'Sistem informasi',
											'ilmu komunikasi' => 'Ilmu komunikasi');
		$this->load->model('Anggota_m');
		// cek session login
		if(!is_logged_in()){
			redirect('perpus','refresh');
		}
		$this->load->library('form_validation');
		$this->load->library('pagination');
		//cek sesion login
		if(!is_logged_in()){
			redirect('perpus','refresh');
		}


	}

	public function index()
	{
		$config = array();
		$config["base_url"] = base_url() . "index.php/Anggota/index";
		$config["total_rows"] = $this->Anggota_m->jml_anggota();
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["links"] = $this->pagination->create_links();

		//$this->add_new();
		$this->data['query'] = $this->Anggota_m->get_records(null,null,$config["per_page"], $page);
		$this->load->view('anggota_v',$this->data);
	}

	function add_new()
	{
		$this->data['is_update'] = 0;
		$this->load->view('anggota_form_v',$this->data);
	}

	function check()
	{
		$this->form_validation->set_rules('id','ID','trim');
		$this->form_validation->set_rules('nim','NIM','trim|required');
		$this->form_validation->set_rules('nama','Nama','trim|required');
		$this->form_validation->set_rules('progdi','Progdi','trim|required');
		//..................
		$this->form_validation->set_message('required','Data {field} harus diisi.');
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div><br/>');

		if($this->form_validation->run()==true){
			$this->save($this->input->post('is_update',true));

		}else{
			$this->data['is_update'] = $this->input->post('is_update',true);
			$this->load->view('anggota_form_v',$this->data);
		}
	}

	function save($is_update=0)
	{
		$data['NIM']		= $this->input->post('nim',true);
		$data['Nama']		= $this->input->post('nama',true);
		$data['Progdi']		= $this->input->post('progdi',true);

		if ($is_update==0)
		{
			//jika tambah data anggota baru

			if ($this->Anggota_m->insert($data))
				redirect('Anggota');
		}
		else
			{
			//jika update data
			$id = $this->input->post('id');

			if($this->Anggota_m->update_by_id($data,$id));
			redirect('Anggota');
			}
	}

	function edit($id)
	{
		$this->data['query'] = $this->Anggota_m->get_records("ID_Anggota = '$id'");
		$this->data['is_update'] = 1;

		$this->load->view('anggota_form_v',$this->data);

	}

	function delete($id)
	{
		if($this->Anggota_m->delete_by_id($id))
		{
			redirect('Anggota');
		}
	}
}
