<?php

class Model_orders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM `orders` WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `orders` ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if (!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM `orders_item` WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$bill_no = 'BILPR-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
		$data = array(
			'bill_no' => $bill_no,
			'customer_id' => $this->input->post('customer_id'),
			'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'gross_amount' => $this->input->post('gross_amount_value'),
			'service_charge_rate' => $this->input->post('service_charge_rate'),
			'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value') : 0,
			'vat_charge_rate' => $this->input->post('vat_charge_rate'),
			'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
			'net_amount' => $this->input->post('net_amount_value'),
			'discount' => $this->input->post('discount'),
			'paid_status' => 2,
			'user_id' => $user_id
		);

		$insert = $this->db->insert('orders', $data);
		$order_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
		for ($x = 0; $x < $count_product; $x++) {

			$items = array(
				'order_id' => $order_id,
				'product_id' => $this->input->post('product')[$x],
				'qty' => $this->input->post('qty')[$x],
				'rate' => $this->input->post('rate_value')[$x],
				'amount' => $this->input->post('amount_value')[$x],
			);

			$this->db->insert('orders_item', $items);

			// now decrease the stock from the product
			$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
			$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

			$update_product = array('qty' => $qty);


			$this->model_products->update($update_product, $this->input->post('product')[$x]);
		}

		return ($order_id) ? $order_id : false;
	}

	public function countOrderItem($order_id)
	{
		if ($order_id) {
			$sql = "SELECT * FROM `orders_item` WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if ($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 

			$data = array(
				'customer_id' => $this->input->post('customer_id'),
				'gross_amount' => $this->input->post('gross_amount_value'),
				'service_charge_rate' => $this->input->post('service_charge_rate'),
				'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value') : 0,
				'vat_charge_rate' => $this->input->post('vat_charge_rate'),
				'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
				'net_amount' => $this->input->post('net_amount_value'),
				'discount' => $this->input->post('discount'),
				'paid_status' => $this->input->post('paid_status'),
				'type_payment' => $this->input->post('type_payment'),
				'user_id' => $user_id
			);

			$this->db->where('id', $id);
			$update = $this->db->update('orders', $data);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getOrdersItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);

				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('order_id', $id);
			$this->db->delete('orders_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
			for ($x = 0; $x < $count_product; $x++) {
				$items = array(
					'order_id' => $id,
					'product_id' => $this->input->post('product')[$x],
					'qty' => $this->input->post('qty')[$x],
					'rate' => $this->input->post('rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
				);
				$this->db->insert('orders_item', $items);

				// now decrease the stock from the product
				$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
				$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

				$update_product = array('qty' => $qty);
				$this->model_products->update($update_product, $this->input->post('product')[$x]);
			}

			return true;
		}
	}



	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('orders_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM `orders` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
	public function countTotalOrders()
	{
		$sql = "SELECT SUM(net_amount) as total FROM `orders` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));

		if ($query->num_rows() > 0) {
			$row = $query->row(); // Fetch the single row from the result set
			return $row->total; // Access the 'total' column
		} else {
			return 0; // Return 0 or any other default value if no rows were found
		}
	}
	public function orderUnPaid()
	{
		$sql = "SELECT COUNT(id) as nb FROM `orders` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(2));
		$row = $query->row(); 
		return $row->nb;
	}

	public function totlaUnPaid()
	{
		$sql = "SELECT SUM(net_amount) as total FROM `orders` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(2));

		if ($query->num_rows() > 0) {
			$row = $query->row(); // Fetch the single row from the result set
			return $row->total; // Access the 'total' column
		} else {
			return 0; // Return 0 or any other default value if no rows were found
		}
	}

	public function mountMonth()
	{
		$sql = "SELECT MONTH(FROM_UNIXTIME(date_time)) AS month, SUM(net_amount) AS total FROM `orders` WHERE paid_status = ? AND YEAR(FROM_UNIXTIME(date_time)) = YEAR(CURDATE()) GROUP BY month ORDER BY month";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function topCustomer()
	{
		$sql = "SELECT c.firstname,c.lastname, SUM(o.net_amount) AS total FROM orders o JOIN clients c ON o.customer_id = c.id WHERE MONTH(FROM_UNIXTIME(o.date_time)) = MONTH(CURRENT_DATE()) AND YEAR(FROM_UNIXTIME(o.date_time)) = YEAR(CURRENT_DATE()) and o.paid_status = 1 GROUP BY o.customer_id ORDER BY total DESC LIMIT 5;";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

}