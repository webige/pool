<?php
class financemodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    public function getData(){

        $db = $this->db;
        $user = $this->session->userdata('user');
        $query = 'SELECT w.* FROM withdraws as w '
                . 'WHERE w.user_id = '.$user->user_id.' ORDER BY w.id DESC';

        return $db->query($query)->result();
    }
    
}
