<?php
$data = array();

if (isset($items)) {
    $data['items'] = $items;
}
if (!empty($this->session->flashdata('good_msg'))) {
    ?>
    <div class=".alert-warning">
        <?php echo $this->session->flashdata('good_msg'); ?>
    </div>
    <?php
}
if (!empty($this->session->flashdata('err_msg'))) {
    ?>
    <div class=".alert-success">
        <?php echo $this->session->flashdata('err_msg'); ?>
    </div>
    <?php
}

$user = $this->session->userdata('user');

if (!empty($user)) {

    $this->load->view('includes/pages/menu');
    $this->load->view('includes/pages/left');
}

$this->load->view('includes/pages/' . $view . '/' . $view_pg, $data);
if (!empty($user)) {
    echo '</div>';
}
