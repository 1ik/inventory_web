<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/15/13
 * Time: 12:43 PM
 * To change this template use File | Settings | File Templates.
 */

class Item_type_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function get($select = '*' , $where = array() , $join = array()){

        $this->db->select($select);
        $this->db->where($where);
        $this->db->from('item_type');

        if(in_array('sub_group' , $join)){
            $this->db->join('sub_group', 'sub_group.id = item_type.sub_group_id');
            if(in_array('group' , $join)){
                $this->db->join('group', 'group.id = sub_group.group_id');
            }
        }
        $this->db->order_by('item_type.id' , 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function create(){

        $p = array( 'sub_group_id' => $this->input->post('sub_group') , 'name' => $this->input->post('name'));
        $this->db->insert('item_type' , $p);
    }

    public function delete($id){
       if($this->db->delete('item_type', array('id' => $id))){
            return TRUE;
        }else{
            return FALSE;
        }

    }

}