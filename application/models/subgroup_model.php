<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 9:48 AM
 * To change this template use File | Settings | File Templates.
 */

class Subgroup_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }


    public function get_subgroups($where = '' , $select ='*'){
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get('sub_group');
        return $query->result();
    }




    public function create(){
        $groupid = $this->input->post('group');
        $sub_group_name = $this->input->post('name');
        $data = array('group_id' => $groupid , 'name' => $sub_group_name);
        $this->db->insert('sub_group' , $data);
    }


    public function delete($id){
        $this->db->delete('sub_group', array('id' => $id));
        return TRUE;
    }


}