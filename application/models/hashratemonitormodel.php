<?php

class hashratemonitormodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getHasRates($script = 'sha256') {

        $user = $this->session->userdata('user');

        $items = array();
        $items['1day'] = array();
        $items['7day'] = array();
        $items['30day'] = array();
        $items['90day'] = array();
      
        
        if ($user->user_id) {
            $query = 'SELECT * FROM `hashuser` WHERE userid = ' . $user->user_id . ' ORDER BY id ASC';
            $ret = $this->db->query($query)->result();

            foreach ($ret as $k => $r) {
                $items['1day'][$k] = new stdClass();
                $items['1day'][$k]->time = date('m/d/Y H:i', $r->time);
                $items['1day'][$k]->hashrate = $r->hashrate;
            }
             
            $query = 'SELECT * FROM `hashuser7d` WHERE userid = ' . $user->user_id . ' ORDER BY id ASC';
            $ret = $this->db->query($query)->result();

            foreach ($ret as $k => $r) {
                $items['7day'][$k] = new stdClass();
                $items['7day'][$k]->time = date('m/d/Y H:i', $r->time);
                $items['7day'][$k]->hashrate = $r->hashrate;
            }
            
            $query = 'SELECT * FROM `hashuser30d` WHERE userid = ' . $user->user_id . ' ORDER BY id ASC';
            $ret = $this->db->query($query)->result();

            foreach ($ret as $k => $r) {
                $items['30day'][$k] = new stdClass();
                $items['30day'][$k]->time = date('m/d/Y H:i', $r->time);
                $items['30day'][$k]->hashrate = $r->hashrate;
            }
            
            $query = 'SELECT * FROM `hashuser90d` WHERE userid = ' . $user->user_id . ' ORDER BY id ASC';
            $ret = $this->db->query($query)->result();

            foreach ($ret as $k => $r) {
                $items['90day'][$k] = new stdClass();
                $items['90day'][$k]->time = date('m/d/Y H:i', $r->time);
                $items['90day'][$k]->hashrate = $r->hashrate;
            }
        }

        return $items;
    }

    public function getGroups() {
        $user = $this->session->userdata('user');

       
        $query = 'SELECT a.* FROM `users` AS a '
                . ' WHERE a.parent_id = '.$user->id;
        
        $all = $this->db->query($query)->result();
        
        if($all){
            $exparr = array();
            foreach($all as $row){
                $exparr[] = $row->id;
            }
        }
        
        return $all;
    }

}
