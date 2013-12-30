<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/13/13
 * Time: 11:19 AM
 * To change this template use File | Settings | File Templates.
 */

class Test extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('item_model');
    }

    public function test_time(){
        $date = new DateTime();
        echo $date->format('Y-m-d H:i:s');
    }

    public function test_item_get(){
        var_dump($this->item_model->get_items('*', array('purchases_id' => 1) , array('outlet' , 'purchases')));
    }

    public function get_expanse_type(){
        $this->load->model('expanse_type_model');
        var_dump($this->expanse_type_model->get_expanse_types());
    }

    public function staff_get(){
        $this->load->model('staff_model');
        var_dump($this->staff_model->get());
    }

    public function update_batch_test(){
        $items [] = array('item' , array('showroom_ud' => 2) , array('id' => 1));
        $items [] = array('item' , array('showroom_ud' => 2) , array('id' => 4));
        $items [] = array('item' , array('showroom_ud' => 2) , array('id' => 5));
        $items [] = array('item' , array('showroom_ud' => 2) , array('id' => 7));

    }


    public function json(){
        $data = array(
            array('transfer_id' => '3322' , 
                'items' => array(
                    array('item_id' => 3, 'price' => 333 , 'size' => 'xl'),
                    array('item_id' => 4, 'price' => 421 , 'size' => 'xxl'),
                    array('item_id' => 6, 'price' => 346 , 'size' => 'xdl'),
                    array('item_id' => 77, 'price' => 633 , 'size' => 'xal'),
                )
            ),
            array('transfer_id' => '221' , 
                'items' => array(
                    array('item_id' => 4, 'price' => 123 , 'size' => 'x1l'),
                    array('item_id' => 6, 'price' => 421 , 'size' => '31'),
                    array('item_id' => 84, 'price' => 167 , 'size' => 'xl'),
                    array('item_id' => 77, 'price' => 35 , 'size' => 'xl'),
                )
            )
        );
        echo json_encode($data);
    }

    public function get_purchase_test(){
        $i = 1000000;
        $data =  '{"transfer_ids":[{"transfer_id":"3","total_items":"3"}],"items":[';

        for($i = 0 ; $i < 30000 ; $i++){
            $data .= '{"transfer_id":"3","item_id":"50","size":"bax","type":"red pant","sell_price":"320","barcode":"20131050"},';
        }
        $data .= ']';
         echo strlen($data);
        echo br(3);
        echo $data;

    }


    public function loadtest(){

        $items = array();
            for($i =0; $i<10000; $i++){
                $items[] = array('item_id' => $i , 'type' => 'sometype' , 'size' => 'xxl' , 'sell_price' => 334, 
                'barcode' => '201310'.$i , 'transfer_id' => '55');
            }
        echo json_encode($items);

    }

}