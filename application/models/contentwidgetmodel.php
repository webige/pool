<?php

class contentwidgetmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAllWorkersNumber($script = 'sha256') {

        //$query = 'SELECT userid FROM `workers` WHERE algo = ' . $this->db->escape($script) . '';

        //$res = $this->db->query($query)->result();
        
        $res = file_get_contents(SECOND_URL.'Cronjob/allworkersnumber?algo='.$script);

        if($res){
            $res = json_decode($res);
        }
        
        $users = array();
        if ($res) {
            foreach ($res as $row) {
                if (!in_array($row->userid, $users)) {
                    $users[] = $row->userid;
                }
            }
        }

        $items = array();
        $items['workers'] = count($res);
        $items['users'] = count($users);

        return $items;
    }

    function getAllHashRates($script = 'sha256') {

        //$query = 'SELECT * FROM `hashrate` WHERE algo = "' . $script . '"';
        //$all = $this->db->query($query)->row();
        
        $all = file_get_contents(SECOND_URL.'Cronjob/hashrate?algo='.$script);

        if($all){
            $all = json_decode($all);
        }

        $user = $this->session->userdata('user');

        $my = array();
        if ($user->user_id) {
            $query = 'SELECT * FROM `hashuser` WHERE userid = ' . $user->user_id . ' ORDER BY id DESC LIMIT 1';
            $my = $this->db->query($query)->row();
        }


        $items = array();
        $items['all'] = isset($all->hashrate) ? $all->hashrate : 0;
        $items['my'] = isset($my->hashrate) ? $my->hashrate : 0;

        return $items;
    }

    function getAllUsers() {

        $query = 'SELECT * FROM `users`';
        return $this->db->query($query)->num_rows();
    }

}
