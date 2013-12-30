<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/18/13
 * Time: 9:28 AM
 * To change this template use File | Settings | File Templates.
 */

class Transfer_model extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function get(){
        $sql = "SELECT  count(*) as number_of_items,
                    f.name as from_showroom, 
                    t.name as to_showroom, 
                    transfer.id as transfer_id, 
                    transfer.created_at as transfer_time
                    FROM `transfer`
                    join transferred_item on transfer.id = transferred_item.transfer_id
                    join showroom as f on f.id = transfer.from_showroom_id
                    join showroom as t on t.id = transfer.to_showroom_id
                    group by transfer.id order by transfer.id desc";
        $query = $this->db->query($sql);
        return $query->result();
    }


    public function get_items_by_transfer_id($transfer_id) {
        $sql = "SELECT item.id as item_id, item_type.name as item_type, size.name as size, item.sell_price as item_price, item.designer_style, supplier.name as supplier_name , 
                purchase.id as purchase_id
                FROM `transfer` 
                join transferred_item on transferred_item.transfer_id = transfer.id
                join item on transferred_item.item_id = item.id
                join size on item.size_id = size.id
                join supplier on item.supplier_id = supplier.id
                join item_type on size.item_type_id = item_type.id
                join purchase on  purchase.id = item.purchase_id
                WHERE transfer.id = ".$transfer_id;
        $query  = $this->db->query($sql);
        return $query->result();
    }




    //it is used only for transfer items from Headoffice to showrooms.
    public function add($json_data){
        $this->db->trans_start();

        $transfer = json_decode($json_data);
        $showroom_id = $transfer->showroom_id;
        $items = $transfer->items;
        $date = new DateTime();

        //first open a transfer.
        //from_showroom_id is 1 because we know its only used for Headoffice.
        $this->db->insert('transfer' , array('from_showroom_id' => 1, 'to_showroom_id' => $showroom_id , 'created_at' => $date->format('Y-m-d H:i:s') ));
        $transfer_id = $this->db->insert_id();

        $data = array();
        $item_updates = array();

        
        $values = '';
        $i=0;
        foreach($items as $item_id){
            if($item_id != null){
                $data[] = array('transfer_id' => $transfer_id , 'item_id' => $item_id);
                $values = $values." (".$item_id.",".$showroom_id.") ";
                if($i < count($items)-1){
                    $values = $values . ","; //append comma only after the prior rows to the LAST one.
                }
            }
            $i++;
        }

        $updates = "INSERT INTO item( id, showroom_id ) VALUES".$values." ON DUPLICATE KEY UPDATE showroom_id = VALUES(showroom_id)";

        //insert transferitems.
        $this->db->insert_batch('transferred_item' , $data);
        //then update each item's current location(showroom_id)
        $this->db->query($updates);

        //doneP
        $this->db->trans_complete();
    }


    public function get_report_data($transfer_id) {
        $sql = "SELECT item_type.name as item_type, size.name as size, item.color_code as color, item.designer_style , count(item.id)as quantity,  item.sell_price as item_price,  sum(item.sell_price) as amount , from_showroom.name as source, to_showroom.name as destination
                FROM `transfer`
                join transferred_item on transferred_item.transfer_id = transfer.id
                join item on transferred_item.item_id = item.id
                join size on size.id = item.size_id

                join showroom as from_showroom on from_showroom.id = transfer.from_showroom_id
                join showroom as to_showroom on to_showroom.id = transfer.to_showroom_id


                join item_type on item_type.id = size.item_type_id
                where transfer.id = $transfer_id
                group by item.color_code, item.size_id";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}