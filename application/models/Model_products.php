<?php

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM `products` where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `products` ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM `products` WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if ($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if ($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM `products`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


	public function countTotalbrands()
	{
		$sql = "SELECT * FROM `brands`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countTotalcategory()
	{
		$sql = "SELECT * FROM `categories`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


	public function countTotalattribures()
	{
		$sql = "SELECT * FROM `attributes`";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function topProduct()
	{
		$sql = "
        SELECT p.id, p.name, SUM(oi.qty) AS total_quantity 
		FROM orders_item oi JOIN products p ON oi.product_id = p.id 
		GROUP BY p.id, p.name 
		ORDER BY total_quantity 
		DESC LIMIT 5;
		";

		$query = $this->db->query($sql);

		// Return the number of rows in the result set
		return $query->result_array();
	}

	public function alertProduct()
	{
		$sql = "
        SELECT p.serial,p.qty,p.name,s.name as name_store FROM `products` p JOIN stores s ON p.store_id = s.id WHERE `qty`< 10;";

		$query = $this->db->query($sql);

		// Return the number of rows in the result set
		return $query->result_array();
	}

}