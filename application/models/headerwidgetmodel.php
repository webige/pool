<?php

class headerwidgetmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getActiveWorkers() {

        $user = $this->session->userdata('user');
 
        if(!$user->user_id){
            return 0;
        }

        $query = 'SELECT * FROM `workers` WHERE userid = ' . $user->user_id;
      
        return $this->db->query($query)->num_rows();
    }

}
