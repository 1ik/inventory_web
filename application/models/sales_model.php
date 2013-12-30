<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:11 AM
 * To change this template use File | Settings | File Templates.
 */

class Sales_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }



    public function get_items($showroom_id , $date) {

    	$sql = "select item.sell_price as item_price, memo.added_on as sold_on, size.name as item_size,
				DATE_FORMAT(memo.added_on,'%m/%d/%Y'), item_type.name as item_name from memo
				join memo_item on memo.id = memo_item.memo_id
				join item on item.id = memo_item.item_id
				join size on size.id = item.size_id
				join item_type on item_type.id = size.item_type_id
				where item.showroom_id = ".$showroom_id." AND DATE_FORMAT(memo.added_on,'%m/%d/%Y') = '".$date."'";

		$query = $this->db->query($sql);
		return $query->result();
    }
}