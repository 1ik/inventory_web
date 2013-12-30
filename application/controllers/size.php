<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:21 AM
 * To change this template use File | Settings | File Templates.
 */

class Size extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('size_model');
        logged_in();
    }

    public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Size Name', 'required|callback_unique_size');
            if($this->form_validation->run() === FALSE){
            }else{
                $this->size_model->create();
                $this->session->set_flashdata('message' , "Size has successfully been added");
                redirect('size');
            }
        }

        $this->load->model('group_model');
        $data['vars']['groups'] = $this->group_model->get_groups();
        $data['active'] = 'size';
        $data['page_name'] = "sizes";
        $data['main_content'] = 'size/show';
        $this->load->view('template' , $data);
    }


    public function get_sizes_json($item_type_id){
        echo json_encode($this->size_model->get('*' , array('item_type_id' => $item_type_id)));
    }

    public function unique_size($str)
    {
        $item_type_id = $this->input->post("item_type_id");

        if (count($this->size_model->get('*' , array('item_type_id'=>$item_type_id, 'name' => $str) )) > 0)
        {
            $this->form_validation->set_message('unique_size', 'The '.$str.' size name already exists in this item type ');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function delete($id){

        $this->size_model->delete($id);
        
        $this->session->set_flashdata( 'message' , 'size has been removed');
        redirect('size');
    }

}