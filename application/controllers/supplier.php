<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/10/13
 * Time: 11:28 PM
 * To change this template use File | Settings | File Templates.
 */

class Supplier extends CI_Controller {
    function __construct(){
        parent::__construct();
        logged_in();
        $this->load->model('supplier_model');
    }

    public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('supplier_name' , 'Name of Supplier', 'required');
            $this->form_validation->set_rules('supplier_email' , 'Supplier email address', 'required|valid_email');
            $this->form_validation->set_rules('supplier_phone' , 'Supplier Phone number', 'required');
            $this->form_validation->set_rules('supplier_address' , 'Suppliers address', 'required');
            $data['main_content'] = 'supplier/show';
            if($this->form_validation->run() === FALSE){

            } else {
                $this->supplier_model->add_supplier();
                $this->session->set_flashdata('message' , 'supplier has been added successfully');
                redirect('supplier');
            }
        }

        $data['page_name'] = 'Supplier';
        $data['main_content'] = 'supplier/show';
        $data['active'] = 'supplier';
        $data['vars']['suppliers'] = $this->supplier_model->get_suppliers();
        $this->load->view('template' , $data);
    }



    public function edit($id){
        
        if($this->input->post()){
            $this->supplier_model->update_supplier($id);
            $this->session->set_flashdata('message' , 'supplier updated');
            redirect('supplier');
        }

        $suppliers = $this->supplier_model->get_suppliers($id);
        $data['vars']['supplier'] = $suppliers[0];
        $data['page_name'] = 'edit supplier';
        $data['main_content'] = 'supplier/edit';
        $this->load->view('template' ,  $data);
    }


    
    public function delete($id){
        if($this->supplier_model->delete($id)){
            $this->session->set_flashdata('message' , 'Supplier has successfully been remoted');
        }else{
            $this->session->set_flashdata('message' , "Can't remove Supplier, You have existing data with this supplier , <h3> Supplier can only be removed , only if you don't have any data with supplier</h3>");
        }
        redirect('supplier');
    }
}