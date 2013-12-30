<?php

class Color extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("color_model");
	}

	function load_view(&$data){
        $data['active'] = 'color';
        $this->load->view('template' , $data);
    }


	public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('color_code' , 'Color code', 'required|is_unique[color.color_code]');
            $this->form_validation->set_rules('description' , 'Color Description', 'required');
            if($this->form_validation->run() === FALSE){
            }else{
                $this->color_model->create();
                $this->session->set_flashdata('message' , "Color has successfully been added");
                redirect('color');
            }
        }

        $this->load->model('color_model');
        $data['page_name'] = "colors";
        $data['vars']['colors'] = $this->color_model->get();
        $data['main_content'] = 'color/show';
        $this->load_view($data);
    }


    public function update($id){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('color_code' , 'Color code', 'required');
            $this->form_validation->set_rules('description' , 'Color Description', 'required');
            if($this->form_validation->run() === FALSE){

            }else{
                $this->color_model->update($id);
                $this->session->set_flashdata('message' , 'color has successfully been edited');
                redirect('color');
            }
        }

        $data['page_name'] = 'Update Color';
        $colors = $this->color_model->get($id);
        $data['vars']['color'] = $colors[0];
        $data['main_content'] = 'color/edit';
        $this->load_view($data);
    }


    public function delete($id) {
    	//do we have any item that has this color?
    	$this->load->model("item_model");
    	$items = $this->item_model->get_items('id' , array('color_id' => $id) , 1 );
    	if(count($items > 0)) {
    		//we have an item.
    		$this->session->set_flashdata('message' , "Color could not be deleted. There are already Items that has this color");
    	}else {
    		//no items with this color.
    		$this->color_model->delete($id);
    	}
    }

}