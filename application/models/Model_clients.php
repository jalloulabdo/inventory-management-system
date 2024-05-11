<?php 

class Model_clients extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getClientData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM `clients` WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `clients` WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getClientDataAll($clientId = null) 
	{
		if($clientId) {
			$sql = "SELECT * FROM `clients` WHERE id = ?";
			$query = $this->db->query($sql, array($clientId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `clients`";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = '')
	{

		if($data) {
			$insert = $this->db->insert('clients', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function edit($data = array(), $id = null)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('clients', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id)
	{
        if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('clients');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotaClient()
	{
		$sql = "SELECT * FROM `clients`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
}