<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:23 AM
 * To change this template use File | Settings | File Templates.
 */

class Size_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function create(){
        $names = explode(',' , $this->input->post('name'));
        $data = '';

        foreach($names as $name){
            $data[] = array('name' => $name, 'item_type_id' => $this->input->post('item_type_id'));
        }
        $this->db->insert_batch('size' , $data);


    }

    public function get($select ="*" , $where= array(), $join = array()){
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from('size');

        if(in_array('item_type' , $join)){
            $this->db->join('item_type', 'item_type.id = size.item_type_id');
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function edit(){

    }

    public function delete($id){
       if($this->db->delete('size', array('id' => $id))){
            return TRUE;
        }else{
            return FALSE;
        }

    }



}