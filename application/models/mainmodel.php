<?php

class mainmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getIframePositions() {
        $user = $this->session->userdata('user');

        if (!$user->id) {
            return 0;
        }
        $db = $this->db;

        $query = 'SELECT iu.*,i.name FROM '
                . '`iframe_position_users` as iu '
                . 'LEFT JOIN `iframe_position` as i on i.name = iu.position_name '
                . 'WHERE iu.user_id = ' . $user->id . ' ORDER BY `iu`.`order` DESC';
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

    public function updateIframePositions($data = array()) {
        if ($data) {
            $user = $this->session->userdata('user');

            if (!$user->id) {
                return 0;
            }
            $db = $this->db;
            $i = 1;
            foreach ($data as $name) {
                $query = 'UPDATE `iframe_position_users` SET `order` = ' . $i . ' WHERE `position_name` = ' . $this->db->escape($name) . ' AND user_id = '.$user->id.' LIMIT 1';
                $db->query($query);
                $i++;
            }
        }
    }

    public function setIframePositions($data = array()) {
        if ($data) {
            $user = $this->session->userdata('user');

            if (!$user->id) {
                return 0;
            }
            $db = $this->db;
            $i = 1;
            foreach ($data as $name) {
                $query = 'INSERT INTO `iframe_position_users` (`order`,`user_id`,`position_name`)VALUES(' . $i . ',' . $user->id . ',' . $db->escape($name) . ')';
                $db->query($query);
                $i++;
            }
        }
    }

    public function hasUserPosition() {
        $user = $this->session->userdata('user');

        if (!$user->id) {
            return false;
        }
        $db = $this->db;

        $query = 'SELECT `iu`.* FROM '
                . '`iframe_position_users` as `iu` '
                
                . 'WHERE `iu`.`user_id` = ' . $user->id . ' ORDER BY `iu`.`order` DESC';
        $res = $db->query($query)->result();
        if (isset($res[0]->id) && $res[0]->id){
            return true;
        }
        return false;
    }

}
