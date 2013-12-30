<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:10 AM
 * To change this template use File | Settings | File Templates.
 */

class Sales extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("sales_model");
        $this->load->model("showroom_model");
        logged_in();
    }

    private function load_view(&$data = array()){
        $data['page_name'] = 'Sales';
        $data['active'] = 'sales';
        $data['showrooms'] = $this->showroom_model->get();
        $this->load->view('template' , $data);
    }


    public function index() {

 
    	
    	if(!$this->input->get()){

    		$data['vars']['items'] = '';

    	} else {
    		$showroom_id = $this->input->get("showroom_id" , true);
    		$date = $this->input->get("date" , true);
    		$data['vars']['items'] = $this->sales_model->get_items($showroom_id , $date);
    	}

        $data['main_content'] = 'sales/show';
        $this->load_view($data);
    }





}