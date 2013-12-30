<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Group extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('group_model');
        logged_in();
    }

    function load_view(&$data){
        $data['active'] = 'group';
        $this->load->view('template' , $data);
    }


    public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Group', 'required|is_unique[group.name]');
            if($this->form_validation->run() === FALSE){
                //nothing just let the page load.
            }else{
                $this->group_model->create();
                $this->session->set_flashdata('message' , "Group has successfully been created");
                redirect('group');
            }
        }
        $data['vars']['groups'] = $this->group_model->get_groups();
        $data['page_name'] = "Group";
        $data['main_content'] = 'group/show';
        $this->load_view($data);
    }



    public function update($id){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Group', 'required|is_unique[group.name]');
            if($this->form_validation->run() === FALSE){

            }else{
                $this->group_model->update($id);
                $this->session->set_flashdata('message' , 'group has successfully been edited');
                redirect('group');
            }

        }
        $data['page_name'] = 'Update Group';
        $groups = $this->group_model->get_groups($id);
        $data['vars']['group'] = $groups[0];
        $data['main_content'] = 'group/edit';
        $this->load_view($data);
    }

    public function delete($id){
        if($this->group_model->delete($id)){
            $this->session->set_flashdata('message' , 'group deleted');
        }else{
            $this->session->set_flashdata('message' , "can't delte gorup, it contains data");
        }
        redirect('group');
    }



}