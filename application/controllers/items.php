<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/13/13
 * Time: 12:03 PM
 * To change this template use File | Settings | File Templates.
 */

class Items extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('item_model');
        logged_in();
    }

    public function index(){
        $data['vars']['items'] = $this->item_model->get_items();
        $data['main_content'] = 'items/show';
        $data['active'] = 'item';
        $this->load->view('template' , $data);
    }

    public function purchase($id){
        $data['vars']['purchase_id'] = $id;
        $data['vars']['items'] = $this->item_model->get_items('*' , array('purchases_id' => $id));
        $data['main_content'] = 'items/show';
        $data['active'] = 'item';
        $this->load->view('template' , $data);
    }

    public function show(){
        if(!$this->input->post()){
            return;
        }
        $data['active'] = 'item';
        $designer_style = $this->input->post('designer_style');
        $data['vars']['items'] = $this->item_model->get_items('items.*' , array('designer_style' => $designer_style),array('purchases') );
        $this->session->set_flashdata('message' , "showing items with designer style : $designer_style");
        $data['main_content'] = 'items/show';
        $this->load->view('template' , $data);
    }

    /**
     * Takes barcode and retursn the item. it serves json requests.
     * @param $barcode the combination of YEAR_MONTH_ID .
     *
     */
    public function get_items_json($barcode , $showroom_id = 1){
        $item_object = $this->item_model->get_item_json($barcode , $showroom_id);
        echo json_encode($item_object);
    }

    /**
    * Gets the items in json format assosiated with the purchase id. (Only available in Headoffice.)
    */
    public function get_items_by_purchase_id($purchase_id){
        echo json_encode($this->item_model->get_items_by_purchase_id($purchase_id));
    }

}