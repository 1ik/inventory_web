<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/13/13
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 */

class Item_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }


    public function get_items($select = '*' , $where = array() , $join = array() , $limit = '') {

        $this->db->where($where);
        $this->db->select($select);
        $this->db->from('items');
        if(in_array('outlet', $join)){
            $this->db->join('outlet', 'outlet.id = items.outlet_id');
        }
        if(in_array('purchases' , $join)){
            $this->db->join('purchases', 'purchases.id = items.purchases_id');
        }
        $query = $this->db->get();

        if($limit != '') {
            $this->db->limit($limit);
        }


        return $query->result();
    }


    /**
    * retuns items that has the following barcode where item's current locatoin is 
    */


    public function get_item_json($barcode , $showroom_id = 1){

        $item_id = intval($barcode);

        $query = "SELECT item.id as id, item_type.name as item_type, size.name as size, showroom.name as current_location ,  item.purchase_id , item.sell_price, item.designer_style, supplier.name as supplier, CONCAT( DATE_FORMAT( item.created_at , '%Y%m' ) , item.id ) as barcode FROM `item` join size on size.id = item.size_id join item_type on item_type.id = size.item_type_id join supplier on item.supplier_id = supplier.id join showroom on showroom.id = item.showroom_id where item.id = ".$item_id." AND item.showroom_id = ".$showroom_id;

        $query = $this->db->query($query);

        if($query->num_rows()>0){
            $res = $query->result();
            return $res[0];
        }else{
            return null;
        }
    }


    public function get_items_by_purchase_id($purchase_id){

        $query = "SELECT item.id as id, item_type.name as item_type, size.name as size, showroom.name as current_location ,  item.purchase_id , item.sell_price, item.designer_style, supplier.name as supplier, CONCAT( DATE_FORMAT( item.created_at , '%Y%m' ) , item.id ) as barcode FROM `item` join size on size.id = item.size_id join item_type on item_type.id = size.item_type_id join supplier on item.supplier_id = supplier.id join showroom on showroom.id = item.showroom_id where item.showroom_id = 1 AND purchase_id = ".$purchase_id;
        $queryObj = $this->db->query($query);

        if($queryObj->num_rows() > 0){
            return $queryObj->result();
        }else{
            return null;
        }
    }

    public function get_barcodes($purchase_id){



        $sql = "select item.*, size.name as size_name , item_type.name as item_name from item 
                    join size on size.id =  item.size_id
                    join item_type on item_type.id = size.item_type_id
                    where purchase_id = ".$purchase_id;
        $query = $this->db->query($sql);
        return $query->result();
    }




}
