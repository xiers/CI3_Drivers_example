<?php
	defined('BASEPATH') or exit('No direct script access allowed ');
	class Index extends  CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->driver('dtest');
        }
        public function index(){
			echo "index";
           //$this->load->driver('dtest');
            print_r($this->dtest->valid_drivers);
            $this->dtest->first->get_info();
		}
	}

?>
