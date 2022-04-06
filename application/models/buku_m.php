<?php

/**
 * 
 */
class Buku_m extends CI_Model
{
	
	function __construct()
	{
		parent:: __construct();
	}

	function jml_Buku()
	{
		return $this->db->count_all('mst_buku');
	}

	function get_records($criteria='', $order='', $limit='', $offset=0)
	{
		$this->db->select('*');
		$this->db->from('mst_buku');

		if ($criteria != '')
		 	$this->db->where($criteria);
		if ($order != '')
			$this->db->order_by($order);
		if ($limit != '')
			$this->db->limit($limit,$offset);

		$query = $this->db->get();
		return $query;
	}

	//tambahan fungsi transaksi pinjam 

	function opt_Buku()
	{
		$this->db->select('ID_Buku,Judul,Pengarang');
		$this->db->from('mst_buku');
		$query=$this->db->get();

		foreach ($query->result() as $row)
		{
			$rowBuku[$row->ID_Buku]=$row->Judul." - ".$row->Pengarang;

		}
		return $rowBuku;
	}

	function insert ($data)
	{
		$query = $this->db->insert('mst_buku', $data);
		return $query;
	}

	function update_by_id ($data, $id)
	{
		$this->db->where("ID_Buku = '$id'");
		$query = $this->db->update('mst_buku', $data);
		return $query;
	}

	function delete_by_id($id)
	{
		$query = $this->db->delete('mst_buku',"ID_Buku = '$id'");
		return $query;
	}

	
}
?>