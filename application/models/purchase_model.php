<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 7:24 PM
 * To change this template use File | Settings | File Templates.
 */

class Purchase_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function create($json_data){
        $this->db->trans_start();

        $purchase = json_decode($json_data);
        $date = new DateTime();

        $this->db->insert('purchase' , array('id' => 'NULL' , 'created_at' => $date->format('Y-m-d H:i:s') ));
        $purchase_id = $this->db->insert_id();

        //then get the elements.
        $entries = $purchase->entries;
        $data = array();
        foreach($entries as $entry){
            if($entry != null){
                $quantity = $entry->quantity;
                for($i=0; $i<$quantity; $i++){
                    $data[] = array(
                        'purchase_id' => $purchase_id,
                        'size_id' => $entry->size_id,
                        'supplier_id' => $entry->supplier_id,
                        'cost_price' => $entry->cost_price,
                        'sell_price' => $entry->sell_price,
                        'designer_style' => $entry->designer_style,
                        'created_at' => $date->format('Y-m-d H:i:s'),
                        'showroom_id' => 1, //<- all item's initial position is headoffice.
                        'color_code' => $entry->color_code,
                    );
                }
            }
        }

        $this->db->insert_batch('item' , $data);
        $this->db->trans_complete();
        
    }

    public function get_purchase($where = array()){
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get('purchases');
        return $query->result();
    }


    public function get_all_purchases($date_from = '' , $date_to = ''){
        $date = new DateTime();

        if($date_from == '' && $date_to == ''){
            $sql = "SELECT purchase.id as purchase_id, DATE_FORMAT(purchase.created_at,'%Y-%m-%d') AS purchase_date, count( * ) AS number_of_items FROM purchase LEFT JOIN item ON purchase.id = item.purchase_id GROUP BY purchase.id order by purchase.id desc";

            $query = $this->db->query($sql);
            return $query->result();
        }

        if($date_from ==''){
            $date_from = $date->format('m/d/Y');
        }
        if($date_to == ''){
            $date_to = $date->format('m/d/Y');
        }

        $sql = "SELECT purchase.id as purchase_id, DATE_FORMAT(purchase.created_at,'%Y-%m-%d') AS purchase_date, count( * ) AS number_of_items FROM purchase LEFT JOIN item ON purchase.id = item.purchase_id where DATE_FORMAT(purchase.created_at,'%m/%d/%Y') between '".$date_from."' and '".$date_to."' GROUP BY purchase.id order by purchase.id desc";

        $query = $this->db->query($sql);
        return $query->result();
    }



    public function get_purchase_detail($purchase_id){
        $sql = "select item_type.name as type, size.name as size_name, supplier.name as supplier_name, count(*) as quantity,
                    item.designer_style,
                    item.sell_price,
                    item.cost_price,
                    item.color_code,
                    purchase.created_at
                    from item 
                    left join size on size.id = item.size_id
                    left join purchase on purchase.id = item.purchase_id
                    left join item_type on size.item_type_id = item_type.id
                    left join supplier on supplier.id = item.supplier_id
                    where purchase_id = ".$purchase_id."
                    group by size_id,color_code";
        $query = $this->db->query($sql);
        return $query->result();
    }

}