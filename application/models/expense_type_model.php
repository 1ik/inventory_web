<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:16 AM
 * To change this template use File | Settings | File Templates.
 */

class Expense_type_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function create(){
        $data = $this->input->post();
        $this->db->insert('expense_type' , array('reason' => $data['reason']));
    }

    public function get($select = '*' , $where = array() , $join = array()){
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from('expense_type');
        $query = $this->db->get();
        return $query->result();
    }


    public function update($id){

        $data['reason'] = $this->input->post('reason');
        $this->db->where('id' , $id);
        $this->db->update('expense_type' , $data);
    }

    public function delete($id){
        $sql = "select * from expense where expense_type_id = $id limit 1";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0){
            return FALSE;
        }else{
            $this->db->delete('expense_type', array('id' => $id));
            return TRUE;
        }
    }


}