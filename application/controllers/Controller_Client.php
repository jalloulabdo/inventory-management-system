<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Controller_Client extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Client';

		$this->load->model('model_clients');
	}

	/* 
	 * It only redirects to the manage category page
	 */
	public function index()
	{

		if (!in_array('viewClient', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$client_data = $this->model_clients->getClientDataAll();
		$this->data['client_data'] = $client_data;

		$this->render_template('clients/index', $this->data);
	}

	/*
	 * It checks if it gets the client id and retreives
	 * the client information from the client model and 
	 * returns the data into json format. 
	 * This function is invoked from the view page.
	 */
	public function fetchClientDataById($id)
	{
		if ($id) {
			$data = $this->model_clients->getClientData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	 * Fetches the client value from the client table 
	 * this function is called from the datatable ajax function
	 */
	public function fetchCclientData()
	{
		$result = array('data' => array());

		$data = $this->model_clients->getClientData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if (in_array('updateClient', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if (in_array('deleteClient', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}


			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	 * Its checks the client form validation 
	 * and if the validation is successfully then it inserts the data into the database 
	 * and returns the json format operation messages
	 */
	public function create()
	{
		if (!in_array('createClient', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
		$this->form_validation->set_rules('address', 'address', 'trim');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required');
		$this->form_validation->set_rules('city', 'city', 'trim');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');

		if ($this->form_validation->run() == TRUE) {
			// true case
			$data = array(
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'city' => $this->input->post('city'),
				'phone' => $this->input->post('phone'),
			);

			$create = $this->model_clients->create($data, $this->input->post('groups'));
			if ($create == true) {
				$this->session->set_flashdata('success', 'Successfully created');
				redirect('Controller_Client/', 'refresh');
			} else {
				$this->session->set_flashdata('errors', 'Error occurred!!');
				redirect('Controller_Client/create', 'refresh');
			}
		} else {
			// false case
			$group_data = $this->model_groups->getGroupData();
			$this->data['group_data'] = $group_data;

			$this->render_template('clients/create', $this->data);
		}


	}
	/*
	 * Its checks the client form validation 
	 * and if the validation is successfully then it updates the data into the database 
	 * and returns the json format operation messages
	 */
	public function edit($id = null)
	{
		if (!in_array('updateClient', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if ($id) {
			$this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
			$this->form_validation->set_rules('address', 'address', 'trim');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required');
			$this->form_validation->set_rules('city', 'city', 'trim');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				// true case
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'phone' => $this->input->post('phone'),
				);

				$update = $this->model_clients->edit($data, $id);
				if ($update == true) {
					$this->session->set_flashdata('success', 'Successfully created');
					redirect('Controller_Client/', 'refresh');
				} else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('Controller_Client/edit/' . $id, 'refresh');
				}
			} else {
				// false case
				$client_data = $this->model_clients->getClientData($id);

				$this->data['client_data'] = $client_data;

				$this->render_template('clients/edit', $this->data);
			}
		}
	}

	/*
	 * It removes the cleint information from the database 
	 * and returns the json format operation messages
	 */
	public function delete($id)
	{
		if (!in_array('deleteClient', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if($id) {
			if($this->input->post('confirm')) {
					$delete = $this->model_clients->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('Controller_Client/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('Controller_Client/delete/'.$id, 'refresh');
		        	}

			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('clients/delete', $this->data);
			}	
		}
	}

}