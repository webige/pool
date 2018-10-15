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

$this->load->view('includes/iframes/' . $view . '/' . $view_pg, $data);

if (!empty($user)) {
    echo '</div>';
}
