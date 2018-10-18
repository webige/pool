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
        $this->load->model('mainmodel');
        $data['iframes'] = $this->mainmodel->getIframePositions();
        $data['title'] = 'dashboard';
        $data['view'] = 'dashboard';
        $data['view_pg'] = 'dashboard';

        $this->load->view('index', $data);
    }

    public function iframes_json() {
        $this->load->model('mainmodel');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $json_ids = $this->input->post('ids');

            if ($json_ids) {

                $ids = $json_ids;
                if (is_array($ids)) {
                    if ($this->mainmodel->hasUserPosition()) {
                        $this->mainmodel->updateIframePositions($ids);
                    } else {
                        $this->mainmodel->setIframePositions($ids);
                    }
                }
            }
        }
        die;
    }

}
