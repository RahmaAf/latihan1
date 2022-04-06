<?php 

class Perpus extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');

		//load library form validation

		$this->load->library('form_validation');
		//load model user
		$this->load->model('User_m');
	}

	public function index()
	{
		// code...
		//$this->load->view('perpus_v');
		if ($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$this->load->view('perpus_v',$data);
			
		} else {
			//jika tidak ada session,loncat halaman login

			$this->load->view('login_v');
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('username','Username', 'trim|required|callback_check_user');
		$this->form_validation->set_rules('password','Password', 'trim|required|callback_check_login');

		//

		$this->form_validation->set_message('required','{field} harus diisi.');
		$this->form_validation->set_error_delimiters('<div style="color:red;">', '</div><br/>');

		if($this->form_validation->run() == FALSE) {
			//jika login gagal 
			$this->load->view('login_v');
		}else {
			redirect('perpus','refresh');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('perpus','refresh');
	}

	public function check_user($username)
	{
		if(empty($username)){
			$this->form_validation->set_message('check_user', 'Username harus diisi!');
		}else{
			$result = $this->User_m->cek_user($username);
			if($result){
				return $result;
			}else{
				$this->form_validation->set_message('check_user', 'Username tidak ada di sistem');
				return false;
			}
		}
	}

	public function check_login($password)
	{
		if (empty($password)) {
			$this->form_validation->set_message('check_login', 'Password harus diisi!');
		}else{
			//validasi form sukses
			$username = $this->input->post('username');
			//query ke database
			$result = $this->User_m->login($username,$password);

			if($result){
				$sess_array = array();
				foreach($result as $row){
					$sess_array = array(
							'id'  => $row->id,
							'username' => $row->username

					);
					$this->session->set_userdata('logged_in',$sess_array);
				}
				return true;
			} else {
				$this->form_validation->set_message('check_login', 'Password salah');
				return false;
			}
		}
	}
}

?>