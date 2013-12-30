<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/12/13
 * Time: 4:03 PM
 * To change this template use File | Settings | File Templates.
 */

class Showroom extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('showroom_model');
        logged_in();
    }

    function load_view(&$data){
        $data['active'] = 'showroom';
        $this->load->view('template' , $data);
    }

    public function index(){
        //get all the outlets
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Store', 'required|is_unique[showroom.name]');
            $this->form_validation->set_rules('location' , 'Showroom address', 'required');
            if($this->form_validation->run() === FALSE){

            }else{
                //add the user to db.
                $this->showroom_model->add();
                $this->session->set_flashdata('message' , "Showroom has successfully been added");
                redirect('showroom');
            }
        }
        $data['page_name'] = 'Showrooms';
        $data['vars']['showrooms'] = $this->showroom_model->get();
        $data['main_content'] = 'showroom/show';
        $this->load_view($data);
    }


    public function edit($id){
        if($this->input->post()){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('name' , 'Name of Showroom', 'required');
            $this->form_validation->set_rules('location' , 'Location of Showroom', 'required');
            if($this->form_validation->run() === FALSE){
                
            }else{

                $this->showroom_model->update($id);
                $this->session->set_flashdata('message' , 'showroom has successfully edited');
                redirect('showroom');
            }
        }

        $data['page_name'] = 'Update Showroom info';
        $showrooms = $this->showroom_model->get( '*' , array('id' => $id));
        $data['vars']['showroom'] = $showrooms[0];
        $data['main_content'] = 'showroom/edit';
        $this->load_view($data);
    }






    public function delete($id){
        if($this->showroom_model->delete($id)){
            $this->session->set_flashdata('message' , 'Store information has successfully been deleted');
        }else{
            $this->session->set_flashdata('message' , "Can't remove Showroom, You have existing data with this Showroom , <h3> Showroom can only be removed , only if you don't have any data with it</h3>");
        }

        redirect('showroom');
    }


}