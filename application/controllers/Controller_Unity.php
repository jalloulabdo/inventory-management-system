<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Unity extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'unity';

		$this->load->model('model_unity');
	}

	/* 
	* It only redirects to the manage unity page
	*/
	public function index()
	{

		if(!in_array('viewUnity', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('unity/index', $this->data);	
	}	

	/*
	* It checks if it gets the unity id and retreives
	* the unity information from the unity model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchUnityDataById($id) 
	{
		if($id) {
			$data = $this->model_unity->getUnityData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Fetches the unity value from the unity table 
	* this function is called from the datatable ajax function
	*/
	public function fetchUnityData()
	{
		$result = array('data' => array());

		$data = $this->model_unity->getUnityData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			if(in_array('updateUnity', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteUnity', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
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
	* Its checks the unity form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{
		if(!in_array('createUnity', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('unity_name', 'Unity name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('unity_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_unity->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	/*
	* Its checks the unity form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{

		if(!in_array('updateUnity', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_unity_name', 'Unity name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_unity_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_unity->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the unity information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteUnity', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$unity_id = $this->input->post('unity_id');

		$response = array();
		if($unity_id) {
			$delete = $this->model_unity->remove($unity_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}