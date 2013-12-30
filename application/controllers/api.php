<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		
	}

	/**
	*Takes last transfer id and a storeid
	*and returns all the transfers which is newer than the transfer id. :)
	*/
	public function get_new_items( $showroom_id , $transfer_id = ""){
		//$where = "AND item.id not in (SELECT item_id from sold_item) AND item.showroom_id = ".$showroom_id;
		$where = "";
		if($transfer_id != ''){
			$where = " where tt.transfer_id > ".$transfer_id;
		}

		/*
		$sql = "select transfer.id as transfer_id, count(*) as total_items , transfer.created_at from transfer left join transferred_item on transferred_item.transfer_id = transfer.id join item on item.id = transferred_item.item_id where to_showroom_id = ".$showroom_id." ".$where." group by transfer.id";
		*/
		$sql = "select tt.transfer_id , count(tt.item_id) as total_items , tt.created_at from
				(select i.id as item_id, t.id as transfer_id , t.created_at  from transfer t
				 	left join transferred_item ti on ti.transfer_id = t.id
					left join item i on i.id = ti.item_id
				 WHERE i.showroom_id = ".$showroom_id." and t.to_showroom_id = ".$showroom_id." and i.id not in (select item_id from sold_item)

				order by t.id desc) tt

				INNER JOIN(
				    SELECT i.id as item_id , MAX(tf.id) as max_transfer from transfer tf
				    left join transferred_item ti on ti.transfer_id = tf.id
				    left join item i on i.id = ti.item_id
				    
				    where i.showroom_id = ".$showroom_id." AND i.id not in (SELECT item_id from sold_item) AND tf.to_showroom_id = ".$showroom_id."
				    group by item_id
				) ht on tt.item_id = ht.item_id AND tt.transfer_id = ht.max_transfer
				".$where."
				group by tt.transfer_id
				order by tt.transfer_id desc";


		$query = $this->db->query($sql);
		$data['transfer_ids'] = $query->result();
		/*
		$t_ids = array();
		foreach ($data['transfer_ids'] as $item) {
			$t_ids[] = $item->transfer_id;
		}

		$t_ids = "(" . implode("," , $t_ids) . ")";

		$where = "";

		if(count($data['transfer_ids']) > 0) {
			$where = " where transfer.id in ".$t_ids;
		}
		*/

		/*
		$sql = "select item.showroom_id, transfer.id as transfer_id, item.id as item_id, size.name as size, item_type.name as type, item.sell_price,
		item.color_code from transfer 
		left join transferred_item on transferred_item.transfer_id = transfer.id 
		left join item on item.id = transferred_item.item_id
		left join size on item.size_id = size.id
		left join item_type on size.item_type_id = item_type.id where transfer.to_showroom_id = ".$showroom_id." ".$where;
		*/
		/*
		$sql = "select item.showroom_id, transfer.id as transfer_id, item.id as item_id, size.name as size, item_type.name as type, item.sell_price,
		item.color_code from transfer 
		left join transferred_item on transferred_item.transfer_id = transfer.id 
		left join item on item.id = transferred_item.item_id
		left join size on item.size_id = size.id
		left join item_type on size.item_type_id = item_type.id".$where;
		*/

		$sql = "select tt.showroom_id, tt.transfer_id, tt.item_id, tt.size, tt.type, tt.sell_price, tt.color_code from 
			(select 
             i.id as item_id, 
             t.id as transfer_id,
             s.name as size,
             ty.name as type,
             i.color_code,
             i.showroom_id,
             i.sell_price
             from transfer t
			 	left join transferred_item ti on ti.transfer_id = t.id
				left join item i on i.id = ti.item_id
             	left join size s on i.size_id = s.id
             	left join item_type ty on ty.id = s.item_type_id
			 WHERE i.showroom_id = ".$showroom_id." and t.to_showroom_id = ".$showroom_id." and i.id not in (select item_id from sold_item)

			order by t.id desc) tt

			INNER JOIN(
			    SELECT i.id as item_id , MAX(tf.id) as max_transfer from transfer tf
			    left join transferred_item ti on ti.transfer_id = tf.id
			    left join item i on i.id = ti.item_id
			    
			    where i.showroom_id = ".$showroom_id." AND i.id not in (SELECT item_id from sold_item) AND tf.to_showroom_id = ".$showroom_id."
			    group by item_id
			) ht on tt.item_id = ht.item_id AND tt.transfer_id = ht.max_transfer ".$where;
		
		$query = $this->db->query($sql);
		$data["items"] = $query->result();

		echo json_encode($data);
	}


	/**
	* receives post request for a new memo(s) in json format. and updates database.
	*/
	public function request_new_memo(){
		if($this->input->post()){
			$json_string = $this->input->post("memos");
			$memos = json_decode($json_string , true);

			$memoids = array();
			$data = array();
			$sold_item = array();
			$returned_item_data = array();
			$showroom_id = '';

			foreach($memos as $memo){
				$memoids[] = $memo['id'];

				$this->db->insert('memo' , array('added_on' => $memo['added_on'] , 'showroom_id' => $memo['showroom_id']));
				$showroom_id = $memo['showroom_id'];

				$memo_id = $this->db->insert_id();
				$items = explode("," , $memo['items']);

				foreach($items as $item_id){
					$data[] = array('item_id' => $item_id , 'memo_id' => $memo_id);
					$sold_item[] = array('item_id' => $item_id);
				}

				//do we have any returned item ?
				if($memo['changed_items'] != "" ) {
					$returned_items = explode("," , $memo['changed_items']);
					if( count($returned_items) > 0) {
						//yes we have returned item.
						foreach ($returned_items as $returned_item) {
							$returned_item_data[] = array('memo_id' => $memo_id, 'item_id' => $returned_item);
						}
						$sql = "DELETE from sold_item where item_id IN ( ".$memo['changed_items'].")";
						$this->db->query($sql);
					}	
				}
			}

			//now update the item's showroom's position to 0;
			$this->db->insert_batch('memo_item' , $data);
			$this->db->insert_batch('sold_item' , $sold_item);

			if(count($returned_item_data) > 0) {

				$this->db->insert_batch('returned_item' , $returned_item_data);
				$this->transfer_change_items($returned_item_data, $showroom_id);
			}

			echo json_encode($memoids);
		}
	}

	public function test(){
		$data[] = array('memo_id' => 2 , 'item_id' => 13);
		$data[] = array('memo_id' => 2 , 'item_id' => 14);
		$data[] = array('memo_id' => 2 , 'item_id' => 15);
		$data[] = array('memo_id' => 2 , 'item_id' => 16);
		$this->transfer_change_items($data, 4);
	}


	private function transfer_change_items($returned_item_datas , $showroom_id){
		$this->db->trans_start();

		$from_showroom_id		= $showroom_id;
		$to_showroom_id			= $showroom_id;

		$date = new DateTime();
		$this->db->insert('transfer' , array('from_showroom_id' => $from_showroom_id, 'to_showroom_id' => $to_showroom_id , 'created_at' => $date->format('Y-m-d H:i:s') ));
		$transfer_id = $this->db->insert_id();
		
		$values = '';
		$i=0;
		foreach($returned_item_datas as $returned_item_data){
            if($returned_item_data != null){
                $transferred_items[] = array('transfer_id' => $transfer_id , 'item_id' => $returned_item_data['item_id']);
                $values = $values." (".$returned_item_data['item_id'].",".$to_showroom_id.") ";
                if($i < count($returned_item_datas)-1){
                    $values = $values . ","; //append comma only after the prior rows to the LAST one.
                }
            }
            $i++;
        }

        $updates = "INSERT INTO item( id, showroom_id ) VALUES".$values." ON DUPLICATE KEY UPDATE showroom_id = VALUES(showroom_id)";

		// insert transferitems.
        $this->db->insert_batch('transferred_item' , $transferred_items);
        //then update each item's current location(showroom_id)
        $this->db->query($updates);
        //doneP
        $this->db->trans_complete();
	}




	/**
	* This function is used for transferring items from on showroom to another showroom.
	* It sends an array of transfers.
	* Used only by the desktop clients.
	*/
	public function transfer_to_showroom(){
		$this->db->trans_start();

		if($this->input->post()){
			$outputs = array();

			$transfers_json = $this->input->post("transfers"); //json array
			$transfers = json_decode($transfers_json); //array of transfers

			$transferred_items = array();
			$mainval = '';

			foreach($transfers as $transfer) {
				$outputs[] = $transfer->id;

				$from_showroom_id		= $transfer->from_showroom_id;
				$to_showroom_id			= $transfer->to_showroom_id;
				$items 					= explode("," , $transfer->items);
				$date = new DateTime();
				$this->db->insert('transfer' , array('from_showroom_id' => $from_showroom_id, 'to_showroom_id' => $to_showroom_id , 'created_at' => $date->format('Y-m-d H:i:s') ));
				$transfer_id = $this->db->insert_id();
				
				$values = '';
				$i=0;
				foreach($items as $item_id){
		            if($item_id != null){
		                $transferred_items[] = array('transfer_id' => $transfer_id , 'item_id' => $item_id);
		                $values = $values." (".$item_id.",".$to_showroom_id.") ";
		                if($i < count($items)-1){
		                    $values = $values . ","; //append comma only after the prior rows to the LAST one.
		                }
		            }
		            $i++;
		        }

		        if($mainval != '') {
		        	$mainval .= ' , ';
		        }

		        $mainval .= $values;
			}

			$updates = "INSERT INTO item( id, showroom_id ) VALUES".$mainval." ON DUPLICATE KEY UPDATE showroom_id = VALUES(showroom_id)";

			// insert transferitems.
	        $this->db->insert_batch('transferred_item' , $transferred_items);
	        //then update each item's current location(showroom_id)
	        $this->db->query($updates);

	        //doneP
	        $this->db->trans_complete();

	        echo json_encode($outputs);

		}
	}


	/**
	* Receives a json array containing one or more expense information. Takes it and parse it and insert into the db.
	*/

	public function request_new_expense(){
		if($this->input->post()){

			$expense_informations = $this->input->post("expenses");
			$expenses = json_decode($expense_informations , true);
			$data = array();
			$expense_ids = array();
			foreach ($expenses as $expense) {
				$expense_ids[] = $expense['expense_id'];
				unset($expense['expense_id']);
				$data[] = $expense;
			}

			$this->db->insert_batch('expense' , $data);
			echo json_encode($expense_ids);
		}

	}

	public function get_expense_types(){
		$this->load->model("expense_type_model");
		$expense_types = $this->expense_type_model->get(array('id' , 'reason'));
		echo json_encode($expense_types);
	}

	


	/**
	* Receives json data from Java desktop client. and serves
	* Depricated
	*/
	public function return_items_to_head_office(){
		$this->load->model('transfer_model');
        $json_data = $this->input->post('transfers');
        $this->transfer_model->add($json_data);
        echo 'ok';
    }


    public function get_showrooms_list(){
    	$this->load->model('showroom_model');
    	$showrooms = $this->showroom_model->get(array('id' , 'name'));
    	echo json_encode($showrooms);
    }


    public function check_sold_item($item_id) {
    	$sql = "SELECT item.id as item_id, item_type.name as item_type, size.name as item_size,
				item.sell_price as price, item.color_code as color , showroom.name as sell_showroom, DATE_FORMAT(memo.added_on , '%d-%m-%y') as sell_date
				FROM `memo_item` 
				join memo on memo.id = memo_item.memo_id
				join item on item.id = memo_item.item_id
				join size on size.id = item.size_id
				join item_type on size.item_type_id = item_type.id
				join showroom on memo.showroom_id = showroom.id
				where $item_id IN (SELECT item_id from sold_item ) AND item.id = ".$item_id;
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			$result = $query->result_array();
			echo json_encode($result[0]);
		} else {
			echo "" ;
		}
    }

}

/* End of file api.php */
/* Location: ./application/controllers/api.php */