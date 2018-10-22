<?php

class mainmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getIframePositions($d = 1) {
        $user = $this->session->userdata('user');

        if (!$user->id) {
            return 0;
        }
        $db = $this->db;

        $query = 'SELECT iu.*,i.name FROM '
                . '`iframe_position_users` as iu '
                . 'LEFT JOIN `iframe_position` as i on i.name = iu.position_name '
                . 'WHERE iu.user_id = ' . $user->id . ' AND iu.d = '.$d.' ORDER BY `iu`.`order` DESC';
        $res = $db->query($query)->result();

        $iframe = array();
        if ($res) {
            foreach ($res as $row) {
                $iframe[$row->order] = $row->name;
            }
        } else {

            $query = 'SELECT * FROM `iframe_position` ORDER BY `order` DESC';
            $res = $db->query($query)->result();
            $i = 1;
            foreach ($res as $row) {
                $iframe[$row->order] = $row->name;
                $i++;
            }
        }
        return $iframe;
    }
    
    public function getGroups() {
        $user = $this->session->userdata('user');

        $query = 'SELECT a.*, b.id AS user_id FROM `users` AS a '
                . ' LEFT JOIN `accounts` AS b ON b.username = a.name '
                . ' WHERE a.parent_id = '.$user->id;
        $all = $this->db->query($query)->result();
        return $all;
    }

    public function updateIframePositions($data = array(),$d = 1) {
        if ($data) {
            $user = $this->session->userdata('user');

            if (!$user->id) {
                return 0;
            }
            $db = $this->db;
            $i = 1;
            foreach ($data as $name) {
                $query = 'UPDATE `iframe_position_users` SET `order` = ' . $i . ' WHERE `d` = '.$d.' AND `position_name` = ' . $this->db->escape($name) . ' AND user_id = '.$user->id.' LIMIT 1';
                $db->query($query);
                $i++;
            }
            $this->updateUserDesctop($d);
        }
    }

    public function setIframePositions($data = array(),$d = 1) {
        if ($data) {
            $user = $this->session->userdata('user');

            if (!$user->id) {
                return 0;
            }
            $db = $this->db;
            $i = 1;
            foreach ($data as $name) {
                $query = 'INSERT INTO `iframe_position_users` (`order`,`user_id`,`position_name`,`d`)VALUES(' . $i . ',' . $user->id . ',' . $db->escape($name) . ','.$d.')';
                $db->query($query);
                $i++;
            }
            $this->updateUserDesctop($d);
        }
    }

    public function hasUserPosition($d = 1) {
        $user = $this->session->userdata('user');

        if (!$user->id) {
            return false;
        }
        $db = $this->db;

        $query = 'SELECT `iu`.* FROM '
                . '`iframe_position_users` as `iu` '
                
                . 'WHERE `iu`.`user_id` = ' . $user->id . ' AND iu.d = '.$d.' ORDER BY `iu`.`order` DESC';
        $res = $db->query($query)->result();
        if (isset($res[0]->id) && $res[0]->id){
            return true;
        }
        return false;
    }

    private function updateUserDesctop($d = 1){
        $user = $this->session->userdata('user');
         if (!$user->id) {
            return false;
        }
        $this->load->helper('userdesctop');
        
        $usd = getDesctop($user->id);
        if (isset($usd->id)){
        if ($usd->desctop == $d){
            return false;
        }
        $db = $this->db;
         $query = 'UPDATE `users_desctop` SET `desctop` = ' . $d . ' WHERE  `id` = '.$usd->desctop.' ';
         $db->query($query);
        }else{
             $db = $this->db;
         $query = 'INSERT `users_desctop` (`user_id`,`desctop`)VALUES('.$user->id.','.$d.')';
         $db->query($query);
        }
    }
}
