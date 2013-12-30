<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:13 AM
 * To change this template use File | Settings | File Templates.
 */

class Color_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function get( $id = ''){
        $this->db->select('*');
        if($id != ''){
            $this->db->where(array('id' => $id));
        }
        $query =  $this->db->get('color');

        return $query->result();
    }

    public function create(){
        $data = $this->input->post();
        $this->db->insert('color' , 
                    array(
                        'color_code' =>$data['color_code'] , 
                        'description' => $data['description'],
                    ));
    }


    public function update($id){
        $this->db->where('id', $id);
        $post = $this->input->post();
        $this->db->update('color',  $post);
    }


    public function delete($id){
        $this->db->delete('color', array('id' => $id));
        return TRUE;
    }






}