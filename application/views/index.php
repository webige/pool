
<?php

$user = $this->session->userdata('user');
;

if (isset($iframe) && $iframe) {
    $this->load->view('includes/iframes/header', array('title' => $title, 'view' => $view));

    $data['view'] = $view;
    $data['view_pg'] = $view_pg;


    $this->load->view('includes/iframes/content', $data);
    $this->load->view('includes/iframes/footer');
} else {
    $this->load->view('includes/pages/header', array('title' => $title, 'view_pg' => $view_pg));
    if (isset($user) && !empty($user) && !empty($left)) {
        $this->load->view('includes/pages/left', array('left' => $left));
    }

    $data['view'] = $view;
    $data['view_pg'] = $view_pg;


    $this->load->view('includes/pages/content', $data);
    $this->load->view('includes/pages/footer');

}
?>