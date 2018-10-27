<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getAlertMSG() {
    $CI = & get_instance();
    if (!empty($CI->session->flashdata('good_msg'))) {
        ?>
        <div class="alert-warning">
            <?php echo $CI->session->flashdata('good_msg'); ?>
        </div>
        <?php
    }
    if (!empty($CI->session->flashdata('err_msg'))) {
        ?>
        <div class="alert-success">
            <?php echo $CI->session->flashdata('err_msg'); ?>
        </div>
        <?php
    }
}
