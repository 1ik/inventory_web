<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/12/13
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

class Showroom_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function get($select = '*' , $where = array()){
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get('showroom');
        return $query->result();
    }

    public function update($id){
        $this->db->where(array('id' => $id));
        $data['name'] = $this->input->post('name');
        $data['location'] = $this->input->post('location');
        $this->db->update('showroom',  $data);
    }


    public function add(){
        $data['name'] = $this->input->post('name');
        $data['location'] = $this->input->post('location');
        $this->db->insert('showroom' , $data);
    }

    public function delete($id){

        $this->db->where(array('showroom_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get('expense');

        if($query->num_rows() > 0){
            return FALSE;
        }

        $this->db->where(array('showroom_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get('transfer');

        if($query->num_rows() > 0){
            return FALSE;
        }


        $this->db->where(array('showroom_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get('salary');

        if($query->num_rows() > 0){
            return FALSE;
        }

        $this->db->where(array('showroom_id' => $id));
        $this->db->limit(1);
        $query = $this->db->get('sell');

        if($query->num_rows() > 0){
            return FALSE;
        }


        $this->db->delete('showroom', array('id' => $id));
        return TRUE;
    }

}