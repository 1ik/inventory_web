<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:13 AM
 * To change this template use File | Settings | File Templates.
 */

class Group_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function get_groups( $id = ''){
        $this->db->select('*');
        if($id != ''){
            $this->db->where(array('id' => $id));
        }
        $query =  $this->db->get('group');

        return $query->result();
    }

    public function create(){
        $data = $this->input->post();
        $this->db->insert('group' , array('name' =>$data['name'] ));
    }


    public function update($id){
        $this->db->where('id', $id);
        $post = $this->input->post();
        $data['name'] = $post['name'];
        $this->db->update('group',  $data);
    }


    public function delete($id){
        $this->db->delete('group', array('id' => $id));

        return TRUE;
    }






}