<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class main extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $user = $this->session->userdata('user');
        ;

        if (!isset($user) || empty($user)) {
            redirect(base_url() . 'auth');
            return false;
        }

        $data['title'] = 'dashboard';
        $data['view'] = 'dashboard';
        $data['view_pg'] = 'dashboard';

        $this->load->view('index', $data);
    }

}
