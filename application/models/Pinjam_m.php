<?php
class Pinjam_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insert($data)
	{
		$query = $this->db->insert('pinjam',$data);
		return $query;
	}
}
?>