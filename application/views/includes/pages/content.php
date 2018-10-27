<?php
$data = array();

if (isset($items)) {
    $data['items'] = $items;
}


$user = $this->session->userdata('user');

if (!empty($user)) {

    $this->load->view('includes/pages/menu');
    $this->load->view('includes/pages/left');
}
?>
<div class="content-page">
    <?php
    $this->load->view('includes/pages/' . $view . '/' . $view_pg, $data);
    ?>
</div>
<?php
if (!empty($user)) {
    echo '</div>';
}
