<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:07 AM
 * To change this template use File | Settings | File Templates.
 */

class Sales_items extends CI_Controller{
    function __construct(){
        parent::__construct();
        logged_in();
    }
}