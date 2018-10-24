<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getDesctop($id) {

    $CI = & get_instance();
    $db = $CI->db;

    $query = 'SELECT * FROM users_desctop WHERE user_id = ' . (int) $id;
    $res = $db->query($query)->row();
    if (!$res) {
        $std = new stdClass();
        $std->user_id = $id;
        $std->desctop = 1;
        $res = $std;
    }
    return $res;
}


