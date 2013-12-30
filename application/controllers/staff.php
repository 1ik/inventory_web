<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {

	public function __construct(){
		parent::__construct();
		logged_in();
		$this->load->model('staff_model');

	}

	public function load_view(&$data){
		$data['active'] = 'staff';
		$data['links'][] = anchor('salary' , 'Staff salaries');
		$this->load->view('template', $data);

	}

	public function index(){
		if($this->input->post()){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Staff', 'required|is_unique[group.name]');
            $this->form_validation->set_rules('email' , 'Email of Staff', 'required|is_unique[staff.email]');
            $this->form_validation->set_rules('phone' , 'Phone of Staff', 'required|is_unique[staff.phone]');
            $this->form_validation->set_rules('address' , 'Staff address', 'required');
            if($this->form_validation->run() === FALSE){
                
            }else{
                $this->staff_model->create();
                $this->session->set_flashdata('message' , "Staff has successfully been created");
                redirect('staff');
            }
		}
		$this->load->model('showroom_model');

		$data['vars']['staffs'] = $this->staff_model->get();
		$data['vars']['showrooms'] = $this->showroom_model->get();
		$data['page_name'] = "Staffs";
		$data['main_content'] = 'staff/show';
		$this->load_view($data);
	}



	public function edit($id){

		if($this->input->post()){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Staff', 'required|is_unique[group.name]');
            $this->form_validation->set_rules('email' , 'Email of Staff', 'required');
            $this->form_validation->set_rules('phone' , 'Phone of Staff', 'required');
            $this->form_validation->set_rules('address' , 'Staff address', 'required');
            if($this->form_validation->run() === FALSE){
                
            }else{
                $this->staff_model->update($id);
                $this->session->set_flashdata('message' , "Staff information has successfully been updated");
                redirect('staff');
            }
		}

		$this->load->model('showroom_model');
		$staffs = $this->staff_model->get('staff.*' , array('staff.id' => $id));
		$data['vars']['staff'] = $staffs[0];
		$data['vars']['showrooms'] = $this->showroom_model->get();
		$data['page_name'] = "Staffs";
		$data['main_content'] = 'staff/edit';
		$this->load_view($data);
	}

	public function delete($id){
		if($this->staff_model->delete($id)){
			$this->session->set_flashdata('message', 'Staff has been deleted');
		}else{
			$this->session->set_flashdata('message', 'staff contains information, coludnt be deleted');
		}
		redirect('staff');
	}
}

/* End of file staff.php */
/* Location: ./application/controllers/staff.php */