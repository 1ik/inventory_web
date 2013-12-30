<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/18/13
 * Time: 9:25 AM
 * To change this template use File | Settings | File Templates.
 */

class Transfer extends CI_Controller {
    function __construct(){
        parent::__construct();
        logged_in();
        $this->load->model('transfer_model');
    }

    function load_view(&$data){
        $data['links'][] = anchor('transfer' , 'view all');
        $data['links'][] = anchor('transfer/create' , 'Transfer to Showroom');
        $data['links'][] = anchor('transfer/return_to_headoffice' , 'Return To HeadOffice');
        $data['active'] = 'transfer';
        $this->load->view('template' , $data);
    }

    public function index(){
        $data['main_content'] = 'transfer/show';
        $data['page_name'] = 'All Transfers';

        //show all the transfers.
        $data['vars']['transfers'] = $this->transfer_model->get();


        $this->load->model('showroom_model');
        $this->load_view($data);
    }

    public function create(){
        $this->load->model('showroom_model');
        $data['vars']['showrooms'] = $this->showroom_model->get();
        $data['main_content'] = 'transfer/create';
        $data['page_name'] = 'create new transfer';
        $this->load_view($data);
    }

    //receives json data via get request. from transfer/create.php file.
    public function create_submit_json(){
        $json_data = $this->input->post('val');
        $this->transfer_model->add($json_data);
        echo 'ok';
    }


    public function return_to_headoffice(){
        $this->load->model('showroom_model');
        $data['vars']['showrooms'] = $this->showroom_model->get();
        $data['main_content'] = 'transfer/create_return';
        $data['page_name'] = 'create new transfer';
        $this->load_view($data);
    }



    public function detail($transfer_id = '') {
        if($transfer_id == ''){
            die();
        }

        $data['vars']['items'] = $this->transfer_model->get_items_by_transfer_id($transfer_id);


        $data['main_content'] = 'transfer/detail';
        $data['page_name'] = 'Transfer detail';
        $this->load_view($data);        
        
    }


    //shows a rport of that transferid.
    public function report($transfer_id) {
        $data['items'] = $this->transfer_model->get_report_data($transfer_id);
        $this->load->view("transfer/report",$data);        
    }
}