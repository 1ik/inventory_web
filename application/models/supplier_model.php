<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 12:29 AM
 * To change this template use File | Settings | File Templates.
 */

class Supplier_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function add_supplier(){
        $data = $this->input->post();
        $this->db->insert('supplier' , array('name' =>$data['supplier_name'] , 'email' =>$data['supplier_email'] , 'cell_no' => $data['supplier_phone'], 'address'=>$data['supplier_address']));
    }

    public function get_suppliers( $id = ''){
        $this->db->select('*');
        if($id != ''){
            $this->db->where(array('id' => $id));
        }
        $query =  $this->db->get('supplier');
        return $query->result();
    }

    public function update_supplier($id){
        $this->db->where('id', $id);
        $post = $this->input->post();
        $data['name'] = $post['supplier_name'];
        $data['cell_no'] = $post['supplier_phone'];
        $data['email'] = $post['supplier_email'];
        $data['address'] = $post['supplier_address'];
        $this->db->update('supplier',  $data);
    }

    public function delete($id){
        $this->db->where(array('supplier_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get('item');

        if($query->num_rows() > 0){
            return FALSE;
        }


        $this->db->delete('supplier', array('id' => $id));
        return TRUE;
    }


}