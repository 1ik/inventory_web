<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 6:13 PM
 * To change this template use File | Settings | File Templates.
 */

class Purchase extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('purchase_model');
        logged_in();
    }

    private function load_view(&$data = array()){


        $data['links'][] = anchor('purchase/create', 'CREATE');
        $data['page_name'] = 'Purchase';
        $data['active'] = 'purchase';
        $this->load->view('template' , $data);

    }

    public function index(){
        if($this->input->post()){
            $data['vars']['purchases'] = $this->purchase_model->get_all_purchases($this->input->post('from_date') , $this->input->post('to_date'));
        }else{
            $data['vars']['purchases'] = $this->purchase_model->get_all_purchases();
        }

        $this->load->model('supplier_model');
        $data['main_content'] = 'purchase/show';
        $this->load_view($data);
    }

    public function create_submit_json(){

        $purchase = $this->input->get('val');
        $this->load->model('purchase_model');
        $this->purchase_model->create($purchase);
        echo 'ok';

    }




    public function create(){
        if($this->input->post()){

        }
        $this->load->model('supplier_model');
        $data['vars']['suppliers'] = $this->supplier_model->get_suppliers();
        $this->load->model('group_model');
        $data['vars']['groups'] = $this->group_model->get_groups();

        //$this->load->model("color_model");

        //$data['vars']['colors'] = $this->color_model->get();

        $data['main_content'] = 'purchase/create';
        $this->load_view($data);

    }

    public function detail($purchase_id){
        $data['vars']['purchase_details'] = $this->purchase_model->get_purchase_detail($purchase_id);
        $data['main_content'] = 'purchase/detail';
        $this->load_view($data);
    }


    public function print_barcode($purchase_id = ''){
        if($purchase_id == '') {
            die();
        }

        $this->load->model("item_model");
        $data['items'] = $this->item_model->get_barcodes($purchase_id);
        $this->load->view('purchase/barcode_view' , $data);
    }


    public function get_color_code($designer_style){
            $sql = "select color_code from item where designer_style = '".$designer_style."' limit 1";
            //echo $sql;
            $query = $this->db->query($sql);
            if($query->num_rows() > 0) {
                $result = $query->result();
                echo $result[0]->color_code;
            }
    }
}