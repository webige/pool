<?php
class financemodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function getData(){

        $db = $this->db;
        $user = $this->session->userdata('user');
        
        $query = 'SELECT * FROM withdraws  '
                . 'WHERE user_id = '.$user->user_id.' ORDER BY id DESC';

        return $db->query($query)->result();
    }
    
}
