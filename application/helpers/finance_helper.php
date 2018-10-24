<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getStatus($status_id) {
    if (!$status_id) {
        return false;
    }
    $statuses = array('1' => 'pending', '2' => 'received', '3' => 'sent', '4' => 'denied');

    if (isset($statuses[$status_id])) {
        $return = $statuses[$status_id];
    } else {
        $return = false;
    }
    return $return;
}
