<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:18 AM
 * To change this template use File | Settings | File Templates.
 */

class Expense_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function create(){
        $dtime = new DateTime();
        $data = $this->input->post();
        $data['created_at'] = $dtime->format('Y-m-d H:i:s');
        $this->db->insert('expense' , $data);
    }

    public function get($select = '*' , $where = array() , $join = array()){
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from('expense');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_all_expense(){
        $sql = "SELECT expense.id as id, expense_type.reason as reason, showroom.name as showroom_name, expense.amount as amount, expense.created_at as date , expense.explanation FROM `expense` 
join expense_type on expense_type.id = expense.expense_type_id
join showroom on showroom.id = expense.showroom_id order by expense.id desc";
        $query = $this->db->query($sql);
        return $query->result();
        
    }





}