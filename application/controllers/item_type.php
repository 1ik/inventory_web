<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:08 PM
 * To change this template use File | Settings | File Templates.
 */

class Item_type extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('item_type_model');
        logged_in();
    }

    public function load_view(&$data){
        $page['active'] = 'item_type';
        $this->load->view('template' , $data);
    }

    public function index(){

        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Item type name ', 'required|callback_unique_item_type|xss_clean');
            if($this->form_validation->run() === FALSE){

            }else{
                
                // var_dump($this->input->post()); die();
                $this->item_type_model->create();
                $this->session->set_flashdata('message' , 'item type created');
                redirect('item_type');
            }
        }
        $data['page_name'] = 'Item type';
        $data['main_content'] = 'item_type/show';
        $data['active'] = 'item_type';
        $this->load->model('item_type_model');
        $data['vars']['item_types'] = $this->item_type_model->get(array('group.name as group_name, sub_group.name as sub_group_name , item_type.*') , array() , array('group' , 'sub_group'));
        $this->load->model('group_model');
        $data['vars']['groups'] = $this->group_model->get_groups();
        $this->load->view('template' , $data);
    }


    public function unique_item_type($str)
    {
        $group_id = $this->input->post("group");
        $sub_group_id = $this->input->post("sub_group");
        $item_type_name = $str;
        $query = $this->db->query("select * from item_type where sub_group_id=".$sub_group_id." and name = '".$str."'");
        if ($query->num_rows() > 0)
        {
            $this->form_validation->set_message('unique_item_type', 'The %s  already exists in this sub group ');
            return FALSE;
        }
        return TRUE;
    }


    public function get_item_type_json($sub_group_id){
        echo json_encode($this->item_type_model->get('*' , array('sub_group_id' => $sub_group_id)));
    }

    public function delete($id){
        if($this->item_type_model->delete($id)){
            $this->session->set_flashdata('message' , 'deleted successfully');
        }else{
            $this->session->set_flashdata('message' , 'delete failed');
        }
        redirect('item_type');
    }

}