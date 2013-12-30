<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:40 AM
 * To change this template use File | Settings | File Templates.
 */

class Subgroup extends CI_Controller {
    function __construct(){
        parent::__construct();
        logged_in();
        $this->load->model('subgroup_model');
    }

    public function load_view(&$data){
        $data['active'] = 'sub_group';
        $this->load->view('template' , $data);
    }


    public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of SubGroup', 'required|callback_unique_subgroup');
            if($this->form_validation->run() === FALSE){
            }else{
                $this->subgroup_model->create();
                $this->session->set_flashdata('message' , "Subgroup has successfully been added");
                redirect('subgroup');
            }
        }

        $this->load->model('group_model');
        $data['vars']['groups'] = $this->group_model->get_groups();
        $data['page_name'] = "SubGroups";
        $data['main_content'] = 'sub_group/show';
        $this->load->view('template' , $data);
    }



    public function get_sub_groups_json($group_id){
        $subgroups = $this->subgroup_model->get_subgroups(array('group_id' => $group_id));
        echo json_encode($subgroups);
    }


    public function unique_subgroup($str)
    {
        $group_id = $this->input->post("group");
        $subgroup_name = $str;
        if (count($this->subgroup_model->get_subgroups(array('group_id'=>$group_id, 'name' => $subgroup_name))) > 0)
        {
            $this->form_validation->set_message('unique_subgroup', 'The %s sub group name already exists in this group ');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function delete($id){
        if($this->subgroup_model->delete($id)){

            $this->session->set_flashdata('message', 'Subgroup has successfully been deleted');
        }else{
            $this->session->set_flashdata('message', "The subgroup cannot be delted , there are other data assosiated with it.");
        }

        redirect('subgroup');
    }
}