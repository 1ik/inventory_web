<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 9:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Salaries extends CI_Controller{
    function __construct(){
        parent::__construct();
        logged_in();
    }
}