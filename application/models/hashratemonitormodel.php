<?php

class hashratemonitormodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getHasRates($script = 'sha256') {

        $query = 'SELECT * FROM `hashrate` WHERE algo = "' . $script . '"';
        $all = $this->db->query($query)->row();

        $user = $this->session->userdata('user');

        $items = array();
        if ($user->user_id) {
            $query = 'SELECT * FROM `hashuser` WHERE userid = ' . $user->user_id . ' ORDER BY id ASC';
            $items = $this->db->query($query)->result();

            foreach ($items as $k => $r) {
                $items[$k]->time = date('m/d/Y H:i', $r->time);
            }
        }



        return $items;
    }

    public function getGroups() {
        $user = $this->session->userdata('user');

        $query = 'SELECT a.*, b.id AS user_id FROM `users` AS a '
                . ' LEFT JOIN `accounts` AS b ON b.username = a.name '
                . ' WHERE a.parent_id = '.$user->id;
        $all = $this->db->query($query)->result();
        return $all;
    }

}
