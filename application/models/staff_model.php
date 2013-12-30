<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create(){
		$data = $this->input->post();
		$date = new DateTime();
        $data['created_at'] =  $date->format('Y-m-d H:i:s');
        $this->db->insert('staff' , $data);
	}


	public function get($select = '*' , $where = array()){
		$this->db->select('staff.* ,  showroom.name as showroom_name');
		$this->db->where($where);
		$this->db->from('staff');
		$this->db->join('showroom', 'showroom.id = staff.showroom_id');
		$this->db->order_by('staff.id desc');

		$query = $this->db->get();
		return $query->result();
	}


	public function update($id){
		$this->db->where(array('id' => $id));
		$this->db->update( 'staff', $this->input->post());
	}


	public function delete($id){
		$query = $this->db->query('select * from salary where staff_id = '.$id.' limit 1');
		if($query->num_rows() > 0){
			return FALSE;
		}else{
			$this->db->delete('staff' , array('id' => $id));
			return TRUE;
		}
	}

}

/* End of file staff_model */
/* Location: ./application/models/staff_model */