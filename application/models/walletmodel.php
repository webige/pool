<?php

class walletmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getWallets($type = 1) {
        
        $user = $this->session->userdata('user');

        $query = 'SELECT * FROM `wallets` WHERE type = ' . $type . ' AND user_id = '.$user->id;
        $all = $this->db->query($query)->row();

        return $all;
    }
    

}
