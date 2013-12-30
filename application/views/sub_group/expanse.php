<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:17 AM
 * To change this template use File | Settings | File Templates.
 */

class Expanse extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('expanse_model');
        $this->load->model('expanse_type_model');
        $this->load->model('outlet_model');
    }

    public function index(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('amount' , 'amount', 'required|numeric');
            if($this->form_validation->run() === FALSE){


            }else{
                $this->expanse_model->create();
                $this->session->set_flashdata('new expanse added');
                redirect('expanse');
            }
        }

        $data['links'][] = anchor('expanse_type' , "Expanse Types");
        $data['vars']['expanse_types'] = $this->expanse_type_model->get_expanse_types();
        $data['vars']['showrooms'] = $this->outlet_model->get_outlets();
        $data['active'] = 'expanse';
        $data['page_name'] = 'Expanses';
        $data['main_content'] = 'expanses/show';
        $this->load->view('template' ,  $data);
    }



}