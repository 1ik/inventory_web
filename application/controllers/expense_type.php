<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:15 AM
 * To change this template use File | Settings | File Templates.
 */

class Expense_type extends CI_Controller{

    function __construct(){
        parent::__construct();
        logged_in();
        $this->load->model('expense_type_model');
    }

    public function load_view(&$data){
        $data['active'] = 'expense';
        $this->load->view('template' , $data);
    }


    public function index(){
        if($this->input->post()){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('reason' , 'Reason name', 'required|is_unique[expense_type.reason]');
            if($this->form_validation->run() === FALSE){
                $data['vars']['input'] = $this->input->post();
            }else{
                $this->expense_type_model->create();
                $this->session->set_flashdata('message' , 'expense type created successfully');
                redirect('expense_type');
            }
        }
        //get all expense list.
        $data['page_name'] = 'expense Type';
        $data['vars']['expense_types'] = $this->expense_type_model->get();
        $data['action'] = 'expense_type';
        $data['main_content'] = 'expense_type/show';
        $this->load_view($data);
    }


    public function edit($id){
        if($this->input->post()){
            $this->expense_type_model->update($id);
            $this->session->set_flashdata('message' , "expense type $id has been edited");
            redirect('expense_type');
        }
        $expense_types = $this->expense_type_model->get('*' , array('id' => $id));
        $data['vars']['expense_type'] = $expense_types[0];
        $data['page_name'] = 'Edit expense type';
        $data['main_content'] = 'expense_type/edit';
        $this->load_view( $data);
    }

    public function delete($id){
        if($this->expense_type_model->delete($id)){
            $this->session->set_flashdata('message' , 'expense type has been successfully deleted');
        }else{
            $this->session->set_flashdata('message' , 'expense type Deletion failed');
        }
        redirect('expense_type');
    }
}
