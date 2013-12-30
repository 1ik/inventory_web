<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:17 AM
 * To change this template use File | Settings | File Templates.
 */

class Expense extends CI_Controller{
    function __construct(){
        parent::__construct();
        logged_in();
        $this->load->model('expense_model');
        $this->load->model('expense_type_model');
        $this->load->model('showroom_model');
    }

    public function load_view(&$data){
        $data['links'][] = anchor('expense/create' , 'create expense');
        $data['links'][] = anchor('expense_type' , "expense Types");
        $data['active'] = 'expense';
        $this->load->view('template' , $data);
    }


    public function index(){
        $data['page_name'] = 'Expenses';
        $data['vars']['expenses'] = $this->expense_model->get_all_expense();
        $data['main_content'] = 'expense/show';
        $this->load_view($data);


    }


    public function create(){
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('amount' , 'amount', 'required|numeric');
            if($this->form_validation->run() === FALSE){


            }else{
                $this->expense_model->create();
                $this->session->set_flashdata('new expense added');
                redirect('expense');
            }
        }

        $data['vars']['expense_types'] = $this->expense_type_model->get();
        $data['vars']['showrooms'] = $this->showroom_model->get();
        
        $data['page_name'] = 'Add a new Expense';
        $data['main_content'] = 'expense/create';
        $this->load_view($data);
    }

    /**
    *This function receives json requst and stores the value in database.
    * json requewst contains, store id, and array of expense infromation.
    */
    public function expense_create_json(){

    }



}