<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:09 PM
 * To change this template use File | Settings | File Templates.
 */

class Product_type_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }



    public function add_item_type(){
        $groupid = $this->input->post('group');
        $subgroupid = $this->input->post('subgroup');
        $item_type_name = $this->input->post('item_type_name');
        $this->db->insert('item_type' , array('group_id' => $groupid , 'sub_group_id' => $subgroupid , 'name' => $item_type_name));
    }


    public function get(){
        return $this->get_item_types(array("item_type.id" , 'item_type.name as name' , "group.name as group_name" , "sub_group.name as sub_group_name") , '' , TRUE);
    }





    private function get_item_types($select = '*' , $where = '' , $join = FALSE){
        if($where != ''){
            $this->db->where($where);
        }
        $this->db->select($select);
        $this->db->from('item_type');
        if($join == TRUE){
            $this->db->join('group', 'item_type.group_id = group.id');
            $this->db->join('sub_group', 'item_type.sub_group_id = sub_group.id');
        }
        $this->db->order_by("item_type.id", "desc");
        $query = $this->db->get();

        return $query->result();
    }



}