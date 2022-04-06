<?php

/**
 * 
 */
class Buku extends CI_Controller
{
	
	var $data = array();

	function __construct()
	{
		parent :: __construct();

		$this->load->helper('form');
		$this->load->helper('url');

		$this->data['opt_kategori'] = array ('' => '- Pilih salah satu -',
											'novel' => 'Novel',
											'komik' => 'Komik',
											'kamus' => 'Kamus');
		$this->load->model('Buku_m');
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
		$config["base_url"] = base_url() . "index.php/Buku/index";
		$config["total_rows"] = $this->Buku_m->jml_Buku();
		$config["per_page"] = 5;
		$config["uri_segment"] = 3;

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->data["links"] = $this->pagination->create_links();

		//$this->add_new();
		$this->data['query'] = $this->Buku_m->get_records(null,null,$config["per_page"], $page);
		$this->load->view('buku_v',$this->data);
	}

	function add_new()
	{
		$this->data['is_update'] = 0;
		$this->load->view('buku_form_v',$this->data);
	}

	function check()
	{
		$this->form_validation->set_rules('id','ID','trim');
		$this->form_validation->set_rules('Judul','Judul','trim|required');
		$this->form_validation->set_rules('Pengarang','Nama Pengarang','trim|required');
		$this->form_validation->set_rules('Kategori','Kategori','trim|required');
		//..................
		$this->form_validation->set_message('required','Data {field} harus diisi.');
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div><br/>');

		if($this->form_validation->run()==true){
			$this->save($this->input->post('is_update',true));

		}else{
			$this->data['is_update'] = $this->input->post('is_update',true);
			$this->load->view('buku_form_v',$this->data);
		}
		

	}

	function save($is_update=0)
	{
		$data['Judul']			= $this->input->post('Judul',true);
		$data['Pengarang']		= $this->input->post('Pengarang',true);
		$data['Kategori']		= $this->input->post('Kategori',true);

		if ($is_update==0)
		{
			//jika tambah data buku baru

			if ($this->Buku_m->insert($data))
				redirect('Buku');
		}
		else
			{
			//jika update data
			$id = $this->input->post('id');

			if($this->Buku_m->update_by_id($data,$id));
			redirect('Buku');
			}
	}

	function edit($id)
	{
		$this->data['query'] = $this->Buku_m->get_records("ID_Buku = '$id'");
		$this->data['is_update'] = 1;

		$this->load->view('buku_form_v',$this->data);

	}

	function delete($id)
	{
		if($this->Buku_m->delete_by_id($id))
		{
			redirect('Buku');
		}
	}
}
